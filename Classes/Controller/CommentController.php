<?php
namespace ThomasKieslich\Efblog\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011-2015 Thomas Kieslich
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the text file GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use ThomasKieslich\Efblog\Domain\Model\Comment;
use ThomasKieslich\Efblog\Domain\Model\Post;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * Controller for the Comments object
 */
class CommentController extends BaseController {

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
	 * @inject
	 */
	protected $persistenceManager;

	/**
	 * Adds a comment to a blog post and redirects to detail view
	 *
	 * @param \ThomasKieslich\Efblog\Domain\Model\Post $post
	 * @param \ThomasKieslich\Efblog\Domain\Model\Comment $newComment
	 *
	 * @return void
	 */
	public function createAction(Post $post, Comment $newComment) {

		if ($this->settings['comments']['allowComments'] == 1) {
			$spamcategories = $this->checkForSpam($newComment);
			$newComment->setIp($_SERVER['REMOTE_ADDR']);
			$newComment->setSpamCategories($spamcategories);
			$spampoints = 0;
			foreach ($spamcategories as $value) {
				$spampoints += $value;
			}
			$newComment->setSpampoints($spampoints);

			if ($spampoints > $this->settings['comments']['spam']['spampointsToHide']) {
				$newComment->setHidden(1);
			}
			if ($spampoints < $this->settings['comments']['spam']['spampointsToDie']) {
				$post->addComment($newComment);
				$this->postRepository->update($post);
				$this->persistenceManager->persistAll();
				$this->cacheService->clearPageCache(array($this->settings['detailUid'],$this->settings['listUid']));
			}

			if ($this->settings['comments']['messageAuthor'] || $this->settings['comments']['messageSuperAdmin']) {
				if ($this->settings['comments']['messageAllSpam']) {
					$this->sendMessage($post, $newComment);
				} elseif ($spampoints < $this->settings['comments']['spam']['spampointsToDie']) {
					$this->sendMessage($post, $newComment);
				}
			}
		}
		$this->redirect('detail', 'Post', NULL, array('post' => $post, 'newComment' => $newComment));
	}

	/**
	 * check for possible spam
	 *
	 * @param \ThomasKieslich\Efblog\Domain\Model\Comment $newComment
	 * @return array
	 */
	protected function checkForSpam($newComment) {
		$spampoints = array();

		//check honeyPot
		if ($newComment->getLink()) {
			$spampoints['honeyPot'] = 100;
		}

		//author
		$author = GeneralUtility::strtolower($newComment->getAuthor());
		$authorKeywords = GeneralUtility::trimExplode(',', $this->settings['comments']['spam']['authorKeywords'], TRUE);
		$authorPoints = 0;
		foreach ($authorKeywords as $keyword) {
			$authorPoints += substr_count($author, $keyword);
		}
		if ($authorPoints) {
			$spampoints['authorPoints'] = $authorPoints * $this->settings['comments']['spam']['authorKeywordsPoints'];
		}

		//email
		$email = GeneralUtility::strtolower($newComment->getEmail());
		if ($email && !substr_count($email, '@')) {
			$spampoints['emailNoAt'] = (int)$this->settings['comments']['spam']['emailNoAtPoints'];
		}

		//website
		$websiteLength = strlen($newComment->getWebsite());
		if ($websiteLength > $this->settings['comments']['spam']['websiteLength']) {
			$spampoints['websiteLength'] += $websiteLength - $this->settings['comments']['spam']['websiteLengthPoints'];
		}

		//location
		$location = GeneralUtility::strtolower($newComment->getLocation());
		$locationKeywords = GeneralUtility::trimExplode(',', $this->settings['comments']['spam']['locationKeywords'], TRUE);
		$locationPoints = 0;
		foreach ($locationKeywords as $keyword) {
			$locationPoints += substr_count($location, $keyword);
		}
		if ($locationPoints) {
			$spampoints['locationPoints'] = $locationPoints * $this->settings['comments']['spam']['locationKeywordsPoints'];
		}

		//title
		$title = GeneralUtility::strtolower($newComment->getTitle());
		$titleKeywords = GeneralUtility::trimExplode(',', $this->settings['comments']['spam']['titleKeywords'], TRUE);
		$titlePoints = 0;
		foreach ($titleKeywords as $keyword) {
			$titlePoints += substr_count($title, $keyword);
		}
		if ($titlePoints) {
			$spampoints['titlePoints'] = $titlePoints * $this->settings['comments']['spam']['titleKeywordsPoints'];
		}

		//message
		$message = GeneralUtility::strtolower($newComment->getMessage());

		//message length
		$messageLength = strlen($message);
		if ($messageLength < $this->settings['comments']['spam']['messageLength']) {
			$spampoints['messageLength'] += $this->settings['comments']['spam']['messageLengthPoints'];
		}

		//message start with
		$messageArray = GeneralUtility::trimExplode(' ', $message, TRUE, 500);
		$messageStartWith = GeneralUtility::strtolower($this->settings['comments']['spam']['messageStartWith']);
		$messageStartWords = GeneralUtility::trimExplode(',', $messageStartWith, TRUE);
		$firstWord = in_array($messageArray[0], $messageStartWords);
		if ($firstWord) {
			$spampoints['messageStartWith'] += $this->settings['comments']['spam']['messageStartWithPoints'];
		}

		//message Keyword search
		$keywords = GeneralUtility::trimExplode(',', $this->settings['comments']['spam']['messageKeywords'], TRUE);
		$keywordPoints = 0;
		foreach ($keywords as $keyword) {
			$keywordPoints += substr_count($message, $keyword);
		}
		if ($keywordPoints) {
			$spampoints['messageKeywords'] += $keywordPoints * $this->settings['comments']['spam']['messageKeywordsPoints'];
		}

		//blockedIps
		$ipArray = GeneralUtility::trimExplode(',', $this->settings['comments']['spam']['blockedIps'], TRUE);
		$ipBlocked = in_array($_SERVER['REMOTE_ADDR'], $ipArray);
		if ($ipBlocked) {
			$spampoints += $this->settings['comments']['spam']['ipPoints'];
		}

		return $spampoints;
	}

	/**
	 * Send Messages
	 *
	 * @param \ThomasKieslich\Efblog\Domain\Model\Post $post
	 * @param \ThomasKieslich\Efblog\Domain\Model\Comment $newComment
	 * @return mixed
	 */
	protected function sendMessage($post, $newComment) {
		$recipient = array();
		if ($this->settings['comments']['messageAuthor'] && $post->getAuthor()->count() > 0) {
			foreach ($post->getAuthor() as $author) {
				$recipient[] = $author->getEmail();
			}
		}

		if ($this->settings['comments']['messageSuperAdmin']) {
			/** @var \ThomasKieslich\Efblog\Domain\Repository\AdministratorRepository */
			$feuserRepository = $this->objectManager->get('\ThomasKieslich\Efblog\Domain\Repository\AdministratorRepository');
			/** @var \TYPO3\CMS\Extbase\Persistence\QueryInterface $superAdmins */
			$superAdmins = $feuserRepository->findByUsergroup((int)$this->settings['superAdminGroup']);
			if (isset($superAdmins) && $superAdmins->count() > 0) {
				/** @var \ThomasKieslich\Efblog\Domain\Model\Administrator $admin */
				foreach ($superAdmins as $admin) {
					$recipient[] = $admin->getEmail();
				}
			}
		}

		if (empty($recipient)) {
			return FALSE;
		}

		$sender = $this->settings['comments']['messageSender'];
		$senderName = $this->settings['comments']['messageSenderName'];
		$from = $senderName ? array($sender => $senderName) : array($sender);

		$subject = 'new Comment: ' . $post->getTitle();

		//render content
		$extbaseFrameworkConfiguration = $this->configurationManager->
		getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);

		//html Content
		$htmlContent = NULL;
		if ($this->settings['comments']['messageHtml']) {
			$htmlTemplate = $this->settings['comments']['messsageHtmlTemplate'];
			/** @var \TYPO3\CMS\Fluid\View\StandaloneView $htmlView */
			$htmlView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
			$htmlView->setFormat('html');
			$htmlView->setTemplatePathAndFilename($templateRootPath . $htmlTemplate);
			$htmlView->assignMultiple(array('newComment' => $newComment, 'post' => $post));
			$htmlContent = $htmlView->render();
		}

		//plaintext content
		$textTemplate = $this->settings['comments']['messsageTextTemplate'];
		/** @var \TYPO3\CMS\Fluid\View\StandaloneView $htmlView */
		$textView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		$textView->setFormat('txt');
		$textView->setTemplatePathAndFilename($templateRootPath . $textTemplate);
		$textView->assignMultiple(array('newComment' => $newComment, 'post' => $post));
		$plainTextContent = $textView->render();

		//Create Mail
		/** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
		$mailMessage = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');

		if ($this->settings['comments']['messageHtml']) {
			$mailMessage->setBody($htmlContent, 'text/html');
			$mailMessage->addPart($plainTextContent, 'text/plain');
		} else {
			$mailMessage->setBody($plainTextContent, 'text/plain');
		}

		$mailMessage->setSubject($subject)
				->setFrom($from)
				->setTo($recipient);

		$mailMessage->send();

		return $mailMessage->isSent();
	}
}