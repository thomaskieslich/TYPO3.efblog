<?php

########################################################################
# Extension Manager/Repository config file for ext "tkblog".
#
# Auto generated 08-03-2011 15:23
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
	'createDirs' => 'uploads/tx_tkblog',
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
	'_md5_values_when_last_written' => 'a:72:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"7959";s:14:"ext_tables.php";s:4:"9084";s:14:"ext_tables.sql";s:4:"7d32";s:24:"ext_typoscript_setup.txt";s:4:"e48a";s:41:"Classes/Controller/CategoryController.php";s:4:"4be3";s:39:"Classes/Controller/ModuleController.php";s:4:"8ba2";s:37:"Classes/Controller/PostController.php";s:4:"40a7";s:33:"Classes/Domain/Model/Category.php";s:4:"aeba";s:32:"Classes/Domain/Model/Content.php";s:4:"66f6";s:30:"Classes/Domain/Model/Pages.php";s:4:"c2fb";s:29:"Classes/Domain/Model/Post.php";s:4:"1033";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"d2d8";s:45:"Classes/Domain/Repository/PagesRepository.php";s:4:"ba49";s:44:"Classes/Domain/Repository/PostRepository.php";s:4:"4c8f";s:29:"Classes/Hooks/T3libBefunc.php";s:4:"4f7e";s:45:"Classes/ViewHelpers/SetPropertyViewHelper.php";s:4:"ff0a";s:41:"Classes/ViewHelpers/Be/IconViewHelper.php";s:4:"a3d2";s:46:"Classes/ViewHelpers/Be/TableListViewHelper.php";s:4:"3a70";s:54:"Classes/ViewHelpers/Document/DescriptionViewHelper.php";s:4:"3f43";s:51:"Classes/ViewHelpers/Document/KeywordsViewHelper.php";s:4:"f3eb";s:48:"Classes/ViewHelpers/Document/TitleViewHelper.php";s:4:"3c31";s:45:"Classes/ViewHelpers/Format/DateViewHelper.php";s:4:"ec87";s:53:"Classes/ViewHelpers/Widget/AutocompleteViewHelper.php";s:4:"f681";s:49:"Classes/ViewHelpers/Widget/PaginateViewHelper.php";s:4:"a813";s:64:"Classes/ViewHelpers/Widget/Controller/AutocompleteController.php";s:4:"d5c0";s:60:"Classes/ViewHelpers/Widget/Controller/PaginateController.php";s:4:"869f";s:36:"Configuration/FlexForms/flexform.xml";s:4:"7930";s:30:"Configuration/TCA/Category.php";s:4:"e77e";s:26:"Configuration/TCA/Post.php";s:4:"428f";s:38:"Configuration/TypoScript/constants.txt";s:4:"4597";s:34:"Configuration/TypoScript/setup.txt";s:4:"1221";s:46:"Resources/Private/Backend/Layouts/default.html";s:4:"c32a";s:52:"Resources/Private/Backend/Templates/Module/Hide.html";s:4:"956d";s:52:"Resources/Private/Backend/Templates/Module/List.html";s:4:"ddfb";s:40:"Resources/Private/Language/locallang.xml";s:4:"d96a";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"9703";s:44:"Resources/Private/Language/locallang_mod.xml";s:4:"c43c";s:38:"Resources/Private/Layouts/default.html";s:4:"1bfb";s:47:"Resources/Private/Partials/CategoryElement.html";s:4:"ddd2";s:44:"Resources/Private/Templates/Module/List.html";s:4:"c3d1";s:52:"Resources/Private/Templates/Post/CategoryWidget.html";s:4:"405d";s:52:"Resources/Private/Templates/Post/DateMenuWidget.html";s:4:"238c";s:44:"Resources/Private/Templates/Post/Detail.html";s:4:"e96c";s:50:"Resources/Private/Templates/Post/LatestWidget.html";s:4:"3e73";s:42:"Resources/Private/Templates/Post/List.html";s:4:"2a91";s:50:"Resources/Private/Templates/Post/SearchWidget.html";s:4:"88bc";s:49:"Resources/Private/Templates/Post/ViewsWidget.html";s:4:"5ccc";s:70:"Resources/Private/Templates/ViewHelpers/Widget/Autocomplete/Index.html";s:4:"b955";s:66:"Resources/Private/Templates/ViewHelpers/Widget/Paginate/Index.html";s:4:"9595";s:34:"Resources/Public/CSS/extension.css";s:4:"b882";s:44:"Resources/Public/CSS/images/list_sidebar.png";s:4:"0c0c";s:59:"Resources/Public/CSS/trontastic/jquery-ui-1.8.10.custom.css";s:4:"729e";s:80:"Resources/Public/CSS/trontastic/images/ui-bg_diagonals-small_50_262626_40x40.png";s:4:"f226";s:69:"Resources/Public/CSS/trontastic/images/ui-bg_flat_0_303030_40x100.png";s:4:"7cbb";s:69:"Resources/Public/CSS/trontastic/images/ui-bg_flat_0_4c4c4c_40x100.png";s:4:"fdb0";s:70:"Resources/Public/CSS/trontastic/images/ui-bg_glass_40_0a0a0a_1x400.png";s:4:"bbb0";s:70:"Resources/Public/CSS/trontastic/images/ui-bg_glass_55_f1fbe5_1x400.png";s:4:"b404";s:70:"Resources/Public/CSS/trontastic/images/ui-bg_glass_60_000000_1x400.png";s:4:"23d7";s:77:"Resources/Public/CSS/trontastic/images/ui-bg_gloss-wave_55_000000_500x100.png";s:4:"b4c8";s:77:"Resources/Public/CSS/trontastic/images/ui-bg_gloss-wave_85_9fda58_500x100.png";s:4:"4ca2";s:77:"Resources/Public/CSS/trontastic/images/ui-bg_gloss-wave_95_f6ecd5_500x100.png";s:4:"f833";s:66:"Resources/Public/CSS/trontastic/images/ui-icons_000000_256x240.png";s:4:"b16b";s:66:"Resources/Public/CSS/trontastic/images/ui-icons_1f1f1f_256x240.png";s:4:"7c89";s:66:"Resources/Public/CSS/trontastic/images/ui-icons_9fda58_256x240.png";s:4:"0607";s:66:"Resources/Public/CSS/trontastic/images/ui-icons_b8ec79_256x240.png";s:4:"0b61";s:66:"Resources/Public/CSS/trontastic/images/ui-icons_cd0a0a_256x240.png";s:4:"3e45";s:66:"Resources/Public/CSS/trontastic/images/ui-icons_ffffff_256x240.png";s:4:"342b";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:58:"Resources/Public/Icons/tx_tkblog_domain_model_category.gif";s:4:"1103";s:57:"Resources/Public/Icons/tx_tkblog_domain_model_comment.gif";s:4:"1103";s:54:"Resources/Public/Icons/tx_tkblog_domain_model_post.gif";s:4:"1103";}',
);

?>