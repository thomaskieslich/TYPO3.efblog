<?php

########################################################################
# Extension Manager/Repository config file for ext "tkblog".
#
# Auto generated 16-02-2011 20:15
# 
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Simple Blog',
	'description' => 'testblog',
	'category' => 'plugin',
	'author' => 'Thomas Kieslich',
	'author_email' => 'thomaskieslich@gmx.net',
	'author_company' => '',
	'shy' => '',
	'dependencies' => 'cms,extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '0.0.0',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'extbase' => '',
			'fluid' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:44:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"4871";s:14:"ext_tables.php";s:4:"e849";s:14:"ext_tables.sql";s:4:"dc6e";s:41:"Classes/Controller/CategoryController.php";s:4:"4be3";s:39:"Classes/Controller/ModuleController.php";s:4:"aa18";s:37:"Classes/Controller/PostController.php";s:4:"bd1f";s:33:"Classes/Domain/Model/Category.php";s:4:"f724";s:29:"Classes/Domain/Model/Post.php";s:4:"b144";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"9524";s:44:"Classes/Domain/Repository/PostRepository.php";s:4:"26ef";s:36:"Configuration/FlexForms/flexform.xml";s:4:"d3bd";s:30:"Configuration/TCA/Category.php";s:4:"fc01";s:26:"Configuration/TCA/Post.php";s:4:"7e6c";s:38:"Configuration/TypoScript/constants.txt";s:4:"4597";s:34:"Configuration/TypoScript/setup.txt";s:4:"fde2";s:46:"Resources/Private/Backend/Layouts/default.html";s:4:"3e04";s:52:"Resources/Private/Backend/Templates/Module/Mod1.html";s:4:"69ac";s:52:"Resources/Private/Backend/Templates/Module/mod2.html";s:4:"3d1b";s:52:"Resources/Private/Backend/Templates/Module/mod3.html";s:4:"4244";s:50:"Resources/Private/Backend/Templates/Post/Edit.html";s:4:"8f9c";s:51:"Resources/Private/Backend/Templates/Post/Index.html";s:4:"4980";s:50:"Resources/Private/Backend/Templates/Post/List.html";s:4:"d41d";s:49:"Resources/Private/Backend/Templates/Post/New.html";s:4:"f772";s:50:"Resources/Private/Backend/Templates/Post/Show.html";s:4:"53ae";s:40:"Resources/Private/Language/locallang.xml";s:4:"aa1b";s:76:"Resources/Private/Language/locallang_csh_tx_tkblog_domain_model_category.xml";s:4:"9c51";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"49ea";s:44:"Resources/Private/Language/locallang_mod.xml";s:4:"c43c";s:45:"Resources/Private/Language/locallang_mod1.xml";s:4:"2657";s:45:"Resources/Private/Language/locallang_mod2.xml";s:4:"bb7e";s:45:"Resources/Private/Language/locallang_mod3.xml";s:4:"3796";s:38:"Resources/Private/Layouts/default.html";s:4:"1118";s:42:"Resources/Private/Partials/formErrors.html";s:4:"f5bc";s:42:"Resources/Private/Templates/Post/List.html";s:4:"a84f";s:44:"Resources/Private/Templates/Post/Single.html";s:4:"696c";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:58:"Resources/Public/Icons/tx_tkblog_domain_model_category.gif";s:4:"1103";s:57:"Resources/Public/Icons/tx_tkblog_domain_model_comment.gif";s:4:"1103";s:54:"Resources/Public/Icons/tx_tkblog_domain_model_post.gif";s:4:"1103";s:33:"components/bloglist/css/myCSS.css";s:4:"ed01";s:42:"components/bloglist/javascript/bloglist.js";s:4:"f255";s:36:"components/mycomponent/css/myCSS.css";s:4:"02f7";s:48:"components/mycomponent/javascript/myComponent.js";s:4:"b23b";}',
);

?>