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
use ThomasKieslich\Efblog\Service\AvatarService;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Post Comments
 */
class Comment extends AbstractEntity {

	/**
	 * hidden
	 *
	 * @var integer
	 */
	protected $hidden;

	/**
	 * post
	 *
	 * @var \ThomasKieslich\Efblog\Domain\Model\Post $post
	 */
	protected $post;

	/**
	 * @var string
	 * @validate NotEmpty, Text, StringLength(maximum = 120)
	 */
	protected $author;

	/**
	 * @var string
	 * @validate EmailAddress
	 */
	protected $email;

	/**
	 * @var string
	 * @validate Text
	 */
	protected $website;

	/**
	 * @var string
	 * @validate Text
	 */
	protected $location;

	/**
	 * @var string
	 * @validate NotEmpty, Text, StringLength(maximum = 250)
	 */
	protected $title;

	/**
	 * @var string
	 * @validate NotEmpty StringLength(maximum = 2000)
	 */
	protected $message;

	/**
	 * dummy field for honeypot
	 *
	 * @var string
	 */
	protected $link;

	/**
	 * @var \DateTime
	 */
	protected $date;

	/**
	 * @var integer
	 */
	protected $spampoints;

	/**
	 * @var string
	 */
	protected $spamCategories;

	/**
	 * @var string
	 */
	protected $ip;

	/**
	 * parentComment
	 *
	 * @var \ThomasKieslich\Efblog\Domain\Model\Comment $parentComment
	 */
	protected $parentComment;

	/**
	 *
	 * @var string
	 */
	protected $avatar;

	/**
	 * @return int
	 */
	public function getHidden() {
		return $this->hidden;
	}

	/**
	 * @param $hidden
	 */
	public function setHidden($hidden) {
		$this->hidden = $hidden;
	}

	/**
	 * @return \ThomasKieslich\Efblog\Domain\Model\Post
	 */
	public function getPost() {
		return $this->post;
	}

	/**
	 * Setter for author
	 *
	 * @param string $author author
	 * @return void
	 */
	public function setAuthor($author) {
		$this->author = $author;
	}

	/**
	 * Getter for author
	 *
	 * @return string author
	 */
	public function getAuthor() {
		return $this->author;
	}

	/**
	 * Setter for email
	 *
	 * @param string $email email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Getter for email
	 *
	 * @return string email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Setter for website
	 *
	 * @param string $website website
	 * @return void
	 */
	public function setWebsite($website) {
		$this->website = $website;
	}

	/**
	 * Getter for website
	 *
	 * @return string website
	 */
	public function getWebsite() {
		return $this->website;
	}

	/**
	 * Returns the location
	 *
	 * @return string $location
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * Sets the location
	 *
	 * @param string $location
	 * @return void
	 */
	public function setLocation($location) {
		$this->location = $location;
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
	 * Constructs this comment
	 */
	public function __construct() {
		$this->date = new \DateTime();
	}

	/**
	 * Setter for message
	 *
	 * @param string $message message
	 * @return void
	 */
	public function setMessage($message) {
		$this->message = $message;
	}

	/**
	 * Getter for message
	 *
	 * @return string $message
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param string $link
	 */
	public function setLink($link) {
		$this->link = $link;
	}

	/**
	 * @return string
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * Setter for date
	 *
	 * @param \DateTime $date
	 * @return void
	 */
	public function setDate($date) {
		$this->date = $date;
	}

	/**
	 * Getter for date
	 *
	 * @return \DateTime date
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @return int
	 */
	public function getSpampoints() {
		return $this->spampoints;
	}

	/**
	 * @param $spampoints
	 */
	public function setSpampoints($spampoints) {
		$this->spampoints = $spampoints;
	}

	/**
	 * Sets the spamCategories
	 *
	 * @param array $spamCategories
	 * @return void
	 */
	public function setSpamCategories($spamCategories) {
		$this->spamCategories = serialize($spamCategories);
	}

	/**
	 * @return mixed
	 */
	public function getSpamCategories() {
		return unserialize($this->spamCategories);
	}

	/**
	 * Returns the ip
	 *
	 * @return string $ip
	 */
	public function getIp() {
		return $this->ip;
	}

	/**
	 * Sets the ip
	 *
	 * @param string $ip
	 * @return void
	 */
	public function setIp($ip) {
		$this->ip = $ip;
	}

	/**
	 * Returns the parentComment
	 *
	 * @return \ThomasKieslich\Efblog\Domain\Model\Comment $parentComment
	 */
	public function getParentComment() {
		return $this->parentComment;
	}

	/**
	 * Sets the parentComment
	 *
	 * @param \ThomasKieslich\Efblog\Domain\Model\Comment $parentComment
	 * @return void
	 */
	public function setParentComment($parentComment) {
		$this->parentComment = $parentComment;
	}

	//helper
	/**
	 * @return array|null
	 */
	public function getAvatar() {
		$avatarImage = NULL;
		if ($this->email) {
			$avatarImage = AvatarService::findAvatarByEmail($this->email);
		}
		return $avatarImage;
	}
}