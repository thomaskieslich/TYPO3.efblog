<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY, 'Fe1', 
	array (
		'Post' => 'list,detail,rss',
		'Category' => 'categoryOverview',
		'Comment' => 'create',
	), 
	array (

	)
);
?>