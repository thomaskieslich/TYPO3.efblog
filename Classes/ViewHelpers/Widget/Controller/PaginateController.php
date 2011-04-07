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
 * Pager
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Tkblog_ViewHelpers_Widget_Controller_PaginateController extends Tx_Fluid_Core_Widget_AbstractWidgetController {

	/**
	 * @var array
	 */
	protected $configuration = array ('itemsPerPage' => 10, 'insertAbove' => FALSE, 'insertBelow' => TRUE, 'maxPages' => 5, 'maxItems' => 5);
	/**
	 * @var Tx_Extbase_Persistence_QueryResultInterface
	 */
	protected $objects;
	/**
	 * @var integer
	 */
	protected $currentPage = 1;
	/**
	 * @var integer
	 */
	protected $numberOfPages = 1;
	/**
	 * @var integer
	 */
	protected $maxPages = 5;
	
	/**
	 * @var integer
	 */
	protected $maxItems = 5;

	/**
	 * @return void
	 */
	public function initializeAction() {
		$this->objects = $this->widgetConfiguration['objects'];
		$this->configuration = t3lib_div::array_merge_recursive_overrule($this->configuration, $this->widgetConfiguration['configuration'], TRUE);
		$this->numberOfPages = ceil(count($this->objects) / (integer) $this->configuration['itemsPerPage']);
		$this->maxPages = (integer) $this->configuration['maxPages'];
		$this->maxItems = (integer) $this->configuration['maxItems'];
	}

	/**
	 * @param mixed $currentPage
	 * @return void
	 */
	public function indexAction($currentPage = 1) {
		// set current page
		$this->currentPage = (integer) $currentPage;
		if ($this->currentPage < 1) {
			$this->currentPage = 1;
		}
		elseif ($this->currentPage > $this->numberOfPages) {
			$this->currentPage = $this->numberOfPages;
		}

		// modify query
		$itemsPerPage = (integer) $this->configuration['itemsPerPage'];
		$query = $this->objects->getQuery();
		if ($this->maxItems > 0) {
			$query->setLimit((int)min($itemsPerPage, $this->settings['listView']['maxEntries']));
		}
		else{
			$query->setLimit($itemsPerPage);
		}
		
		if ($this->currentPage > 1) {
			$query->setOffset((integer) ($itemsPerPage * ($this->currentPage - 1)));
		}
		$modifiedObjects = $query->execute();

		$this->view->assign('contentArguments', array (
			$this->widgetConfiguration['as'] => $modifiedObjects
		));
		$this->view->assign('configuration', $this->configuration);
		$this->view->assign('pagination', $this->buildPager());
	}

	/**
	 * Returns an array with the keys "pages", "current", "numberOfPages", "nextPage" & "previousPage"
	 *
	 * @return array
	 */
	protected function buildPager() {
		$pages = array ();
		$start = 1;
		if($this->numberOfPages > $this->maxPages){
			$start = min($this->currentPage, $this->numberOfPages - $this->maxPages + 1);
		}
		$end = min($this->numberOfPages, $this->currentPage + $this->maxPages - 1);
		for ($i = $start; $i <= $end; $i++) {
			$pages[] = array ('number' => $i, 'isCurrent' => ($i == $this->currentPage));
		}

		$pagination = array (
			'pages' => $pages,
			'current' => $this->currentPage,
			'numberOfPages' => $this->numberOfPages
		);
		if ($this->currentPage < $this->numberOfPages) {
			$pagination['nextPage'] = $this->currentPage + 1;
		}
		if ($this->currentPage > 1) {
			$pagination['previousPage'] = $this->currentPage - 1;
		}
		return $pagination;		
	}

}

?>
