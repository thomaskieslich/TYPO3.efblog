<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Kieslich <thomas.kieslich@gmail.com> *  	
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * Controller for the Comments object
 * 
 * @package Efblog
 * @subpackage Controller
 */
class Tx_Efblog_Controller_CommentController extends Tx_Efblog_Controller_AbstractController {

    /**
     * @var Tx_Efblog_Domain_Repository_CommentRepository
     */
    protected $commentRepository;

    /**
     *
     * @param Tx_Efblog_Domain_Repository_CommentRepository $commentRepository 
     * @return void
     */
    public function injectCommentRepository(Tx_Efblog_Domain_Repository_CommentRepository $commentRepository) {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Adds a comment to a blog post and redirects to detail view
     * @param Tx_Efblog_Domain_Model_Post $post
     * @param Tx_Efblog_Domain_Model_Comment $newComment 
     * @return void
     */
    public function createAction(Tx_Efblog_Domain_Model_Post $post, Tx_Efblog_Domain_Model_Comment $newComment) {
        if ($this->settings['comments']['allowComments'] == 1) {
            $spamcategories = $this->checkForSpam($newComment);
            $newComment->setIp($_SERVER['REMOTE_ADDR']);
            $newComment->setSpamCategories($spamcategories);

            $spampoints = 0;
            foreach ($spamcategories as $key => $value) {
                $spampoints += $value;
            }
            $newComment->setSpampoints($spampoints);

            if ($spampoints > $this->settings['comments']['spam']['spampointsToHide']) {
                $newComment->setHidden(1);
            }
            if ($spampoints < $this->settings['comments']['spam']['spampointsToDie']) {
                $post->addComment($newComment);
            }


            if ($this->settings['comments']['messageAuthor'] || $this->settings['comments']['messageSuperAdmin']) {
                if ($this->settings['comments']['messageAllSpam']) {
                    $this->sendMessage($post, $newComment);
                } elseif ($spampoints < $this->settings['comments']['spam']['spampointsToDie']) {
                    $this->sendMessage($post, $newComment);
                }
            }

            $this->flashMessageContainer->add('Your new Comments was created.');
        }

        $this->redirect('detail', 'Post', NULL, array('post' => $post));
    }

    public function latestCommentsWidgetAction() {
        $this->view->assign('comments', $this->commentRepository->findLatestComments($this->settings));
    }

    protected function checkForSpam($newComment) {
        $spampoints = array();

        //check dummy field
        $dummyField = t3lib_div::_POST('tx_efblog_fe');
        if ($dummyField[newComment][link]) {
            $spampoints['dummy'] = 100;
        }

        //author
        $author = t3lib_div::strtolower($newComment->getAuthor());
        $authorKeywords = t3lib_div::trimExplode(',', $this->settings['comments']['spam']['authorKeywords'], TRUE);
        $authorPoints = 0;
        foreach ($authorKeywords as $keyword) {
            $authorPoints += substr_count($author, $keyword);
        }
        if ($authorPoints) {
            $spampoints[authorPoints] = $authorPoints * $this->settings['comments']['spam']['authorKeywordsPoints'];
        }


        //email
        $email = t3lib_div::strtolower($newComment->getEmail());
        if ($email && !substr_count($email, '@')) {
            $spampoints[emailNoAt] = (int) $this->settings['comments']['spam']['emailNoAtPoints'];
        }

        //website
        $websiteLength = strlen($newComment->getWebsite());
        if ($websiteLength > $this->settings['comments']['spam']['websiteLength']) {
            $spampoints[websiteLength] += $websiteLength - $this->settings['comments']['spam']['websiteLengthPoints'];
        }

        //location
        $location = t3lib_div::strtolower($newComment->getLocation());
        $locationKeywords = t3lib_div::trimExplode(',', $this->settings['comments']['spam']['locationKeywords'], TRUE);
        $locationPoints = 0;
        foreach ($locationKeywords as $keyword) {
            $locationPoints += substr_count($location, $keyword);
        }
        if ($locationPoints) {
            $spampoints[locationPoints] = $locationPoints * $this->settings['comments']['spam']['locationKeywordsPoints'];
        }

        //title
        $title = t3lib_div::strtolower($newComment->getTitle());
        $titleKeywords = t3lib_div::trimExplode(',', $this->settings['comments']['spam']['titleKeywords'], TRUE);
        $titlePoints = 0;
        foreach ($titleKeywords as $keyword) {
            $titlePoints += substr_count($title, $keyword);
        }
        if ($titlePoints) {
            $spampoints[titlePoints] = $titlePoints * $this->settings['comments']['spam']['titleKeywordsPoints'];
        }

        //message
        $message = t3lib_div::strtolower($newComment->getMessage());

        //message length
        $messageLength = strlen($message);
        if ($messageLength < $this->settings['comments']['spam']['messageLength']) {
            $spampoints[messageLength] += $this->settings['comments']['spam']['messageLengthPoints'];
        }

        //message start with
        $messageArray = t3lib_div::trimExplode(' ', $message, TRUE, 500);
        $messageStartWith = t3lib_div::strtolower($this->settings['comments']['spam']['messageStartWith']);
        $messageStartWords = t3lib_div::trimExplode(',', $messageStartWith, TRUE);
        $firstWord = in_array($messageArray[0], $messageStartWords);
        if ($firstWord) {
            $spampoints[messageStartWith] += $this->settings['comments']['spam']['messageStartWithPoints'];
        }

        //message Keyword search 		
        $keywords = t3lib_div::trimExplode(',', $this->settings['comments']['spam']['messageKeywords'], TRUE);
        $keywordPoints = 0;
        foreach ($keywords as $keyword) {
            $keywordPoints += substr_count($message, $keyword);
        }
        if ($keywordPoints) {
            $spampoints[messageKeywords] += $keywordPoints * $this->settings['comments']['spam']['messageKeywordsPoints'];
        }

        //blockedIps
        $ipArray = t3lib_div::trimExplode(',', $this->settings['comments']['spam']['blockedIps'], TRUE);
        $ipBlocked = in_array($_SERVER['REMOTE_ADDR'], $ipArray);
        if ($ipBlocked) {
            $spampoints += $this->settings['comments']['spam']['ipPoints'];
        }

        return $spampoints;
    }

    protected function sendMessage($post, $newComment) {
        $recipient = array();
        if ($this->settings['comments']['messageAuthor'] && $post->getAuthor()->count() > 0) {
            foreach ($post->getAuthor() as $author) {
                $recipient[] = $author->getEmail();
            }
        }

        if ($this->settings['comments']['messageSuperAdmin']) {
            $feuserRepository = $this->objectManager->get('Tx_Efblog_Domain_Repository_AdministratorRepository');
            $superAdmins = $feuserRepository->findByUsergroup((int) $this->settings['superAdminGroup']);
            if ($superAdmins->count() > 0) {
                foreach ($superAdmins as $admin) {
                    $recipient[] = $admin->getEmail();
                }
            }
        }


        $sender = $this->settings['comments']['messageSender'];
        $senderName = $this->settings['comments']['messageSenderName'];
        $from = $senderName ? array($sender => $senderName) : array($sender);

        $subject = 'new Comment: ' . $post->getTitle();

        //render content
        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $templateRootPath = t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);

        //html Content
        if ($this->settings['comments']['messageHtml']) {
            $htmlTemplate = $this->settings['comments']['messsageHtmlTemplate'];
            $htmlView = $this->objectManager->create('Tx_Fluid_View_StandaloneView');
            $htmlView->setFormat('html');
            $htmlView->setTemplatePathAndFilename($templateRootPath . $htmlTemplate);
            $htmlView->assignMultiple(array('newComment' => $newComment, 'post' => $post));
            $htmlContent = $htmlView->render();
        }


        //plaintext content
        $textTemplate = $this->settings['comments']['messsageTextTemplate'];
        $textView = $this->objectManager->create('Tx_Fluid_View_StandaloneView');
        $textView->setFormat('txt');
        $textView->setTemplatePathAndFilename($templateRootPath . $textTemplate);
        $textView->assignMultiple(array('newComment' => $newComment, 'post' => $post));
        $plainTextContent = $textView->render();

        //Create Mail
        $mailMessage = t3lib_div::makeInstance('t3lib_mail_Message');

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

?>