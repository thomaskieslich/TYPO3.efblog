<?php
namespace ThomasKieslich\Efblog\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011-2014 Thomas Kieslich
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
 * Content Elements
 */
class Content extends AbstractEntity {

	/**
	 * Header
	 *
	 * @var string $header
	 */
	protected $header;

	/**
	 * Body text
	 *
	 * @var string $bodytext
	 */
	protected $bodytext;

	/**
	 * image
	 *
	 * @var string $image
	 */
	protected $image;

	/**
	 * ctype
	 *
	 * @var string $ctype
	 */
	protected $ctype;

	public function getHeader() {
		return $this->header;
	}

	public function getBodytext() {
		return $this->bodytext;
	}

	/**
	 * Returns the image value
	 *
	 * @return string
	 */
	public function getImage() {
		$fileRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
		$fileObjects = $fileRepository->findByRelation('tx_efblog_domain_model_category', 'tx_efblog_domain_model_category_image', $this->getUid());

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

	public function getCtype() {
		return $this->ctype;
	}
}