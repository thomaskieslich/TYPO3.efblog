<?php
namespace ThomasKieslich\Efblog\ViewHelpers\Format;

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
 * Renders the value (or - if omitted - the child nodes) without applying fluid interceptors
 * This is useful if you want to output raw HTML code that is not processed by htmlentities()
 *
 * = Examples =
 *
 * <code title="Defaults">
 * <f:format.raw value="{someContent}" />
 * </code>
 * <output>
 * <p>content</p>
 * (depending on the value of {someContent})
 * </output>
 *
 * <code title="Inline notation">
 * {someContent -> f:format.raw()}
 * </code>
 * <output>
 * <p>content</p>
 * (depending on the value of {someContent})
 * </output>
 *
 * @package Efblog
 * @subpackage ViewHelpers
 */
class RawViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * Disable Fluid interceptors for this ViewHelper
	 * @var boolean
	 */
	protected $escapingInterceptorEnabled = FALSE;

	/**
	 * @param mixed $value The value to output
	 * @return string
	 */
	public function render($value = NULL) {
		if ($value === NULL) {
			return $this->renderChildren();
		} else {
			return $value;
		}
	}

}
?>
