<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'ThomasKieslich.' . $_EXTKEY,
	'Fe1',
	array(
		'Post' => 'list,detail,categoryList,rss,ajaxCalendarMonth,ajaxCalendarDay',
		'Category' => 'categoryOverview',
		'Comment' => 'create',
		'Widget' => 'latestPostsWidget, viewsWidget',
	),
	array(
		'Post' => 'searchList,rss,ajaxCalendarMonth,ajaxCalendarDay',
		'Comment' => 'create',
	)
);