<?php

if (!defined('TYPO3_MODE')) die('Access denied.');


//Flexform

Tx_Extbase_Utility_Extension::registerPlugin(
        $_EXTKEY,
        'Fe1',
        'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xml:plugin_fe1_title'
);

$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_fe1';

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform.xml');




t3lib_extMgm::addStaticFile($_EXTKEY,'Configuration/TypoScript','TK Simple Blog');


t3lib_extMgm::allowTableOnStandardPages('tx_tkblog_domain_model_post');
$TCA['tx_tkblog_domain_model_post'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
                'default_sortby' => 'ORDER BY date DESC',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'fe_group' => 'fe_group',
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Post.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_tkblog_domain_model_post.gif',
		'dividers2tabs' => 1
	)
);


t3lib_extMgm::allowTableOnStandardPages('tx_tkblog_domain_model_category');
$TCA['tx_tkblog_domain_model_category'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category',
		'label' 			=> 'title',
		'label_alt' => 'parent_category',
		'label_alt_force' => 1,
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_tkblog_domain_model_category.gif',
		'treeParentField' => 'parent_category',
		'dividers2tabs' => 1
	)
);

t3lib_extMgm::allowTableOnStandardPages('tx_tkblog_domain_model_comment');
$TCA['tx_tkblog_domain_model_comment'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:comment',
		'label' 			=> 'author',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',
                'default_sortby' => 'ORDER BY date DESC',
		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Comment.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_tkblog_domain_model_comment.gif'
	)
);
?>