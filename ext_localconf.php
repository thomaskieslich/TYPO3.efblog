<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'fe1',
	array(
		'Post' => 'list,detail',
		//'Category' => 'list,detail'
	),
	array(
		//'Post' => 'list,single',
	)
);

// Modify flexform values
$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_befunc.php']['getFlexFormDSClass'][$_EXTKEY] =
	'EXT:' . $_EXTKEY. '/Classes/Hooks/T3libBefunc.php:tx_Tkblog_Hooks_T3libBefunc';

?>