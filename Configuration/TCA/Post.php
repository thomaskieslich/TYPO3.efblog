<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$TCA['tx_efblog_domain_model_post'] = array(
	'ctrl' => $TCA['tx_efblog_domain_model_post']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'title,author,date,archive,content,tags,allow_comments,teaser_options,views,category,related_post,comments,fe_group'
	),
	'types' => array(
		'0' => array(
			'showitem' =>
			'--div--;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_tab_post,
					--palette--;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_tab_post;post,
					--palette--;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_palette_content;content,
				--div--;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_tab_categorize,
					--palette--;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_palette_tags;tags,
					--palette--;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_palette_category;category,
                                --div--;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_tab_teaser,
					--palette--;;teaserImage,
					--palette--;;teaserOptions,
					--palette--;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_showTeaserImage;showTeaserImage,
				--div--;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_tab_interactive,
					--palette--;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_related;related,
					--palette--;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_comments;comments,					
					--palette--;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_numberViews;views,
				--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility;visibility,
					--palette--;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_palette_access;access,'
		)
	),
	'palettes' => array(
		'post' => array(
			'showitem' =>
			'title;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_title, --linebreak--,
			date;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_date,
			archive;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_archive, --linebreak--,
			author;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_author, --linebreak--,
			teaser_link;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_teaserLink, --linebreak--,
			teaser_link_title;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_teaserLink_title,',
			'canNotCollapse' => 1,
		),
		'content' => array(
			'showitem' =>
			'content;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_content',
			'canNotCollapse' => 1,
		),
		'tags' => array(
			'showitem' =>
			'tags;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_tags,--linebreak--,
			teaser_description;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_teaserDescription,',
			'canNotCollapse' => 1,
		),
		'category' => array(
			'showitem' =>
			'categories;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_category,',
			'canNotCollapse' => 1,
		),
		'teaserImage' => array(
			'showitem' =>
			'teaser_image;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_teaser_image,',
			'canNotCollapse' => 1,
		),
		'teaserOptions' => array(
			'showitem' =>
			'teaser_options;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_teaser_options,',
			'canNotCollapse' => 1,
		),
		'related' => array(
			'showitem' =>
			'related_posts;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_related_post,',
			'canNotCollapse' => 1,
		),
		'comments' => array(
			'showitem' =>
			'allow_comments;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_allow_comments, --linebreak--,
            comments;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_comments,',
			'canNotCollapse' => 1,
		),
		'views' => array(
			'showitem' =>
			'views;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_views,',
			'canNotCollapse' => 1,
		),
		'visibility' => array(
			'showitem' =>
			'hidden;LLL:EXT:cms/locallang_ttc.xml:hidden_formlabel,',
			'canNotCollapse' => 1,
		),
		'access' => array(
			'showitem' =>
			'fe_group;LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_access,',
			'canNotCollapse' => 1,
		),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
				),
			)
		),
		'l18n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_efblog_domain_model_post',
				'foreign_table_where' => 'AND tx_efblog_domain_model_post.uid=###REC_FIELD_l18n_parent### AND tx_efblog_domain_model_post.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			)
		),
		't3ver_label' => array(
			'displayCond' => 'FIELD:t3ver_label:REQ:true',
			'label' => 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config' => array(
				'type' => 'none',
				'cols' => 27,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			)
		),
		'fe_group' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.fe_group',
			'config' => array(
				'type' => 'select',
				'size' => 5,
				'maxitems' => 20,
				'items' => array(
					array(
						'LLL:EXT:lang/locallang_general.xml:LGL.hide_at_login',
						-1,
					),
					array(
						'LLL:EXT:lang/locallang_general.xml:LGL.any_login',
						-2,
					),
					array(
						'LLL:EXT:lang/locallang_general.xml:LGL.usergroups',
						'--div--',
					),
				),
				'exclusiveKeys' => '-1,-2',
				'foreign_table' => 'fe_groups',
				'foreign_table_where' => 'ORDER BY fe_groups.title',
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_title',
			'config' => array(
				'size' => '150',
				'type' => 'input',
				'eval' => 'required'
			)
		),
		'author' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_author',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'foreign_table' => 'fe_users',
				'allowed' => 'fe_users',
				'MM' => 'tx_efblog_post_author_mm',
				'size' => 3,
				'minitems' => 0,
				'maxitems' => 10,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'fe_users' => array(
							'maxItemsInResultList' => 5
						),
					),
				),
			)
		),
		'date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_date',
			'config' => array(
				'type' => 'input',
				'size' => '12',
				'max' => '20',
				'eval' => 'datetime',
				'checkbox' => '0',
				'default' => mktime(date("H"), date("i"), 0, date("m"), date("d"), date("Y"))
			)
		),
		'archive' => Array(
			'exclude' => 0,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_archive',
			'config' => Array(
				'type' => 'input',
				'size' => '12',
				'max' => '20',
				'eval' => 'datetime',
				'checkbox' => '0',
			)
		),
		'teaser_link' => Array(
			"exclude" => 1,
			"label" => "LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_teaserLink",
			"config" => Array(
				"type" => "input",
				"max" => "255",
				'size' => '150',
				"eval" => "trim",
				"wizards" => array(
					"_PADDING" => 2,
					"link" => array(
						"type" => "popup",
						"title" => "Link",
						"icon" => "link_popup.gif",
						"script" => "browse_links.php?mode=wizard",
						"JSopenParams" =>
						"height=300,width=500,status=0,menubar=0,scrollbars=1"
					)
				)
			)
		),
		'teaser_link_title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_teaserLink_title',
			'config' => array(
				'size' => '150',
				'type' => 'input'
			)
		),
		'content' => Array(
			'exclude' => 0,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_content',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tt_content',
				'foreign_field' => 'tx_efblog_post_content_mm',
				'maxitems' => 99,
				'appearance' => array(
					'showSynchronizationLink' => 1,
					'showAllLocalizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showRemovedLocalizationRecords' => 1,
					'expandSingle' => 1
				),
			)
		),
		'tags' => Array(
			'exclude' => 0,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_tags',
			'config' => Array(
				'type' => 'input',
				'size' => '150',
				'max' => '200',
				'eval' => 'trim, lower',
			)
		),
		'categories' => Array(
			'exclude' => 0,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_category',
			'config' => array(
				'type' => 'select',
				'renderMode' => 'tree',
				'treeConfig' => array(
					'parentField' => 'parent_category',
					'appearance' => array(
						'expandAll' => TRUE,
						'showHeader' => TRUE,
					),
				),
				'MM' => 'tx_efblog_post_category_mm',
				'foreign_table' => 'tx_efblog_domain_model_category',
				'foreign_table_where' => ' AND tx_efblog_domain_model_category.pid = ###CURRENT_PID### 
				    AND tx_efblog_domain_model_category.sys_language_uid = 0',
				'size' => 10,
				'autoSizeMax' => 20,
				'minitems' => 0,
				'maxitems' => 20,
			),
		),
		'related_posts' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_related_post',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => 'tx_efblog_domain_model_post',
				'foreign_table' => 'tx_efblog_domain_model_post',
				'size' => 5,
				'minitems' => 0,
				'maxitems' => 10,
				'MM' => 'tx_efblog_post_post_mm',
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
						'tx_efblog_domain_model_post' => array(
							'maxItemsInResultList' => 15,
							'searchCondition' => 'sys_language_uid=0',
						),
					),
				),
			)
		),
		'comments' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:tx_efblog_domain_model_post.comments',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_efblog_domain_model_comment',
				'foreign_field' => 'post',
				'maxitems' => 9999,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'allow_comments' => Array(
			'exclude' => 0,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_allow_comments',
			'config' => Array(
				'type' => 'radio',
				'default' => 0,
				'items' => Array(
					Array('LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_allow_comments.I.0', '0'),
					Array('LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_allow_comments.I.1', '1'),
					Array('LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_allow_comments.I.2', '2'),
					Array('LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_allow_comments.I.3', '3'),
				),
			)
		),
		'teaser_description' => Array(
			'exclude' => 1,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_description',
			'config' => Array(
				'type' => 'text',
				'size' => '40',
			)
		),
		'teaser_options' => Array(
			'exclude' => 0,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_post_teaser_options',
			'config' => Array(
				'type' => 'radio',
				'default' => 1,
				'items' => Array(
					Array('LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_teaser_options.I.0', '0'),
					Array('LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_teaser_options.I.1', '1'),
					Array('LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_teaser_options.I.2', '2'),
					Array('LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_teaser_options.I.3', '3'),
				),
			)
		),
		'views' => Array(
			'exclude' => 0,
			'label' => 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:post_views',
			'config' => Array(
				'type' => 'input',
				'size' => '8',
				'max' => '15',
				'eval' => 'int',
			)
		),
	),
);
?>