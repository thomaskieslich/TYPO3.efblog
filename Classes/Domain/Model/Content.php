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
 * Post
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Tkblog_Domain_Model_Content extends Tx_Extbase_DomainObject_AbstractEntity {

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
	 * @api
	 */
	public function getImage() {
		return explode(',', $this->image);
	}
	
	public function getCtype() {
		return $this->ctype;
	}



}

?>
