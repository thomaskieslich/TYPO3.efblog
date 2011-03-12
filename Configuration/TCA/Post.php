<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_tkblog_domain_model_post'] = array(
    'ctrl' => $TCA['tx_tkblog_domain_model_post']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'title,author,date,archive,content,tags,allow_comments,crop_teaser,views,category,related_post,fe_group'
    ),
    'types' => array(
        '0' => array(
            'showitem' =>
            '--div--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_tab_post,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_tab_post;post,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_palette_content;content,
				--div--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_tab_categorize,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_palette_tags;tags,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_palette_category;category,
                                --div--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_tab_teaser,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_teaserImage;teaserImage,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_showTeaserImage;showTeaserImage,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_cropTeaser;crop,
				--div--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_tab_interactive,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_related;related,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_allowComments;comments,					
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_numberViews;views,
				--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
					--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility;visibility,
					--palette--;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_palette_access;access,'
        )
    ),
    'palettes' => array(
        'post' => array(
            'showitem' =>
            'title;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_title, --linebreak--,
			date;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_date,
			archive;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_archive, --linebreak--,
			author;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_author, --linebreak--,
			teaser_link;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_teaserLink, --linebreak--,
			teaser_link_title;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_teaserLink_title,',
            'canNotCollapse' => 1,
        ),
        'content' => array(
            'showitem' =>
            'content;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_content',
            'canNotCollapse' => 1,
        ),
        'tags' => array(
            'showitem' =>
            'tags;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_tags,',
            'canNotCollapse' => 1,
        ),
        'category' => array(
            'showitem' =>
            'categories;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_category,',
            'canNotCollapse' => 1,
        ),
        'teaserImage' => array(
            'showitem' =>
            'teaser_description;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_teaserDescription, --linebreak--,
             teaser_image;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_teaserImage,',
            'canNotCollapse' => 1,
        ),
        'showTeaserImage' => array(
            'showitem' =>
            'show_teaser_image;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_showTeaserImage,',
            'canNotCollapse' => 1,
        ),
        'crop' => array(
            'showitem' =>
            'crop_teaser;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_cropTeaser,',
            'canNotCollapse' => 1,
        ),
        'related' => array(
            'showitem' =>
            'related_posts;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_related_post,',
            'canNotCollapse' => 1,
        ),
        'comments' => array(
            'showitem' =>
            'allow_comments;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_allow_comments,',
            'canNotCollapse' => 1,
        ),
        'views' => array(
            'showitem' =>
            'views;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_views,',
            'canNotCollapse' => 1,
        ),
        'visibility' => array(
            'showitem' =>
            'hidden;LLL:EXT:cms/locallang_ttc.xml:hidden_formlabel,',
            'canNotCollapse' => 1,
        ),
        'access' => array(
            'showitem' =>
            'fe_group;LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_access,',
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
                'foreign_table' => 'tx_tkblog_domain_model_post',
                'foreign_table_where' => 'AND tx_tkblog_domain_model_post.uid=###REC_FIELD_l18n_parent### AND tx_tkblog_domain_model_post.sys_language_uid IN (-1,0)',
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
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_title',
            'config' => array(
                'type' => 'input',
                'eval' => 'required'
            )
        ),
        'author' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_author',
            'config' => array(
                'type' => 'input'
            )
        ),
        'date' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_date',
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
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_archive',
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
            "label" => "LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_teaserLink",
            "config" => Array(
                "type" => "input",
                "max" => "255",
                "checkbox" => "1",
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
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_teaserLink_title',
            'config' => array(
                'type' => 'input'
            )
        ),
        'content' => Array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_content',
            'config' => array(
                'type' => 'inline',
                'foreign_table' => 'tt_content',
                'foreign_field' => 'tx_tkblog_post_content_mm',
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
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_tags',
            'config' => Array(
                'type' => 'input',
                'size' => '150',
                'max' => '200',
                'eval' => 'trim, lower',
            )
        ),
        'categories' => Array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_category',
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
                'MM' => 'tx_tkblog_post_category_mm',
                'foreign_table' => 'tx_tkblog_domain_model_category',
                'foreign_table_where' => ' AND tx_tkblog_domain_model_category.pid = ###CURRENT_PID### 
				    AND tx_tkblog_domain_model_category.sys_language_uid = 0',
                'size' => 10,
                'autoSizeMax' => 20,
                'minitems' => 0,
                'maxitems' => 20,
            ),
        ),
        'related_posts' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_related_post',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_tkblog_domain_model_post',
                'foreign_table' => 'tx_tkblog_domain_model_post',
                'size' => 5,
                'minitems' => 0,
                'maxitems' => 10,
                'MM' => 'tx_tkblog_post_post_mm',
                'wizards' => array(
                    'suggest' => array(
                        'type' => 'suggest',
                        'tx_tkblog_domain_model_post' => array(
                            'maxItemsInResultList' => 15,
                            'searchCondition' => 'sys_language_uid=0',
                        ),
                    ),
                ),
            )
        ),
        'allow_comments' => Array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_allowComments',
            'config' => Array(
                'type' => 'radio',
                'default' => 0,
                'items' => Array(
                    Array('LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_allowComments.I.0', '0'),
                    Array('LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_allowComments.I.1', '1'),
                    Array('LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_allowComments.I.2', '2'),
                ),
            )
        ),
        'crop_teaser' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:tx_tkblog_domain_model_post.crop_teaser',
            'config' => array(
                'type' => 'check',
                'default' => 1
            ),
        ),
        'teaser_description' => Array(
            'exclude' => 1,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_description',
            'config' => Array(
                'type' => 'text',
                'size' => '40',
            )
        ),
        'teaser_image' => array(
            'exclude' => 0,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:tx_tkblog_domain_model_post.post_teaserImage',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'file',
                'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
                'max_size' => $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'],
                'uploadfolder' => 'uploads/tx_tkblog',
                'disable_controls' => upload,
                'show_thumbs' => 1,
                'size' => 3,
                'minitems' => 0,
                'maxitems' => 3,
            )
        ),
        'show_teaser_image' => Array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_showTeaserImage',
            'config' => Array(
                'type' => 'radio',
                'default' => 2,
                'items' => Array(
                    Array('LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_showTeaserImage.I.0', '0'),
                    Array('LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_showTeaserImage.I.1', '1'),
                    Array('LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_showTeaserImage.I.2', '2'),
                ),
            )
        ),
        'views' => Array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:post_views',
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