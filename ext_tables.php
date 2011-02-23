<?php

if (!defined('TYPO3_MODE')) die('Access denied.');


Tx_Extbase_Utility_Extension::registerPlugin(
				$_EXTKEY,
				'fe1',
				'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xml:plugin_fe1_title'
);

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_fe1'] = 'layout,select_key,recursive';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_fe1'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_fe1', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform.xml');


t3lib_extMgm::addStaticFile($_EXTKEY,'Configuration/TypoScript','TK Simple Blog');


if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	if (!isset($TBE_MODULES['TkblogTxtkblog'])) {
		$temp_TBE_MODULES = array ();

		foreach ($TBE_MODULES as $key => $val) {
			if ($key == 'web') {
				$temp_TBE_MODULES[$key] = $val;
				$temp_TBE_MODULES['TkblogTxtkblog'] = '';
			}
			else {
				$temp_TBE_MODULES[$key] = $val;
			}
		}
		$TBE_MODULES = $temp_TBE_MODULES;
	}
	
	t3lib_extMgm::addNavigationComponent('TkblogTxtkblog_categories', 'tkblog-bloglist');
	
	t3lib_extMgm::addNavigationComponent('TkblogTxtkblog', 'typo3-pagetree', array(
    'TYPO3.Components.PageTree'
	));

	Tx_Extbase_Utility_Extension::registerModule(
					$_EXTKEY,
					'txtkblog',
					'',
					'top',
					array (
					),
					array (
				'access' => 'user,group',
				'icon' => 'EXT:tkblog/ext_icon.gif',
				'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xml',
					)
	);


	Tx_Extbase_Utility_Extension::registerModule(
					$_EXTKEY,
					'txtkblog',
					'post',
					'',
					array (
						'Module' => 'mod1'
					),
					array (
				'access' => 'user,group',
				'icon' => 'EXT:tkblog/ext_icon.gif',
				'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod1.xml',
				'navigationComponentId' => 'typo3-pagetree',
					)
	);

	Tx_Extbase_Utility_Extension::registerModule(
					$_EXTKEY,
					'txtkblog',
					'comment',
					'',
					array (
				'Module' => 'mod2'
					),
					array (
						'access' => 'user,group',
						'icon' => 'EXT:tkblog/ext_icon.gif',
						'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod2.xml',						
						'navigationComponentId' => 'typo3-pagetree',
					)
	);

	Tx_Extbase_Utility_Extension::registerModule(
					$_EXTKEY,
					'txtkblog',
					'categories',
					'',
					array (
				'Module' => 'mod3'
					),
					array (
						'access' => 'user,group',
						'icon' => 'EXT:tkblog/ext_icon.gif',
						'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod3.xml',
						'navigationComponentId' => 'tkblog-bloglist',
					)
	);

	$TCA['pages']['columns']['module']['config']['items'][] = array ('TK Blog', 'txtkblog', 'EXT:tkblog/ext_icon.gif');
	t3lib_SpriteManager::addTcaTypeIcon('pages','contains-txtkblog',t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif');
}


t3lib_extMgm::allowTableOnStandardPages('tx_tkblog_domain_model_post');
t3lib_div::loadTCA('pages');
$TCA['pages']['columns']['module']['config']['items'][] = Array('TKBlog', 'tkblog');
t3lib_extMgm::addToInsertRecords('tx_tkblog_domain_model_post');	

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
?>