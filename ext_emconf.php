<?php

########################################################################
# Extension Manager/Repository config file for ext "tkblog".
#
# Auto generated 18-03-2011 18:43
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
	'_md5_values_when_last_written' => 'a:69:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"fc60";s:14:"ext_tables.php";s:4:"0b1c";s:14:"ext_tables.sql";s:4:"9b9c";s:24:"ext_typoscript_setup.txt";s:4:"e48a";s:41:"Classes/Controller/CategoryController.php";s:4:"4be3";s:40:"Classes/Controller/CommentController.php";s:4:"b08d";s:39:"Classes/Controller/ModuleController.php";s:4:"8ba2";s:37:"Classes/Controller/PostController.php";s:4:"badb";s:33:"Classes/Domain/Model/Category.php";s:4:"fea3";s:32:"Classes/Domain/Model/Comment.php";s:4:"4b6d";s:32:"Classes/Domain/Model/Content.php";s:4:"66f6";s:30:"Classes/Domain/Model/Pages.php";s:4:"c2fb";s:29:"Classes/Domain/Model/Post.php";s:4:"cf60";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"d2d8";s:45:"Classes/Domain/Repository/PagesRepository.php";s:4:"ba49";s:44:"Classes/Domain/Repository/PostRepository.php";s:4:"a0c0";s:29:"Classes/Hooks/T3libBefunc.php";s:4:"2ab1";s:42:"Classes/ViewHelpers/GravatarViewHelper.php";s:4:"c9e4";s:45:"Classes/ViewHelpers/SetPropertyViewHelper.php";s:4:"ff0a";s:41:"Classes/ViewHelpers/Be/IconViewHelper.php";s:4:"a3d2";s:46:"Classes/ViewHelpers/Be/TableListViewHelper.php";s:4:"3a70";s:54:"Classes/ViewHelpers/Document/DescriptionViewHelper.php";s:4:"3f43";s:51:"Classes/ViewHelpers/Document/KeywordsViewHelper.php";s:4:"f3eb";s:48:"Classes/ViewHelpers/Document/TitleViewHelper.php";s:4:"d52a";s:45:"Classes/ViewHelpers/Format/DateViewHelper.php";s:4:"ec87";s:50:"Classes/ViewHelpers/Format/MonthNameViewHelper.php";s:4:"516a";s:53:"Classes/ViewHelpers/Widget/AutocompleteViewHelper.php";s:4:"f681";s:49:"Classes/ViewHelpers/Widget/PaginateViewHelper.php";s:4:"a813";s:64:"Classes/ViewHelpers/Widget/Controller/AutocompleteController.php";s:4:"d5c0";s:60:"Classes/ViewHelpers/Widget/Controller/PaginateController.php";s:4:"33a4";s:36:"Configuration/FlexForms/flexform.xml";s:4:"e0ab";s:30:"Configuration/TCA/Category.php";s:4:"b357";s:29:"Configuration/TCA/Comment.php";s:4:"7880";s:26:"Configuration/TCA/Post.php";s:4:"b763";s:38:"Configuration/TypoScript/constants.txt";s:4:"4597";s:34:"Configuration/TypoScript/setup.txt";s:4:"85dd";s:46:"Resources/Private/Backend/Layouts/default.html";s:4:"c32a";s:52:"Resources/Private/Backend/Templates/Module/List.html";s:4:"09d8";s:40:"Resources/Private/Language/locallang.xml";s:4:"ccb8";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"0253";s:44:"Resources/Private/Language/locallang_mod.xml";s:4:"c43c";s:38:"Resources/Private/Layouts/default.html";s:4:"1bfb";s:47:"Resources/Private/Partials/CategoryElement.html";s:4:"fb28";s:43:"Resources/Private/Partials/CommentForm.html";s:4:"a286";s:42:"Resources/Private/Partials/FormErrors.html";s:4:"a141";s:44:"Resources/Private/Templates/Module/List.html";s:4:"c3d1";s:50:"Resources/Private/Templates/Post/CategoryView.html";s:4:"ebac";s:52:"Resources/Private/Templates/Post/CategoryWidget.html";s:4:"a6ec";s:52:"Resources/Private/Templates/Post/DateMenuWidget.html";s:4:"e683";s:44:"Resources/Private/Templates/Post/Detail.html";s:4:"20a1";s:50:"Resources/Private/Templates/Post/LatestWidget.html";s:4:"3ad3";s:42:"Resources/Private/Templates/Post/List.html";s:4:"6afe";s:41:"Resources/Private/Templates/Post/Rss.html";s:4:"f4bc";s:48:"Resources/Private/Templates/Post/SearchView.html";s:4:"94b2";s:50:"Resources/Private/Templates/Post/SearchWidget.html";s:4:"b007";s:49:"Resources/Private/Templates/Post/ViewsWidget.html";s:4:"28ce";s:70:"Resources/Private/Templates/ViewHelpers/Widget/Autocomplete/Index.html";s:4:"b955";s:66:"Resources/Private/Templates/ViewHelpers/Widget/Paginate/Index.html";s:4:"95ec";s:34:"Resources/Public/CSS/extension.css";s:4:"5df9";s:44:"Resources/Public/CSS/images/list_sidebar.png";s:4:"0c0c";s:43:"Resources/Public/Icons/default_gravatar.gif";s:4:"6087";s:43:"Resources/Public/Icons/gravatar_default.png";s:4:"b4bc";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:58:"Resources/Public/Icons/tx_tkblog_domain_model_category.gif";s:4:"1103";s:57:"Resources/Public/Icons/tx_tkblog_domain_model_comment.gif";s:4:"1103";s:54:"Resources/Public/Icons/tx_tkblog_domain_model_post.gif";s:4:"1103";s:32:"Resources/Public/JS/extension.js";s:4:"5b7f";s:36:"Resources/Public/JS/jquery.cookie.js";s:4:"e1fd";}',
);

?>