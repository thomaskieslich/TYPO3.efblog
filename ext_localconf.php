<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'ThomasKieslich.' . $_EXTKEY,
		'Fe1',
		array(
				'Ajax' => 'updateViews,calendarDay,calendarMonth',
				'Category' => 'categoryOverview',
				'Comment' => 'create',
				'Post' => 'list,detail,categoryList,rss',
		),
		array(
				'Comment' => 'create',
				'Post' => 'searchList,updateViews,rss',
		)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'ThomasKieslich.' . $_EXTKEY,
		'Fe2',
		array(
				'Widget' => 'latestPostsWidget, viewsWidget',
		),
		array()
);