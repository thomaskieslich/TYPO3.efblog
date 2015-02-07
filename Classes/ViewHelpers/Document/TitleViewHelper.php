<?php
namespace ThomasKieslich\Efblog\ViewHelpers\Document;

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
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Title ViewHelper
 *
 * @package Efblog
 * @subpackage ViewHelpers
 */
class TitleViewHelper extends AbstractViewHelper {

	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 * @inject
	 */
	protected $configurationManager;

	/**
	 * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
	 */
	protected $contentObject;

	/**
	 *
	 * @param string $mode
	 * @param string $glue
	 * @param integer $maxCharacters
	 * @param string $append
	 * @param boolean $respectWordBoundaries
	 *
	 * @return void
	 */
	public function render($mode = 'replace', $glue = ' - ', $maxCharacters = 0, $append = '...', $respectWordBoundaries = TRUE) {
		$this->contentObject = $this->configurationManager->getContentObject();
		$renderedContent = $this->renderChildren();
		$existingTitle = $GLOBALS['TSFE']->page['title'];
		if ($renderedContent) {
			//reset noPageTitle
			if ($GLOBALS['TSFE']->config['config']['noPageTitle'] > 0) {
				$GLOBALS['TSFE']->config['config']['noPageTitle'] = 0;
			}

			//crop existing Title
			if ($maxCharacters > 0) {
				$existingTitle = $this->contentObject->crop($existingTitle, $maxCharacters . '|' . $append . '|' . $respectWordBoundaries);
			}

			if ($mode === 'prepend' && !empty($existingTitle)) {
				$newTitle = $renderedContent . $glue . $existingTitle;
			} elseif ($mode === 'append' && !empty($existingTitle)) {
				$newTitle = $existingTitle . $glue . $renderedContent;
			} else {
				$newTitle = $renderedContent;
			}

			$GLOBALS['TSFE']->page['title'] = $newTitle;
			$GLOBALS['TSFE']->indexedDocTitle = $newTitle;
		}
	}
}
