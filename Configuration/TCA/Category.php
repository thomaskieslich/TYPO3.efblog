<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$TCA['tx_tkblog_domain_model_category'] = array (
	'ctrl' => $TCA['tx_tkblog_domain_model_category']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'title,description,parentcategory,starttime,endtime,fe_group'
	),
	'columns' => array (
		'hidden' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array (
				'type' => 'check',
				'items' => array (
					'1' => array (
						'0' => 'LLL:EXT:cms/locallang_ttc.xml:hidden.I.0',
					),
				),
			),
		),
		'starttime' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array (
				'type' => 'input',
				'size' => '13',
				'max' => '20',
				'eval' => 'date',
				'default' => '0',
			),
		),
		'endtime' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array (
				'type' => 'input',
				'size' => '13',
				'max' => '20',
				'eval' => 'date',
				'default' => '0',
				'range' => array (
					'upper' => mktime(0,
							0,
							0,
							12,
							31,
							2020),
				),
			),
		),
		'fe_group' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config' => array (
				'type' => 'select',
				'size' => 5,
				'maxitems' => 20,
				'items' => array (
					array (
						'LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login',
						-1,
					),
					array (
						'LLL:EXT:lang/locallang_general.xml:LGL.any_login',
						-2,
					),
					array (
						'LLL:EXT:lang/locallang_general.xml:LGL.usergroups',
						'--div--',
					),
				),
				'exclusiveKeys' => '-1,-2',
				'foreign_table' => 'fe_groups',
				'foreign_table_where' => 'ORDER BY fe_groups.title',
			),
		),
		'sys_language_uid' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array (
					array (
						'LLL:EXT:lang/locallang_general.xml:LGL.allLanguages',
						-1,
					),
					array (
						'LLL:EXT:lang/locallang_general.xml:LGL.default_value',
						0,
					),
				),
			),
		),
		'l10n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array (
				'type' => 'select',
				'items' => array (
					array ('', 0),
				),
				'foreign_table' => 'tx_tkblog_domain_model_category',
				'foreign_table_where' => ' AND tx_tkblog_domain_model_category.pid = ###CURRENT_PID### AND tx_tkblog_domain_model_category.uid != ###THIS_UID###',
			)
		),
		'l10n_diffsource' => array (
			'config' => array (
				'type' => 'passthrough'
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
		'parentcategory' => Array (
			'exclude' => 1,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_parentcategory',
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
					'parentField' => 'parentcategory',
					'appearance' => array (
						'expandAll' => TRUE,
						'showHeader' => FALSE,
					),	
				),
			)
		),
	),
	'types' => array (
		'0' => array (
			'showitem' =>
			'--div--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_tab_categorize,
			--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_tab_categorize;category,
			--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_parentcategory;parent,
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
			'parentcategory;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:category_parentcategory,',
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
);
?>