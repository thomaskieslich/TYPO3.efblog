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

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive,pages';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform.xml');




t3lib_extMgm::addStaticFile($_EXTKEY,'Configuration/TypoScript','TK Simple Blog');


if (TYPO3_MODE === 'BE') {
	
	/**
	* Registers a Backend Module
	*/
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'web',					
		'tx_tkblog_be1',
		'',		
		array(					
			'Module' => 'list,detail,rss'
			),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:tkblog/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xml',
		)
	);
	
	$TCA['pages']['columns']['module']['config']['items'][] = array ('TK Simple Blog', 'tkblog', 'EXT:tkblog/ext_icon.gif');
	t3lib_SpriteManager::addTcaTypeIcon('pages','contains-txtkblog',t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif');
}


t3lib_extMgm::allowTableOnStandardPages('tx_tkblog_domain_model_post');
//t3lib_div::loadTCA('pages');
//t3lib_extMgm::addToInsertRecords('tx_tkblog_domain_model_post');	

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
                'default_sortby' => 'ORDER BY date DESC',
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
		'title'             => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:tx_tkblog_domain_model_comment',
		'label' 			=> 'author',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Comment.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_tkblog_domain_model_comment.gif'
	)
);
?>