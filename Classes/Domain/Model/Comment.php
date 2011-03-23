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
 * Comments
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Tkblog_Domain_Model_Comment extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * author
	 *
	 * @var string $author
	 */
	protected $author;

	/**
	 * email
	 *
	 * @var string $email
	 */
	protected $email;

	/**
	 * website
	 *
	 * @var string $website
	 */
	protected $website;

	/**
	 * date
	 *
	 * @var DateTime $date
	 */
	protected $date;

	/**
	 * comment
	 *
	 * @var string $comment
	 */
	protected $comment;

	/**
	 * approved
	 *
	 * @var integer
	 */
	protected $approved;

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
	 * Setter for date
	 *
	 * @param DateTime $date date
	 * @return void
	 */
	public function setDate(DateTime $date) {
		$this->date = $date;
	}

	/**
	 * Getter for date
	 *
	 * @return DateTime date
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * Setter for comment
	 *
	 * @param string $comment comment
	 * @return void
	 */
	public function setComment($comment) {
		$this->comment = $comment;
	}

	/**
	 * Getter for comment
	 *
	 * @return string comment
	 */
	public function getComment() {
		return $this->comment;
	}

	/**
	 * Returns the approved
	 *
	 * @return string $approved
	 */
	public function getApproved() {
		return $this->approved;
	}

	/**
	 * Sets the approved
	 *
	 * @param string $approved
	 * @return void
	 */
	public function setApproved($approved) {
		$this->location = $approved;
	}


}
?>