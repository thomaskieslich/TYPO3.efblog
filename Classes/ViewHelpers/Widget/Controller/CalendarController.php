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
 * Controller for Calendar Widget
 * 
 * @package Efblog
 * @subpackage ViewHelpers 
 */

class Tx_Efblog_ViewHelpers_Widget_Controller_CalendarController extends Tx_Fluid_Core_Widget_AbstractWidgetController {

	/**
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('id', $this->widgetConfiguration['for']);
	}
	
	public function calendarAction($term) {
		$day = $this->widgetConfiguration['day'];
		var_dump($day);
		$output = 'Tag'.$day;
		return $output;
		#return json_encode($output);
	}
	
}

?>
