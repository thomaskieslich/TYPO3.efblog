<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	$_EXTKEY,
	'Fe1',
	array(
		'Post' => 'rss,ajaxCalendarMonth,ajaxCalendarDay',
		'Category' => 'categoryOverview',
		'Comment' => 'create',
	),
	array(
		'Post' => 'rss,ajaxCalendarMonth,ajaxCalendarDay'
	)
);