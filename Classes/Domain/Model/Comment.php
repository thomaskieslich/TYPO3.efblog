<?php

/* * *************************************************************
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
 * ************************************************************* */

/**
 * Comments
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Efblog_Domain_Model_Comment extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * hidden
	 *
	 * @var integer
	 */
	protected $hidden;
	/**
	 * post
	 *
	 * @var string $post
	 */
	protected $post;
	/**
	 * @var string
	 * @validate NotEmpty
	 * @validate StringLength(maximum = 120)
	 */
	protected $author;
	/**
	 * @var string
	 */
	protected $email;
	/**
	 * @var string
	 */
	protected $website;
	/**
	 * @var string
	 */
	protected $location;
	/**
	 * @var string
	 * @validate NotEmpty
	 * @validate StringLength(maximum = 120)
	 */
	protected $title;
	/**
	 * @var string
	 * @validate NotEmpty
	 * @validate StringLength(maximum = 1200)
	 */
	protected $message;
	/**
	 * @var DateTime
	 */
	protected $date;
	/**
	 * @var integer
	 */
	protected $spampoints;
	/**
	 * @var integer
	 */
	protected $ip;
	/**
	 * parentComment
	 *
	 * @var Tx_Efblog_Domain_Model_Comment $parentComment
	 */
	protected $parentComment;
	/**
	 *
	 * @var string
	 */
	protected $avatar;



	public function getHidden () {
		return $this->hidden;
	}

	public function setHidden ($hidden) {
		$this->hidden = $hidden;
	}
	
	public function getPost () {
		return $this->post;
	}

	
	/**
	 * Setter for author
	 *
	 * @param string $author author
	 * @return void
	 */
	public function setAuthor ($author) {
		$this->author = $author;
	}

	/**
	 * Getter for author
	 *
	 * @return string author
	 */
	public function getAuthor () {
		return $this->author;
	}

	/**
	 * Setter for email
	 *
	 * @param string $email email
	 * @return void
	 */
	public function setEmail ($email) {
		$this->email = $email;
	}

	/**
	 * Getter for email
	 *
	 * @return string email
	 */
	public function getEmail () {
		return $this->email;
	}

	/**
	 * Setter for website
	 *
	 * @param string $website website
	 * @return void
	 */
	public function setWebsite ($website) {
		$this->website = $website;
	}

	/**
	 * Getter for website
	 *
	 * @return string website
	 */
	public function getWebsite () {
		return $this->website;
	}

	/**
	 * Returns the location
	 *
	 * @return string $location
	 */
	public function getLocation () {
		return $this->location;
	}

	/**
	 * Sets the location
	 *
	 * @param string $location
	 * @return void
	 */
	public function setLocation ($location) {
		$this->location = $location;
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle () {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle ($title) {
		$this->title = $title;
	}

	/**
	 * Constructs this comment
	 */
	public function __construct () {
		$this->date = new DateTime();
	}

	/**
	 * Setter for message
	 *
	 * @param string $message message
	 * @return void
	 */
	public function setMessage ($message) {
		$this->message = $message;
	}

	/**
	 * Getter for message
	 *
	 * @return string $message
	 */
	public function getMessage () {
		return $this->message;
	}

	/**
	 * Setter for date
	 *
	 * @param DateTime $date date
	 * @return void
	 */
	public function setDate (DateTime $date) {
		$this->date = $date;
	}

	/**
	 * Getter for date
	 *
	 * @return DateTime date
	 */
	public function getDate () {
		return $this->date;
	}

	/**
	 * Sets the spampoints
	 *
	 * @param integer $spampoints
	 * @return void
	 */
	public function setSpampoints ($spampoints) {
		$this->spampoints = $spampoints;
	}

	public function getSpampoints () {
		return $this->spampoints;
	}

	/**
	 * Returns the ip
	 *
	 * @return string $ip
	 */
	public function getIp () {
		return $this->ip;
	}

	/**
	 * Sets the ip
	 *
	 * @param string $ip
	 * @return void
	 */
	public function setIp ($ip) {
		$this->ip = $ip;
	}

	/**
	 * Returns the parentComment
	 *
	 * @return Tx_Efblog_Domain_Model_Comment $parentComment
	 */
	public function getParentComment () {
		return $this->parentComment;
	}

	/**
	 * Sets the parentComment
	 *
	 * @param Tx_Efblog_Domain_Model_Comment $parentComment
	 * @return void
	 */
	public function setParentComment ($parentComment) {
		$this->parentComment = $parentComment;
	}

	/**
	 * Returns the child comments
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Efblog_Domain_Model_Comment> $children
	 */
	public function getChildren () {
		$commentRepository = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager')->get('Tx_Efblog_Domain_Repository_CommentRepository');
		$children = $commentRepository->findAllChildren($this);
		return clone $children;
	}

	//helper
	public function getAvatar () {
		$avatarImage = NULL;
		if ($this->email) {
			$avatarImage = Tx_Efblog_Service_AvatarService::findAvatarByEmail($this->email);
		}
		return $avatarImage;
	}

}

?>