<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Thomas Kieslich <thomaskieslich@gmx.net>
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
 * Post
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Tkblog_Domain_Model_Post extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Title
	 *
	 * @var string $title
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * Author
	 *
	 * @var string $author
	 */
	protected $author;

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
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Tkblog_Domain_Model_Content> $content
	 */
	protected $content;

	/**
	 * allow Comments
	 *
	 * @var string $allowComments
	 */
	protected $allowComments;
	
	/**
	 * crop Teaser
	 *
	 * @var integer
	 */
	protected $cropTeaser;

	/**
	 * number of views
	 *
	 * @var integer $views
	 */
	protected $views;

	/**
	 * category
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Tkblog_Domain_Model_Category> $category
	 */
	protected $category;

	/**
	 * related post
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Tkblog_Domain_Model_Post> $relatedPost
	 */
	protected $relatedPost;

	/**
	 * The constructor of this Post
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
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

	/**
	 * Returns the author
	 *
	 * @return string $author
	 */
	public function getAuthor() {
		return $this->author;
	}

	/**
	 * Sets the author
	 *
	 * @param string $author
	 * @return void
	 */
	public function setAuthor($author) {
		$this->author = $author;
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
	 * Returns the cropTeaser
	 *
	 * @return integer $cropTeaser
	 */
	public function getCropTeaser() {
		return $this->cropTeaser;
	}

	/**
	 * Sets the cropTeaser
	 *
	 * @param integer $cropTeaser
	 * @return void
	 */
	public function setCropTeaser($cropTeaser) {
		$this->cropTeaser = $cropTeaser;
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
		/**
		* Do not modify this method!
		* It will be rewritten on each save in the kickstarter
		* You may modify the constructor of this class instead
		*/
		$this->category = new Tx_Extbase_Persistence_ObjectStorage();
		$this->relatedPost = new Tx_Extbase_Persistence_ObjectStorage();
		$this->content = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Adds a Category
	 *
	 * @param Tx_Tkblog_Domain_Model_Categoryegory $category
	 * @return void
	 */
	public function addCategory(Tx_Tkblog_Domain_Model_Category $category) {
		$this->category->attach($category);
	}

	/**
	 * Removes a Category
	 *
	 * @param Tx_Tkblog_Domain_Model_Categoryegory $categoryegoryToRemove The Categoryegory to be removed
	 * @return void
	 */
	public function removeCategory(Tx_Tkblog_Domain_Model_Category $categoryToRemove) {
		$this->category->detach($categoryToRemove);
	}

	/**
	 * Returns the category
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Tkblog_Domain_Model_Category> $category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets the category
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Tkblog_Domain_Model_Category> $category
	 * @return void
	 */
	public function setCategory($category) {
		$this->category = $category;
	}

	/**
	 * Adds a Post
	 *
	 * @param Tx_Tkblog_Domain_Model_Post $relatedPost
	 * @return void
	 */
	public function addRelatedPost(Tx_Tkblog_Domain_Model_Post $relatedPost) {
		$this->relatedPost->attach($relatedPost);
	}

	/**
	 * Removes a Post
	 *
	 * @param Tx_Tkblog_Domain_Model_Post $relatedPostToRemove The Post to be removed
	 * @return void
	 */
	public function removeRelatedPost(Tx_Tkblog_Domain_Model_Post $relatedPostToRemove) {
		$this->relatedPost->detach($relatedPostToRemove);
	}

	/**
	 * Returns the relatedPost
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Tkblog_Domain_Model_Post> $relatedPost
	 */
	public function getRelatedPost() {
		return $this->relatedPost;
	}

	/**
	 * Sets the relatedPost
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Tkblog_Domain_Model_Post> $relatedPost
	 * @return void
	 */
	public function setRelatedPost($relatedPost) {
		$this->relatedPost = $relatedPost;
	}
	
	/**
	 * Returns the content
	 *
	 * @return integer $content
	 */
	public function getContent() {
		return $this->content;
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
	
	public function getYearOf() {
		return $this->date->format('Y');
	}
	
	public function getMonthOf() {
		return $this->date->format('m');
	}

}
?>