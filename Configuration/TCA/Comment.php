<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_tkblog_domain_model_comment'] = array(
    'ctrl' => $TCA['tx_tkblog_domain_model_comment']['ctrl'],
    'interface' => array(
        'showRecordFieldList'	=> 'author,email,website,location,title,message,date,spampoints,ip,parent_comment',
    ),
    'types' => array(
        '1' => array('showitem'	=> 'author,email,website,location,title,message,date,spampoints,ip,parent_comment'),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
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
                'foreign_table' => 'tx_tkblog_domain_model_comment',
                'foreign_table_where' => 'AND tx_tkblog_domain_model_comment.uid=###REC_FIELD_l18n_parent### AND tx_tkblog_domain_model_comment.sys_language_uid IN (-1,0)',
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
        'author' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:comment_author',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'email' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:comment_email',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'website' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:comment_website',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ),
        ),
        'location' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:comment_location',
			'config'	=> array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'title' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:comment_title',
			'config'	=> array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
        'message' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:comment_message',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ),
        ),
        'date' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:comment_date',
            'config' => array(
                'type' => 'input',
                'size' => 12,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 1,
                'default' => time()
            ),
        ),
		'spampoints' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:comment_spampoints',
			'config'	=> array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'int'
			),
		),
		'ip' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:comment_ip',
			'config'	=> array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'parent_comment' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:tkblog/Resources/Private/Language/locallang_db.xml:comment_parent_comment',
			'config'	=> array(
				'type' => 'inline',
				'foreign_table' => 'tx_tkblog_domain_model_comment',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapse' => 0,
					'newRecordLinkPosition' => 'bottom',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
        'post' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
    ),
);
?>