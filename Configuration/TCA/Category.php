<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$TCA['tx_tkblog_domain_model_category'] = array (
	'ctrl' => $TCA['tx_tkblog_domain_model_category']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'title,description,parent_category',
	),
	'types' => array (
		'0' => array (
			'showitem' =>
			'--div--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_tab_categorize,
			--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_tab_categorize;category,
			--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_parent_category;parent,
			--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility;visibility,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.access;access,'
		)
	),
	'palettes' => array (
		'category' => array (
			'showitem' =>
			'title;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_title, --linebreak--,
			description;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_description,',
			'canNotCollapse' => 1,
		),
		'parent' => array (
			'showitem' =>
			'parent_category;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_parent_category,',
			'canNotCollapse' => 1,
		),
		'visibility' => array (
			'showitem' =>
			'hidden;LLL:EXT:cms/locallang_ttc.xml:hidden_formlabel,',
			'canNotCollapse' => 1,
		),
		'access' => array (
			'showitem' =>
			'starttime;LLL:EXT:cms/locallang_ttc.xml:starttime_formlabel, 
			endtime;LLL:EXT:cms/locallang_ttc.xml:endtime_formlabel, --linebreak--, 
			fe_group;LLL:EXT:cms/locallang_ttc.xml:fe_group_formlabel',
			'canNotCollapse' => 1,
		),
	),
	'columns' => array (
		'sys_language_uid' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array (
					array ('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					array ('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
				),
			)
		),
		'l18n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array (
				'type' => 'select',
				'items' => array (
					array ('', 0),
				),
				'foreign_table' => 'tx_tkblog_domain_model_category',
				'foreign_table_where' => 'AND tx_tkblog_domain_model_category.uid=###REC_FIELD_l18n_parent### AND tx_tkblog_domain_model_category.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array (
			'config' => array (
				'type' => 'passthrough',
			)
		),
		't3ver_label' => array (
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => array (
				'type' => 'none',
				'cols' => 27,
			)
		),
		'hidden' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array (
				'type' => 'check',
			)
		),
		'title' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_title',
			'config' => Array (
				'type' => 'input',
				'size' => '30',
				'eval' => 'required',
			)
		),
		'description' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_description',
			'config' => Array (
				'type' => 'text',
				'size' => '40',
			)
		),
		'parent_category' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_parent_category',
			'config' => array (
				'type' => 'select',
				'size' => 8,
				'autoSizeMax' => 20,
				'foreign_table' => 'tx_tkblog_domain_model_category',
				'foreign_table_where' => ' AND tx_tkblog_domain_model_category.pid = ###CURRENT_PID### 
					AND tx_tkblog_domain_model_category.uid != ###THIS_UID###
				    AND tx_tkblog_domain_model_category.sys_language_uid = 0',
				'renderMode' => 'tree',
				'treeConfig' => array (
					'parentField' => 'parent_category',
					'appearance' => array (
						'expandAll' => TRUE,
						'showHeader' => FALSE,
					),
				),
			)
		),
	),
);
?>