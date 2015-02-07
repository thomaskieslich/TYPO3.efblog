<?php
namespace ThomasKieslich\Efblog\ViewHelpers;

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
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * ViewHelper to render meta tags.
 */
class MetaTagViewHelper extends AbstractTagBasedViewHelper {

	/**
	 * @var	string
	 */
	protected $tagName = 'meta';

	/**
	 * Arguments initialization
	 *
	 * @return void
	 */
	public function initializeArguments() {
		$this->registerTagAttribute('property', 'string', 'Property of meta tag');
		$this->registerTagAttribute('content', 'string', 'Content of meta tag');
	}


	/**
	 * Renders a meta tag
	 * @param boolean $useCurrentDomain If set, current domain is used
	 * @param boolean $forceAbsoluteUrl If set, absolute url is forced
	 * @return void
	*/
	public function render($useCurrentDomain = FALSE, $forceAbsoluteUrl = FALSE) {

			// set current domain
		if ($useCurrentDomain) {
			$this->tag->addAttribute('content', GeneralUtility::getIndpEnv('TYPO3_SITE_URL'));
		}

			// prepend current domain
		if ($forceAbsoluteUrl) {
			$path = $this->arguments['content'];
			if (!GeneralUtility::isFirstPartOfStr($path, GeneralUtility::getIndpEnv('TYPO3_SITE_URL'))) {
				$this->tag->addAttribute('content', GeneralUtility::getIndpEnv('TYPO3_SITE_URL') . $this->arguments['content']);
			}
		}

		if (isset($this->arguments['content']) && !empty($this->arguments['content'])) {
			$GLOBALS['TSFE']->getPageRenderer()->addMetaTag($this->tag->render());
		}
	}
}

?>