<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'fe1',
	array(
		'Post' => 'list,single',
		'Category' => 'list,single'
	),
	array(
		//'Post' => 'list,single',
	)
);

?>