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
 * Controller for the Post object
 *
 * @package Efblog
 * @subpackage ViewHelpers
 */
class Tx_Efblog_ViewHelpers_Document_TitleViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * @var	tslib_cObj
	 */
	protected $contentObject;
	/**
	 * @var Tx_Extbase_Configuration_ConfigurationManagerInterface
	 */
	protected $configurationManager;

	/**
	 * @param Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager
	 * @return void
	 */
	public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManagerInterface $configurationManager) {
		$this->configurationManager = $configurationManager;
		$this->contentObject = $this->configurationManager->getContentObject();
	}

	/**
	 *
	 * @param string $mode
	 * @param string $glue 
	 * @param integer $maxCharacters
	 * @param string $append
	 * @param boolean $respectWordBoundaries
	 */
	public function render($mode = 'replace', $glue = ' - ', $maxCharacters = 0, $append = '...', $respectWordBoundaries = TRUE) {
		$renderedContent = $this->renderChildren();
		$existingTitle = $GLOBALS['TSFE']->page['title'];                
		$newTitle = '';
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
			}
			else if ($mode === 'append' && !empty($existingTitle)) {
				$newTitle = $existingTitle . $glue . $renderedContent;
			}
			else {
				$newTitle = $renderedContent;
			}
                        
			$GLOBALS['TSFE']->page['title'] = $newTitle;
			$GLOBALS['TSFE']->indexedDocTitle = $newTitle;
		}
	}

}

?>
