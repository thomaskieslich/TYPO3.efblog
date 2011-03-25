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
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class tx_Tkblog_Hooks_T3libBefunc {

	/**
	 * Hook function of t3lib_befunc
	 * It is used to change the flexform if it is about tkblog
	 *
	 * @param type $dataStructure Flexform structure
	 * @param type $conf some strange configuration
	 * @param type $row row of current record
	 * @param type $table table anme
	 * @param type $fieldName some strange field name
	 * @return void
	 */
	public function getFlexFormDS_postProcessDS(&$dataStructure, $conf, $row, $table, $fieldName) {
		if ($table === 'tt_content' && $row['list_type'] === 'tkblog_fe1' && is_array($dataStructure)) {
			$this->updateFlexforms($dataStructure, $row);
		}
	}

	/**
	 * Update flexform configuration if a action is selected
	 *
	 * @param array|string $dataStructure flexform structur
	 * @param array $row row of current record
	 * @return void
	 */
	protected function updateFlexforms(array &$dataStructure, array $row) {
		$selectedView = 'Post->list';
		// get the first selected action
		$flexformSelection = t3lib_div::xml2array($row['pi_flexform']);
		if (is_array($flexformSelection) && is_array($flexformSelection['data'])) {
			$selectedView = $flexformSelection['data']['general']['lDEF']['switchableControllerActions']['vDEF'];
			if (!empty($selectedView)) {
				$actionParts = t3lib_div::trimExplode(';', $selectedView, TRUE);
				$selectedView = $actionParts[0];
			}
		}
		elseif (t3lib_div::isFirstPartOfStr($row['uid'], 'NEW')) {
			// use List as starting view
			// @todo dynamic check, getting view from $flexformSelection
			$selectedView = 'Post->list';
		}

		if (!empty($selectedView)) {
			// modify the flexform structure depending on the first found action
			switch ($selectedView) {
				case 'Post->list':
					$this->updateForListAction($dataStructure);
					break;
				case 'Post->detail':
					$this->updateForDetailAction($dataStructure);
					break;
                                case 'Post->searchView':
					$this->updateForSearchViewAction($dataStructure);
					break;
                                case 'Post->categoryView':
					$this->updateForCategoryViewAction($dataStructure);
					break;
				case 'Post->latestWidget':
					$this->updateForLatestWidgetAction($dataStructure);
					break;
				case 'Post->viewsWidget':
					$this->updateForViewsWidgetAction($dataStructure);
					break;
				case 'Post->categoryWidget':
					$this->updateForCategoryWidgetAction($dataStructure);
					break;
				case 'Post->searchWidget':
					$this->updateForSearchWidgetAction($dataStructure);
					break;
				case 'Post->dateMenuWidget':
					$this->updateForDateMenuWidgetAction($dataStructure);
					break;
			}
		}
	}
	
	/**
	 * Change flexform for News->detail which is the single view of a news record
	 *
	 * @param array $dataStructure flexform structure
	 * @return void
	 */
	protected function updateForListAction(array &$dataStructure) {
		$fieldsToBeRemoved = array (
			'latestWidget' => 'maxEntrys,cropLink,showViews',
			'viewsWidget' => 'maxEntrys,cropLink',
			'categoryWidget' => 'cropLink,viewCounts,viewEmpty',
			'target' => 'listUid'
		);
		$this->deleteFromStructure($dataStructure, $fieldsToBeRemoved);
	}

	/**
	 * Change flexform for News->detail which is the single view of a news record
	 *
	 * @param array $dataStructure flexform structure
	 * @return void
	 */
	protected function updateForDetailAction(array &$dataStructure) {
		$fieldsToBeRemoved = array (
			'displayList' => 'orderBy,sortDirection,categoryMode,category,displayArchived,daysToArchive',
			'latestWidget' => 'maxEntrys,cropLink,showViews',
			'viewsWidget' => 'maxEntrys,cropLink',
			'categoryWidget' => 'listUri,cropLink,viewCounts,viewEmpty',
			'target' => 'detailUid'
		);		
		$this->deleteFromStructure($dataStructure, $fieldsToBeRemoved);
	}
        
        protected function updateForSearchViewAction(array &$dataStructure) {
		$fieldsToBeRemoved = array (
			'displayList' => 'categoryMode,category,displayArchived,daysToArchive',
			'latestWidget' => 'maxEntrys,cropLink,showViews',
			'viewsWidget' => 'maxEntrys,cropLink',
			'categoryWidget' => 'listUri,cropLink,viewCounts,viewEmpty',
			'target' => 'listUid'
		);		
		$this->deleteFromStructure($dataStructure, $fieldsToBeRemoved);
	}
        
         protected function updateForCategoryViewAction(array &$dataStructure) {
		$fieldsToBeRemoved = array (
			'displayList' => 'categoryMode,category,orderBy,sortDirection,displayArchived,daysToArchive',
			'latestWidget' => 'maxEntrys,cropLink,showViews',
			'viewsWidget' => 'maxEntrys,cropLink',
			'categoryWidget' => 'listUri',
			'target' => 'detailUid'
		);		
		$this->deleteFromStructure($dataStructure, $fieldsToBeRemoved);
	}
	
	/**
	 * Change flexform for News->detail which is the single view of a news record
	 *
	 * @param array $dataStructure flexform structure
	 * @return void
	 */
	protected function updateForLatestWidgetAction(array &$dataStructure) {
		$fieldsToBeRemoved = array (
			'displayList' => 'orderBy,sortDirection,categoryMode,category,displayArchived,daysToArchive',
			'viewsWidget' => 'maxEntrys,cropLink',
			'categoryWidget' => 'cropLink,viewCounts,viewEmpty',
			'target' => 'listUid'
		);
		
		$this->deleteFromStructure($dataStructure, $fieldsToBeRemoved);
	}
	
	/**
	 * Change flexform for News->detail which is the single view of a news record
	 *
	 * @param array $dataStructure flexform structure
	 * @return void
	 */
	protected function updateForViewsWidgetAction(array &$dataStructure) {
		$fieldsToBeRemoved = array (
			'displayList' => 'orderBy,sortDirection,categoryMode,category,displayArchived,daysToArchive',
			'latestWidget' => 'maxEntrys,cropLink,showViews',
			'categoryWidget' => 'cropLink,viewCounts,viewEmpty',
			'target' => 'listUid'
		);
		
		$this->deleteFromStructure($dataStructure, $fieldsToBeRemoved);
	}
	
	/**
	 * Change flexform for News->detail which is the single view of a news record
	 *
	 * @param array $dataStructure flexform structure
	 * @return void
	 */
	protected function updateForCategoryWidgetAction(array &$dataStructure) {
		$fieldsToBeRemoved = array (
			'displayList' => 'orderBy,sortDirection,categoryMode,category,displayArchived,daysToArchive',
			'latestWidget' => 'maxEntrys,cropLink,showViews',
			'viewsWidget' => 'maxEntrys,cropLink',
			'target' => 'detailUid'
		);
		
		$this->deleteFromStructure($dataStructure, $fieldsToBeRemoved);
	}
	
	/**
	 * Change flexform for News->detail which is the single view of a news record
	 *
	 * @param array $dataStructure flexform structure
	 * @return void
	 */
	protected function updateForSearchWidgetAction(array &$dataStructure) {
		$fieldsToBeRemoved = array (
			'displayList' => 'orderBy,sortDirection,categoryMode,category,displayArchived,daysToArchive',
			'latestWidget' => 'detailUri,maxEntrys,cropLink,showViews',
			'viewsWidget' => 'detailUri,maxEntrys,cropLink',
			'categoryWidget' => 'listUri,cropLink,viewCounts,viewEmpty',
			'target' => 'detailUid'
		);
		
		$this->deleteFromStructure($dataStructure, $fieldsToBeRemoved);
	}
	
	/**
	 * Change flexform for News->detail which is the single view of a news record
	 *
	 * @param array $dataStructure flexform structure
	 * @return void
	 */
	protected function updateForDateMenuWidgetAction(array &$dataStructure) {
		$fieldsToBeRemoved = array (
			'displayList' => 'orderBy,categoryMode,category',
			'latestWidget' => 'maxEntrys,cropLink,showViews',
			'viewsWidget' => 'maxEntrys,cropLink',
			'categoryWidget' => 'cropLink,viewCounts,viewEmpty',
			'target' => 'detailUid'
		);
		
		$this->deleteFromStructure($dataStructure, $fieldsToBeRemoved);
	}

	/**
	 * Remove fields from flexform structure
	 *
	 * @param array $dataStructure flexform structure
	 * @param array $fieldsToBeRemoved fields which need to be removed
	 * @return void
	 */
	private function deleteFromStructure(array &$dataStructure, array $fieldsToBeRemoved) {
		foreach ($fieldsToBeRemoved as $categoryName => $sheetFields) {
			$fieldsInSheet = explode(',', $sheetFields);
			foreach ($fieldsInSheet as $fieldName) {
				unset($dataStructure['sheets']['general']['ROOT']['el']['settings.'.$categoryName.'.'. $fieldName]);
			}
		}
	}

}

?>
