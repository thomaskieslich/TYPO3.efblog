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
 * Category
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */

 class Tx_Tkblog_Domain_Model_Category extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * title
	 *
	 * @var string $title
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * category description
	 *
	 * @var string $description
	 */
	protected $description;

	/**
	 * parentCategory
	 *
	 * @var Tx_Tkblog_Domain_Model_Category $parentCategory
	 */
	protected $parentCategory;

	/**
	 * The constructor of this Category
	 *
	 * @return void
	 */
	public function __construct() {

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
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the parentCategory
	 *
	 * @return Tx_Tkblog_Domain_Model_Category $parentCategory
	 */
	public function getParentCategory() {
		return $this->parentCategory;
	}

	/**
	 * Sets the parentCategory
	 *
	 * @param Tx_Tkblog_Domain_Model_Category $parentCategory
	 * @return void
	 */
	public function setParentCategory($parentCategory) {
		$this->parentCategory = $parentCategory;
	}

}
?>