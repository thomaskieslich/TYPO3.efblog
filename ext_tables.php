<?php

if (!defined('TYPO3_MODE'))
	die('Access denied.');


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




t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Simple Blog');


t3lib_extMgm::allowTableOnStandardPages('tx_efblog_domain_model_post');
$TCA['tx_efblog_domain_model_post'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'default_sortby' => 'ORDER BY date DESC',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
			'fe_group' => 'fe_group',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Post.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_efblog_domain_model_post.gif',
		'dividers2tabs' => 1
	)
);

$postTempColumns = array ();
if (t3lib_extMgm::isLoaded('dam')) {
	$postTempColumns['teaser_image'] = txdam_getMediaTCA('image_field', 'tx_efblog_domain_model_post_teaser_image');
	$postTempColumns['teaser_image']['exclude'] = 1;
	$postTempColumns['teaser_image']['label'] = 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:tx_efblog_domain_model_post.post_teaserImage';
} else {
	$postTempColumns['teaser_image'] = array (
		'exclude' => 0,
		'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:tx_efblog_domain_model_post.post_teaserImage',
		'config' => array (
			'type' => 'group',
			'internal_type' => 'file',
			'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
			'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
			'uploadfolder' => 'uploads/tx_efblog',
			'disable_controls' => upload,
			'show_thumbs' => 1,
			'size' => 3,
			'minitems' => 0,
			'maxitems' => 4,
		)
	);
}

t3lib_div::loadTCA('tx_efblog_domain_model_post');
t3lib_extMgm::addTCAcolumns('tx_efblog_domain_model_post', $postTempColumns, tx_efblog);


t3lib_extMgm::allowTableOnStandardPages('tx_efblog_domain_model_category');
$TCA['tx_efblog_domain_model_category'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:category',
		'label' => 'title',
		'label_alt' => 'parent_category',
		'label_alt_force' => 1,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'default_sortby' => 'ORDER BY title ASC',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden'
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_efblog_domain_model_category.gif',
		'treeParentField' => 'parent_category',
		'dividers2tabs' => 1
	)
);

$categoryTempColumns = array ();
if (t3lib_extMgm::isLoaded('dam')) {
	$categoryTempColumns['image'] = txdam_getMediaTCA('image_field', 'tx_efblog_domain_model_category_image');
	$categoryTempColumns['image']['exclude'] = 1;
	$categoryTempColumns['image']['label'] = 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:tx_efblog_domain_model_post.category_image';
} else {
	$categoryTempColumns['image'] = array (
		'exclude' => 0,
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:tx_efblog_domain_model_post.category_image',
		'config' => array (
			'type' => 'group',
			'internal_type' => 'file',
			'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
			'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
			'uploadfolder' => 'uploads/tx_efblog',
			'disable_controls' => upload,
			'show_thumbs' => 1,
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
		)
	);
}

t3lib_div::loadTCA('tx_efblog_domain_model_category');
t3lib_extMgm::addTCAcolumns('tx_efblog_domain_model_category', $categoryTempColumns, tx_efblog);

t3lib_extMgm::allowTableOnStandardPages('tx_efblog_domain_model_comment');
$TCA['tx_efblog_domain_model_comment'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:comment',
		'label' => 'author',
		'label_alt' => 'title',
		'label_alt_force' => 1,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		'default_sortby' => 'ORDER BY date DESC',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden'
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Comment.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_efblog_domain_model_comment.gif'
	)
);

//extend fe_users
$tempFeusers = array(
	'tx_efblog_profile_page' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:fe_users.tx_efblog_profile_page',
		'config' => Array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => 'pages',
			'size' => '1',
			'maxitems' => '1',
			'minitems' => '0',
			'show_thumbs' => '0',
			'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'fe_users' => array(
							'maxItemsInResultList' => 15
						),
					),
				),
		)
	),
	);

t3lib_div::loadTCA('fe_users');
t3lib_extMgm::addTCAcolumns('fe_users', $tempFeusers, 1);
t3lib_extMgm::addToAllTCAtypes('fe_users', 'tx_efblog_profile_page', '', 'after:company');


?>