<?php

########################################################################
# Extension Manager/Repository config file for ext "tkblog".
#
# Auto generated 02-03-2011 19:37
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'TK Simple Blog',
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
	'_md5_values_when_last_written' => 'a:62:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"26b2";s:14:"ext_tables.php";s:4:"8092";s:14:"ext_tables.sql";s:4:"2b39";s:41:"Classes/Controller/CategoryController.php";s:4:"4be3";s:39:"Classes/Controller/ModuleController.php";s:4:"aa18";s:37:"Classes/Controller/PostController.php";s:4:"a504";s:33:"Classes/Domain/Model/Category.php";s:4:"aeba";s:32:"Classes/Domain/Model/Content.php";s:4:"66f6";s:29:"Classes/Domain/Model/Post.php";s:4:"0c11";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"d2d8";s:44:"Classes/Domain/Repository/PostRepository.php";s:4:"ad71";s:29:"Classes/Hooks/T3libBefunc.php";s:4:"224a";s:45:"Classes/ViewHelpers/SetPropertyViewHelper.php";s:4:"ff0a";s:54:"Classes/ViewHelpers/Document/DescriptionViewHelper.php";s:4:"3f43";s:51:"Classes/ViewHelpers/Document/KeywordsViewHelper.php";s:4:"f3eb";s:48:"Classes/ViewHelpers/Document/TitleViewHelper.php";s:4:"3c31";s:53:"Classes/ViewHelpers/Widget/AutocompleteViewHelper.php";s:4:"f681";s:49:"Classes/ViewHelpers/Widget/PaginateViewHelper.php";s:4:"a813";s:64:"Classes/ViewHelpers/Widget/Controller/AutocompleteController.php";s:4:"d5c0";s:60:"Classes/ViewHelpers/Widget/Controller/PaginateController.php";s:4:"869f";s:36:"Configuration/FlexForms/flexform.xml";s:4:"7930";s:30:"Configuration/TCA/Category.php";s:4:"533c";s:26:"Configuration/TCA/Post.php";s:4:"7454";s:38:"Configuration/TypoScript/constants.txt";s:4:"4597";s:34:"Configuration/TypoScript/setup.txt";s:4:"f043";s:46:"Resources/Private/Backend/Layouts/default.html";s:4:"3e04";s:52:"Resources/Private/Backend/Templates/Module/Mod1.html";s:4:"69ac";s:52:"Resources/Private/Backend/Templates/Module/mod2.html";s:4:"3d1b";s:52:"Resources/Private/Backend/Templates/Module/mod3.html";s:4:"4244";s:50:"Resources/Private/Backend/Templates/Post/Edit.html";s:4:"8f9c";s:51:"Resources/Private/Backend/Templates/Post/Index.html";s:4:"4980";s:50:"Resources/Private/Backend/Templates/Post/List.html";s:4:"d41d";s:49:"Resources/Private/Backend/Templates/Post/New.html";s:4:"f772";s:50:"Resources/Private/Backend/Templates/Post/Show.html";s:4:"53ae";s:40:"Resources/Private/Language/locallang.xml";s:4:"e1b4";s:76:"Resources/Private/Language/locallang_csh_tx_tkblog_domain_model_category.xml";s:4:"9c51";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"5fda";s:44:"Resources/Private/Language/locallang_mod.xml";s:4:"c43c";s:45:"Resources/Private/Language/locallang_mod1.xml";s:4:"2657";s:45:"Resources/Private/Language/locallang_mod2.xml";s:4:"bb7e";s:45:"Resources/Private/Language/locallang_mod3.xml";s:4:"3796";s:38:"Resources/Private/Layouts/default.html";s:4:"1bfb";s:47:"Resources/Private/Partials/CategoryElement.html";s:4:"ddd2";s:52:"Resources/Private/Templates/Post/CategoryWidget.html";s:4:"d0e0";s:52:"Resources/Private/Templates/Post/DateMenuWidget.html";s:4:"238c";s:44:"Resources/Private/Templates/Post/Detail.html";s:4:"ff7c";s:50:"Resources/Private/Templates/Post/LatestWidget.html";s:4:"bfab";s:42:"Resources/Private/Templates/Post/List.html";s:4:"bce4";s:50:"Resources/Private/Templates/Post/SearchWidget.html";s:4:"3e8c";s:49:"Resources/Private/Templates/Post/ViewsWidget.html";s:4:"33d5";s:70:"Resources/Private/Templates/ViewHelpers/Widget/Autocomplete/Index.html";s:4:"b955";s:66:"Resources/Private/Templates/ViewHelpers/Widget/Paginate/Index.html";s:4:"9595";s:34:"Resources/Public/CSS/extension.css";s:4:"53b8";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:58:"Resources/Public/Icons/tx_tkblog_domain_model_category.gif";s:4:"1103";s:57:"Resources/Public/Icons/tx_tkblog_domain_model_comment.gif";s:4:"1103";s:54:"Resources/Public/Icons/tx_tkblog_domain_model_post.gif";s:4:"1103";s:33:"components/bloglist/css/myCSS.css";s:4:"ed01";s:42:"components/bloglist/javascript/bloglist.js";s:4:"f255";s:36:"components/mycomponent/css/myCSS.css";s:4:"02f7";s:48:"components/mycomponent/javascript/myComponent.js";s:4:"b23b";}',
);

?>