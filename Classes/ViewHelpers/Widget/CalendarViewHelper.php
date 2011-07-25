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

class Tx_Efblog_ViewHelpers_Widget_CalendarViewHelper extends Tx_Fluid_Core_Widget_AbstractWidgetViewHelper {

	/**
	 * @var bool
	 */
	protected $ajaxWidget = TRUE;
	/**
	 * @var Tx_Efblog_ViewHelpers_Widget_Controller_CalendarController
	 */
	protected $controller;

	/**
	 * @param Tx_Efblog_ViewHelpers_Widget_Controller_CalendarController $controller
	 * @return void
	 */
	public function injectController(Tx_Efblog_ViewHelpers_Widget_Controller_CalendarController $controller) {
		$this->controller = $controller;
	}

	/**
	 *
	 * @param Tx_Extbase_Persistence_QueryResult $objects
	 * @param string $for
	 * @param string $searchProperty
	 * @return string
	 */
	public function render(Tx_Extbase_Persistence_QueryResult $objects, $for, $day) {
		return $this->initiateSubRequest();
	}

}

?>
