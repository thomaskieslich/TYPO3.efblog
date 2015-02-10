<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'ThomasKieslich.' . $_EXTKEY,
	'Fe1',
	array(
		'Post' => 'list,detail,updateViews,categoryList,rss,ajaxCalendarMonth,ajaxCalendarDay',
		'Category' => 'categoryOverview',
		'Comment' => 'create',
	),
	array(
		'Post' => 'searchList,updateViews,rss,ajaxCalendarMonth,ajaxCalendarDay',
		'Comment' => 'create',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'ThomasKieslich.' . $_EXTKEY,
	'Fe2',
	array(
		'Widget' => 'latestPostsWidget, viewsWidget',
	),
	array(

	)
);