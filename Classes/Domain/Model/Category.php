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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Post Category
 */
class Category extends AbstractEntity {

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
	 * category image
	 *
	 * @var string $image
	 */
	protected $image;

	/**
	 * parentCategory
	 *
	 * @var \ThomasKieslich\Efblog\Domain\Model\Category $parentCategory
	 */
	protected $parentCategory;

	/**
	 * children
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThomasKieslich\Efblog\Domain\Model\Category> $children
	 */
	protected $children;

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
	 * category image
	 *
	 * @return string $image
	 */
	public function getImage() {
		$fileRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
		$fileObjects = $fileRepository->findByRelation('tx_efblog_domain_model_category',
				'tx_efblog_domain_model_category_image',
				$this->getUid());

		return $fileObjects;
	}

	/**
	 * set image
	 *
	 * @param string $image
	 */
	public function setImage($image) {
		$this->image = $image;
	}

	/**
	 * Returns the parentCategory
	 *
	 * @return \ThomasKieslich\Efblog\Domain\Model\Category $parentCategory
	 */
	public function getParentCategory() {
		return $this->parentCategory;
	}

	/**
	 * Sets the parentCategory
	 *
	 * @param \ThomasKieslich\Efblog\Domain\Model\Category $parentCategory
	 * @return void
	 */
	public function setParentCategory($parentCategory) {
		$this->parentCategory = $parentCategory;
	}
}