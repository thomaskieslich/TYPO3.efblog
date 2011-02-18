<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$TCA['tx_tkblog_domain_model_post'] = array (
	'ctrl' => $TCA['tx_tkblog_domain_model_post']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'title,author,date,allowComments,category,related,tagClouds,numberViews,starttime,endtime,fe_group'
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
		'l18n_parent' => array (
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array (
				'type' => 'select',
				'items' => array (
					array ('', 0),
				),
				'foreign_table' => 'tx_tkblog_domain_model_post',
				'foreign_table_where' => 'AND post_uid=###REC_FIELD_l18n_parent### AND post_sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array (
			'config' => array (
				'type' => 'passthrough',
			)
		),
		'title' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_title',
			'config' => array (
				'type' => 'input',
				'eval' => 'required'
			)
		),
		'author' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_author',
			'config' => array (
				'type' => 'input'
			)
		),
		'date' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_date',
			'config' => array (
				'type' => 'input',
				'size' => '12',
				'max' => '20',
				'eval' => 'datetime',
				'checkbox' => '0',
				'default' => mktime(date("H"),
						date("i"),
						0,
						date("m"),
						date("d"),
						date("Y"))
			)
		),
		'archive' => Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_archive',
			'config' => Array (
				'type' => 'input',
				'size' => '12',
				'max' => '20',
				'eval' => 'datetime',
				'checkbox' => '0',
			)
		),
		'content' => Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_content',
			'config' => array (
				'type' => 'inline',
				'foreign_table' => 'tt_content',
				'foreign_field' => 'irre_parentid',
				'foreign_table_field' => 'irre_parenttable',
				'maxitems' => 100,
				//'localisationMode' => 'keep',
				'appearance' => array (
					'showSynchronizationLink' => 1,
					'showAllLocalizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showRemovedLocalizationRecords' => 1,
					'expandSingle' => 1
				),
			)
		),
		'tagClouds' => Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_tags',
			'config' => Array (
				'type' => 'input',
				'size' => '150',
				'max' => '200',
				'eval' => 'trim, lower',
			)
		),
		'category' => Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_category',
			'config' => array (
				'type' => 'select',
				'renderMode' => 'tree',
				'treeConfig' => array (
					'parentField' => 'parentcategory',
					'appearance' => array (
						'expandAll' => TRUE,
						'showHeader' => TRUE,
					),
				),
				'MM' => 'tx_tkblog_domain_model_post_category_mm',
				'foreign_table' => 'tx_tkblog_domain_model_category',
				'foreign_table_where' => ' AND tx_tkblog_domain_model_category.pid = ###CURRENT_PID### 
				    AND tx_tkblog_domain_model_category.sys_language_uid = 0',
				'size' => 10,
				'autoSizeMax' => 20,
				'minitems' => 0,
				'maxitems' => 20,
			),
		),
		'related' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_category',
			'config' => array (
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_tkblog_domain_model_post',
				'foreign_table' => 'tx_tkblog_domain_model_post',
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 10,
				'MM' => 'tx_tkblog_domain_model_post_related_mm',
				'wizards' => array (
					'suggest' => array (
						'type' => 'suggest',
						'tx_tkblog_domain_model_post' => array (
							'maxItemsInResultList' => 15,
							'searchCondition' => 'sys_language_uid=0',
						),
					),
				),
			)
		),
		'allowComments' => Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_allowComments',
			'config' => Array (
				'type' => 'radio',
				'default' => 0,
				'items' => Array (
					Array ('LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_allowComments.I.0', '0'),
					Array ('LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_allowComments.I.1', '1'),
					Array ('LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_allowComments.I.2', '2'),
				),
			)
		),
		'numberViews' => Array (
			'exclude' => 0,
			'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_numberViews',
			'config' => Array (
				'type' => 'input',
				'size' => '8',
				'max' => '15',
				'eval' => 'int',
			)
		),
	),
	'types' => array (
		'0' => array (
			'showitem' =>
			'--div--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_tab_post,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_tab_post;post,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_palette_content;content,
				--div--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_tab_categorize,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_palette_tags;tags,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_palette_category;category,
				--div--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_tab_interactive,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_related;related,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_allowComments;comments,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_numberViews;views,
				--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility;visibility,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.access;access,'
		)
	),
	'palettes' => array (
		'post' => array (
			'showitem' =>
			'title;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_title, --linebreak--,
			date;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_date,
			archive;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_archive, --linebreak--,
			author;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_author,',
			'canNotCollapse' => 1,
		),
		'content' => array (
			'showitem' =>
			'content;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_content',
			'canNotCollapse' => 1,
		),
		'tags' => array (
			'showitem' =>
			'tagClouds;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_tags,',
			'canNotCollapse' => 1,
		),
		'category' => array (
			'showitem' =>
			'category;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_category,',
			'canNotCollapse' => 1,
		),
		'related' => array (
			'showitem' =>
			'related;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_related,',
			'canNotCollapse' => 1,
		),
		'comments' => array (
			'showitem' =>
			'allowComments;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_allowComments,',
			'canNotCollapse' => 1,
		),
		'views' => array (
			'showitem' =>
			'numberViews;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_numberViews,',
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