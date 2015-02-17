<?php
namespace ThomasKieslich\Efblog\Controller;

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
use ThomasKieslich\Efblog\Domain\Model\Post;

/**
 * Ajax Controller
 */
class AjaxController extends BaseController {

	/**
	 * update Post views
	 *
	 * @param \ThomasKieslich\Efblog\Domain\Model\Post $post
	 *
	 * @return bool
	 */
	public function updateViewsAction(Post $post = NULL) {
		if (!$GLOBALS['BE_USER']->user['uid']) {
			$currentViews = $post->getViews();
			$post->setViews($currentViews + 1);
			$this->postRepository->update($post);

			return 'true';
		}

		return 'false';
	}

		/**
	 * show day
	 *
	 * @return string
	 */
	public function calendarDayAction() {
		$this->settings['enableFuturePosts'] = 1;
		$this->settings['listView']['sortDirection'] = 'asc';

		$request = $this->request->getArguments();
		if (isset($request['date'])) {
			$date = date_parse($this->request->getArgument('date'));
			$this->settings['year'] = $date['year'];
			$this->settings['month'] = $date['month'];
			$this->settings['day'] = $date['day'];
		}

		$posts = $this->postRepository->findPosts($this->settings);
		$this->view->assign('date', new \DateTime($this->request->getArgument('date')));
		$this->view->assign('posts', $posts);
		$html = $this->view->render();

		return trim($html);
	}

	/**
	 * show month
	 *
	 * @return string
	 */
	public function calendarMonthAction() {
		$this->settings['enableFuturePosts'] = 1;
		$this->settings['listView']['sortDirection'] = 'asc';

		$request = $this->request->getArguments();
		if (isset($request['year'])) {
			$this->settings['year'] = $this->request->getArgument('year');
		}

		if (isset($request['month'])) {
			$this->settings['month'] = $this->request->getArgument('month');
		}

		$monthDates = array();
		foreach ($this->postRepository->findPosts($this->settings) as $mposts) {
			/** @var \DateTime $date */
			$date = $mposts->getDate();
			$date->setTime(12, 00, 00);
			$monthDates[] = $date->format('U') * 1000;
		}

		return json_encode(array_unique($monthDates));
	}

}