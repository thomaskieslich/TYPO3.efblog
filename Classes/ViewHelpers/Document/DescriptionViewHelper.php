<?php
namespace ThomasKieslich\Efblog\ViewHelpers\Document;

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

/**
 *  Description View helper
 *
 * @package Efblog
 * @subpackage ViewHelpers
 */
class DescriptionViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * replace the description
	 *
	 * @return void
	 */
	public function render() {
		$renderedContent = $this->renderChildren();
		if ($renderedContent) {
			$GLOBALS['TSFE']->pSetup['meta.']['description.'] = NULL;
			$GLOBALS['TSFE']->pSetup['meta.']['description.'] = $renderedContent;
		}
	}
}
