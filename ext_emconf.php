<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011-2015 Thomas Kieslich
 *  All rights reserved
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
		'title' => 'Simple Blog',
		'description' => 'Blog- Newsextension, based on extbase/fluid.',
		'category' => 'plugin',
		'author' => 'Thomas Kieslich',
		'author_email' => 'info@thomaskieslich.de',
		'module' => '',
		'state' => 'stable',
		'internal' => '',
		'uploadfolder' => '0',
		'createDirs' => '',
		'modify_tables' => '',
		'clearCacheOnLoad' => 0,
		'lockType' => '',
		'version' => '6.2.0',
		'constraints' => array(
				'depends' => array(
						'typo3' => '6.2.0-7.99.999',
				),
				'conflicts' => array(),
				'suggests' => array(),
		)
);