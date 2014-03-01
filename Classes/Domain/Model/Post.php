<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Thomas Kieslich
 *
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
 ***************************************************************/

/**
 * Model for Posts
 */
class Tx_Efblog_Domain_Model_Post extends Tx_Extbase_DomainObject_AbstractEntity {

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
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Efblog_Domain_Model_Administrator> $author
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
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Efblog_Domain_Model_Content> $content
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
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Efblog_Domain_Model_Category> $categories
	 */
	protected $categories;

	/**
	 * related post
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Efblog_Domain_Model_Post> $relatedPosts
	 */
	protected $relatedPosts;

	/**
	 * post comments
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Efblog_Domain_Model_Comment> $comments
	 */
	protected $comments;

	/**
	 *
	 * @var integer
	 */
	protected $detailUid;

	/**
	 *
	 * @var string
	 */
	protected $blogName;

	/**
	 * The constructor of this Post
	 *
	 * @return void
	 */
	public function __construct() {
		$this->initStorageObjects();
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	public function getHidden() {
		return $this->hidden;
	}

	public function setHidden($hidden) {
		$this->hidden = $hidden;
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

	public function setTeaserLink($teaserLink) {
		$this->teaserLink = $teaserLink;
	}

	public function getTeaserLinkTitle() {
		return $this->teaserLinkTitle;
	}

	public function setTeaserLinkTitle($teaserLinkTitle) {
		$this->teaserLinkTitle = $teaserLinkTitle;
	}

	/**
	 * Returns the date
	 *
	 * @return DateTime $date
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * Sets the date
	 *
	 * @param DateTime $date
	 * @return void
	 */
	public function setDate($date) {
		$this->date = $date;
	}

	/**
	 * Returns the archive
	 *
	 * @return DateTime $archive
	 */
	public function getArchive() {
		return $this->archive;
	}

	/**
	 * Returns the tags
	 *
	 * @return string $tags
	 */
	public function getTags() {
		return $this->tags;
	}

	/**
	 * Sets the tags
	 *
	 * @param string $tags
	 * @return void
	 */
	public function setTags($tags) {
		$this->tags = $tags;
	}

	/**
	 * Sets the archive
	 *
	 * @param DateTime $archive
	 * @return void
	 */
	public function setArchive($archive) {
		$this->archive = $archive;
	}

	/**
	 * Returns the allowComments
	 *
	 * @return string $allowComments
	 */
	public function getAllowComments() {
		return $this->allowComments;
	}

	/**
	 * Sets the allowComments
	 *
	 * @param string $allowComments
	 * @return void
	 */
	public function setAllowComments($allowComments) {
		$this->allowComments = $allowComments;
	}

	/**
	 * Returns the teaserOptions
	 *
	 * @return integer $teaserOptions
	 */
	public function getTeaserOptions() {
		return $this->teaserOptions;
	}

	/**
	 * Sets the teaserOptions
	 *
	 * @param integer $teaserOptions
	 * @return void
	 */
	public function setTeaserOptions($teaserOptions) {
		$this->teaserOptions = $teaserOptions;
	}

	public function getTeaserDescription() {
		return $this->teaserDescription;
	}

	public function setTeaserDescription($teaserDescription) {
		$this->teaserDescription = $teaserDescription;
	}

	/**
	 * get teaser image
	 *
	 * @return string void
	 */
	public function getTeaserImage() {
		$fileRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
		$fileObjects = $fileRepository->findByRelation('tx_efblog_domain_model_post', 'teaser_image', $this->getUid());

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
	 * Sets the teaser Image
	 *
	 * @param string $teaserImage
	 * @return void
	 */
	public function setTeaserImage($teaserImage) {
		$this->teaserImage = $teaserImage;
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
	 * Sets the views
	 *
	 * @param integer $views
	 * @return void
	 */
	public function setViews($views) {
		$this->views = $views;
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->categories = new Tx_Extbase_Persistence_ObjectStorage();
		$this->relatedPosts = new Tx_Extbase_Persistence_ObjectStorage();
		$this->content = new Tx_Extbase_Persistence_ObjectStorage();
		$this->comments = new Tx_Extbase_Persistence_ObjectStorage();
		$this->author = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Adds a Category
	 *
	 * @param Tx_Efblog_Domain_Model_Category $category
	 * @return void
	 */
	public function addCategory(Tx_Efblog_Domain_Model_Category $category) {
		$this->categories->attach($categories);
	}

	/**
	 * Removes a Category
	 *
	 * @param Tx_Efblog_Domain_Model_Category $categoryToRemove The Category to be removed
	 * @return void
	 */
	public function removeCategory(Tx_Efblog_Domain_Model_Category $categoryToRemove) {
		$this->categories->detach($categoryToRemove);
	}

	/**
	 * Returns the categories
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Efblog_Domain_Model_Category> $category
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Sets the categories
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage <Tx_Efblog_Domain_Model_Category> $category
	 * @return void
	 */
	public function setCategories($categories) {
		$this->categories = $categories;
	}

	/**
	 * Adds a Post
	 *
	 * @param Tx_Efblog_Domain_Model_Post $relatedPosts
	 * @return void
	 */
	public function addRelatedPost(Tx_Efblog_Domain_Model_Post $relatedPost) {
		$this->relatedPosts->attach($relatedPosts);
	}

	/**
	 * Removes a Post
	 *
	 * @param Tx_Efblog_Domain_Model_Post $relatedPostsToRemove The Post to be removed
	 * @return void
	 */
	public function removeRelatedPost(Tx_Efblog_Domain_Model_Post $relatedPostToRemove) {
		$this->relatedPosts->detach($relatedPostToRemove);
	}

	/**
	 * Returns the relatedPosts
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Efblog_Domain_Model_Post> $relatedPosts
	 */
	public function getRelatedPosts() {
		return $this->relatedPosts;
	}

	/**
	 * Sets the relatedPosts
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage <Tx_Efblog_Domain_Model_Post> $relatedPosts
	 * @return void
	 */
	public function setRelatedPosts($relatedPosts) {
		$this->relatedPosts = $relatedPosts;
	}

	/**
	 * Adds a Comments
	 *
	 * @param Tx_Efblog_Domain_Model_Comment $comment
	 * @return void
	 */
	public function addComment(Tx_Efblog_Domain_Model_Comment $comment) {
		$this->comments->attach($comment);
	}

	/**
	 * Removes a Comments
	 *
	 * @param Tx_Efblog_Domain_Model_Comment $commentToRemove The Comments to be removed
	 * @return void
	 */
	public function removeComment(Tx_Efblog_Domain_Model_Comment $commentToRemove) {
		$this->comments->detach($commentToRemove);
	}

	/**
	 * Returns the comments
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Efblog_Domain_Model_Comment> $comments
	 */
	public function getComments() {
		return $this->comments;
	}

	/**
	 * Sets the comments
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage <Tx_Efblog_Domain_Model_Comment> $comments
	 * @return void
	 */
	public function setComments($comments) {
		$this->comments = $comments;
	}

	/**
	 * Returns the content
	 *
	 * @return integer $content
	 */
	public function getContent() {
		return $this->content;
	}

	public function getDetailUid() {
		return $this->detailUid;
	}

	public function setDetailUid($detailUid) {
		$this->detailUid = $detailUid;
	}

	public function getBlogName() {
		return $this->blogName;
	}

	public function setBlogName($blogName) {
		$this->blogName = $blogName;
	}

	/**
	 * @param Tx_Extbase_Persistence_ObjectStorage <Tx_Efblog_Domain_Model_Administrator> $author
	 * @return void
	 */
	public function setAuthor(Tx_Efblog_Domain_Model_Administrator $author) {
		$this->author = $author;
	}

	/**
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Efblog_Domain_Model_Administrator> $author
	 */
	public function getAuthor() {
		return $this->author;
	}

	/**
	 * Sets the content
	 *
	 * @param integer $content
	 * @return void
	 */
	public function setContent($content) {
		$this->content = $content;
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

?>