<?php
namespace ThomasKieslich\Efblog\Domain\Model;

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
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Model for Posts
 */
class Post extends AbstractEntity {

	/**
	 * Title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * hidden
	 *
	 * @var string
	 */
	protected $hidden;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasKieslich\Efblog\Domain\Model\Administrator> $author
	 */
	protected $author;

	/**
	 * Teaserlink
	 *
	 * @var string $teaserLink
	 */
	protected $teaserLink;

	/**
	 * Teaserlink Title
	 *
	 * @var string $teaserLinkTitle
	 */
	protected $teaserLinkTitle;

	/**
	 * Tags
	 *
	 * @var string $tags
	 */
	protected $tags;

	/**
	 * start date
	 *
	 * @var DateTime $date
	 */
	protected $date;

	/**
	 * archive date
	 *
	 * @var DateTime $archive
	 */
	protected $archive;

	/**
	 * CE Element
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasKieslich\Efblog\Domain\Model\Content> $content
	 */
	protected $content;

	/**
	 * allow Comments
	 *
	 * @var string $allowComments
	 */
	protected $allowComments;

	/**
	 * Teaser Options
	 *
	 * @var integer
	 */
	protected $teaserOptions;

	/**
	 * Teaser description
	 *
	 * @var string
	 */
	protected $teaserDescription;

	/**
	 * Teaser image
	 *
	 * @var array
	 */
	protected $teaserImage;

	/**
	 * number of views
	 *
	 * @var integer $views
	 */
	protected $views;

	/**
	 * categories
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasKieslich\Efblog\Domain\Model\Category> $categories
	 * @lazy
	 */
	protected $categories;

	/**
	 * related post
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasKieslich\Efblog\Domain\Model\Post> $relatedPosts
	 */
	protected $relatedPosts;

	/**
	 * post comments
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasKieslich\Efblog\Domain\Model\Comment> $comments
	 * @lazy
	 */
	protected $comments;

	/**
	 * Detail Uid
	 *
	 * @var integer
	 */
	protected $detailUid;

	/**
	 * Blog Name
	 *
	 * @var string
	 */
	protected $blogName;

	public function getTitle() {
		return $this->title;
	}

	public function getHidden() {
		return $this->hidden;
	}

	public function getTeaserLink() {
		$link = explode(' ', $this->teaserLink);
		if (count($link) == 1) {
			$link['link'] = $link[0];
		} else {
			$link['link'] = $link[0];
			$link['target'] = $link[1];
		}

		return $link;
	}

	public function getTeaserLinkTitle() {
		return $this->teaserLinkTitle;
	}

	public function getDate() {
		return $this->date;
	}

	public function getArchive() {
		return $this->archive;
	}

	public function getTags() {
		return $this->tags;
	}

	public function getAllowComments() {
		return $this->allowComments;
	}

	public function getTeaserOptions() {
		return $this->teaserOptions;
	}

	public function getTeaserDescription() {
		return $this->teaserDescription;
	}

	/**
	 * get teaser image
	 *
	 * @return string void
	 */
	public function getTeaserImage() {
		$fileRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
		$fileObjects = $fileRepository->findByRelation('tx_efblog_domain_model_post', 'tx_efblog_domain_model_post_teaser_image', $this->getUid());

		$files = array();
		foreach ($fileObjects as $file) {
			$original = $file->getOriginalFile()->getProperties();
			$reference = $file->getReferenceProperties();

			$title = $reference['title'];
			if (!$title) {
				$title = $original['title'];
			}

			$description = $reference['description'];
			if (!description) {
				$description = $original['description'];
			}

			$files[] = array(
					'title' => $title,
					'description' => $description,
					'publicUrl' => $file->getPublicUrl(TRUE)
			);
		}

		return $files;
	}

	/**
	 * Returns the views
	 *
	 * @return integer $views
	 */
	public function getViews() {
		return $this->views;
	}

	/**
	 * @param int $views
	 */
	public function setViews($views) {
		$this->views = $views;
	}

	/**
	 * Returns the categories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasKieslich\Efblog\Domain\Model\Category> $categories
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Returns the relatedPosts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasKieslich\Efblog\Domain\Model\Post> $relatedPosts
	 */
	public function getRelatedPosts() {
		return $this->relatedPosts;
	}

	/**
	 * @param \ThomasKieslich\Efblog\Domain\Model\Comment $comment
	 */
	public function addComment(\ThomasKieslich\Efblog\Domain\Model\Comment $comment) {
		$this->comments->attach($comment);
	}

	/**
	 * Returns the comments
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasKieslich\Efblog\Domain\Model\Comment> $comments
	 */
	public function getComments() {
		return $this->comments;
	}

	/**
	 * Returns the content
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasKieslich\Efblog\Domain\Model\Content> $content
	 */
	public function getContent() {
		return $this->content;
	}

	public function getDetailUid() {
		return $this->detailUid;
	}

	/**
	 * @param int $detailUid
	 */
	public function setDetailUid($detailUid) {
		$this->detailUid = $detailUid;
	}

	public function getBlogName() {
		return $this->blogName;
	}

	/**
	 * @param string $blogName
	 */
	public function setBlogName($blogName) {
		$this->blogName = $blogName;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasKieslich\Efblog\Domain\Model\Administrator> $author
	 */
	public function getAuthor() {
		return $this->author;
	}

	//Helper
	public function getYearOf() {
		return $this->date->format('Y');
	}

	public function getMonthOf() {
		return $this->date->format('m');
	}

	public function getDayOf() {
		return $this->date->format('d');
	}
}