<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$ll = 'LLL:EXT:efblog/Resources/Private/Language/locallang_db.xml:';

return array(
		'ctrl' => array(
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
				'enablecolumns' => array(
						'disabled' => 'hidden',
						'fe_group' => 'fe_group',
				),
				'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('efblog') . 'Resources/Public/Icons/tx_efblog_domain_model_post.gif',
				'dividers2tabs' => 1
		),
		'interface' => array(
				'showRecordFieldList' => 'title,author,date'
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
						'label' => $ll . 'post_title',
						'config' => array(
								'size' => '48',
								'type' => 'input',
								'eval' => 'required'
						)
				),
				'author' => array(
						'exclude' => 1,
						'label' => $ll . 'post_author',
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
						'label' => $ll . 'post_date',
						'config' => array(
								'type' => 'input',
								'size' => '12',
								'max' => '20',
								'eval' => 'datetime',
								'checkbox' => '0',
								'default' => mktime(date('H'), date('i'), 0, date('m'), date('d'), date('Y'))
						)
				),
				'archive' => Array(
						'exclude' => 0,
						'label' => $ll . 'post_archive',
						'config' => Array(
								'type' => 'input',
								'size' => '12',
								'max' => '20',
								'eval' => 'datetime'
						)
				),
				'teaser_link' => Array(
						'exclude' => 1,
						'label' => $ll . 'post_teaserLink',
						'config' => Array(
								'type' => 'input',
								'max' => '255',
								'size' => '150',
								'eval' => 'trim',
								'wizards' => array(
										'_PADDING' => 2,
										'link' => array(
												'type' => 'popup',
												'title' => 'Link',
												'icon' => 'link_popup.gif',
												'script' => 'browse_links.php?mode=wizard',
												'JSopenParams' =>
														'height=300,width=500,status=0,menubar=0,scrollbars=1'
										)
								)
						)
				),
				'teaser_link_title' => array(
						'exclude' => 0,
						'label' => $ll . 'post_teaserLink_title',
						'config' => array(
								'size' => '48',
								'type' => 'input'
						)
				),
				'content' => Array(
						'exclude' => 0,
						'label' => $ll . 'post_content',
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
						'label' => $ll . 'post_tags',
						'config' => Array(
								'type' => 'input',
								'size' => '48',
								'max' => '200',
								'eval' => 'trim, lower',
						)
				),
				'categories' => Array(
						'exclude' => 0,
						'label' => $ll . 'post_category',
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
						'label' => $ll . 'post_related_post',
						'config' => array(
								'type' => 'group',
								'internal_type' => 'db',
								'allowed' => 'tx_efblog_domain_model_post',
								'foreign_table' => 'tx_efblog_domain_model_post',
								'MM_opposite_field' => 'related_from',
								'size' => 4,
								'minitems' => 0,
								'maxitems' => 99,
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
				'related_from' => array(
						'exclude' => 0,
						'label' => $ll . 'post_related_post_from',
						'config' => array(
								'type' => 'group',
								'internal_type' => 'db',
								'foreign_table' => 'tx_efblog_domain_model_post',
								'allowed' => 'tx_efblog_domain_model_post',
								'size' => 4,
								'minitems' => 0,
								'maxitems' => 99,
								'MM' => 'tx_efblog_post_post_mm',
								'readOnly' => 1,
						)
				),
				'comments' => array(
						'exclude' => 0,
						'label' => $ll . 'tx_efblog_domain_model_post.comments',
						'config' => array(
								'type' => 'inline',
								'foreign_table' => 'tx_efblog_domain_model_comment',
								'foreign_field' => 'post',
								'maxitems' => 9999,
								'multiple' => 0,
								'appearance' => array(
										'collapseAll' => 1,
										'expandSingle' => 1,
								),
						),
				),
				'allow_comments' => Array(
						'exclude' => 0,
						'label' => $ll . 'post_allow_comments',
						'config' => Array(
								'type' => 'radio',
								'default' => 0,
								'items' => Array(
										Array($ll . 'post_allow_comments.I.0', '0'),
										Array($ll . 'post_allow_comments.I.1', '1'),
										Array($ll . 'post_allow_comments.I.2', '2'),
										Array($ll . 'post_allow_comments.I.3', '3'),
								),
						)
				),
				'teaser_image' => array(
						'exclude' => 0,
						'label' => $ll . 'tx_efblog_domain_model_post.post_teaserImage',
						'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('tx_efblog_domain_model_post_teaser_image', array(
								'appearance' => array(
										'useSortable' => FALSE,
										'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
								),
								'foreign_types' => array(
										\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
												'showitem' => '
									--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
									--palette--;;filePalette'
										),
								),
						), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
						),
				),
				'teaser_description' => Array(
						'exclude' => 1,
						'label' => $ll . 'post_description',
						'config' => Array(
								'type' => 'text',
								'cols' => '60',
								'rows' => '1'
						)
				),
				'teaser_options' => Array(
						'exclude' => 0,
						'label' => $ll . 'post_post_teaser_options',
						'config' => Array(
								'type' => 'radio',
								'default' => 1,
								'items' => Array(
										Array($ll . 'post_teaser_options.I.0', '0'),
										Array($ll . 'post_teaser_options.I.1', '1'),
										Array($ll . 'post_teaser_options.I.2', '2'),
										Array($ll . 'post_teaser_options.I.3', '3'),
								),
						)
				),
				'views' => Array(
						'exclude' => 0,
						'label' => $ll . 'post_views',
						'config' => Array(
								'type' => 'input',
								'size' => '8',
								'max' => '15',
								'eval' => 'int',
						)
				),
		),
		'types' => array(
				'0' => array(
						'showitem' => '
					--div--;' . $ll . 'post_tab_post,
						--palette--;;post,
					--div--;' . $ll . 'post_tab_teaser,
							--palette--;;teaser,
					--div--;' . $ll . 'post_tab_metadata,
						--palette--;;metadata,
					--div--;' . $ll . 'post_tab_relations,
						--palette--;;relations,
					--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
						--palette--;;access,
					'
				)
		),
		'palettes' => array(
				'post' => array(
						'showitem' => '
						title;' . $ll . 'post_title, --linebreak--,
						author;' . $ll . 'post_author, --linebreak--,
						content;' . $ll . 'post_content,
				'
				),
				'teaser' => array(
						'showitem' => '
						teaser_image;' . $ll . 'post_teaser_image, --linebreak--,
						teaser_link;' . $ll . 'post_teaserLink, --linebreak--,
						teaser_link_title;' . $ll . 'post_teaserLink_title, --linebreak--,
						teaser_options;' . $ll . 'post_teaser_options
				'
				),
				'metadata' => array(
						'showitem' => '
						categories;' . $ll . 'post_category,--linebreak--,
						tags;' . $ll . 'post_tags,--linebreak--,
						teaser_description;' . $ll . 'post_description
				'
				),
				'relations' => array(
						'showitem' => '
						related_posts;' . $ll . 'post_related_post, --linebreak--,
						related_from;' . $ll . 'post_related_post_from, --linebreak--,
						comments;' . $ll . 'post_comments, --linebreak--,
						allow_comments;' . $ll . 'post_allow_comments, --linebreak--,
						views;' . $ll . 'post_views
				'
				),
				'access' => array(
						'showitem' => '
						hidden;' . $ll . 'hidden,
						date;' . $ll . 'post_date,
						archive;' . $ll . 'post_archive, --linebreak--,
						fe_group;' . $ll . 'post_access
				'
				),
		),
);