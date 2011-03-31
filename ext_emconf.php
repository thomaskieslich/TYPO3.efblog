<?php

########################################################################
# Extension Manager/Repository config file for ext "tkblog".
#
# Auto generated 31-03-2011 10:16
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
	'_md5_values_when_last_written' => 'a:76:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"5662";s:14:"ext_tables.php";s:4:"b526";s:14:"ext_tables.sql";s:4:"fd9c";s:41:"Classes/Controller/CategoryController.php";s:4:"4be3";s:40:"Classes/Controller/CommentController.php";s:4:"eb30";s:37:"Classes/Controller/PostController.php";s:4:"8e54";s:38:"Classes/Domain/Model/Administrator.php";s:4:"5c50";s:33:"Classes/Domain/Model/Category.php";s:4:"1f02";s:32:"Classes/Domain/Model/Comment.php";s:4:"3b78";s:32:"Classes/Domain/Model/Content.php";s:4:"bb81";s:29:"Classes/Domain/Model/Post.php";s:4:"285b";s:53:"Classes/Domain/Repository/AdministratorRepository.php";s:4:"d627";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"d2d8";s:47:"Classes/Domain/Repository/CommentRepository.php";s:4:"d99f";s:44:"Classes/Domain/Repository/PostRepository.php";s:4:"4a4d";s:33:"Classes/Service/AvatarService.php";s:4:"e7a4";s:42:"Classes/ViewHelpers/GravatarViewHelper.php";s:4:"c9e4";s:45:"Classes/ViewHelpers/SetPropertyViewHelper.php";s:4:"ff0a";s:43:"Classes/ViewHelpers/TranslateViewHelper.php";s:4:"13c2";s:41:"Classes/ViewHelpers/Be/IconViewHelper.php";s:4:"a3d2";s:46:"Classes/ViewHelpers/Be/TableListViewHelper.php";s:4:"3a70";s:49:"Classes/ViewHelpers/Document/AuthorViewHelper.php";s:4:"b63c";s:54:"Classes/ViewHelpers/Document/DescriptionViewHelper.php";s:4:"6e68";s:51:"Classes/ViewHelpers/Document/KeywordsViewHelper.php";s:4:"9c66";s:48:"Classes/ViewHelpers/Document/TitleViewHelper.php";s:4:"d52a";s:45:"Classes/ViewHelpers/Format/DateViewHelper.php";s:4:"ec87";s:50:"Classes/ViewHelpers/Format/MonthNameViewHelper.php";s:4:"516a";s:44:"Classes/ViewHelpers/Format/RawViewHelper.php";s:4:"d16d";s:53:"Classes/ViewHelpers/Widget/AutocompleteViewHelper.php";s:4:"f681";s:49:"Classes/ViewHelpers/Widget/PaginateViewHelper.php";s:4:"2142";s:64:"Classes/ViewHelpers/Widget/Controller/AutocompleteController.php";s:4:"d5c0";s:60:"Classes/ViewHelpers/Widget/Controller/PaginateController.php";s:4:"33a4";s:36:"Configuration/FlexForms/flexform.xml";s:4:"780b";s:30:"Configuration/TCA/Category.php";s:4:"5020";s:29:"Configuration/TCA/Comment.php";s:4:"db27";s:26:"Configuration/TCA/Post.php";s:4:"0c4b";s:38:"Configuration/TypoScript/constants.txt";s:4:"4597";s:34:"Configuration/TypoScript/setup.txt";s:4:"82e9";s:40:"Resources/Private/Language/locallang.xml";s:4:"1931";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"55df";s:38:"Resources/Private/Layouts/default.html";s:4:"1bfb";s:47:"Resources/Private/Partials/CategoryElement.html";s:4:"b28e";s:46:"Resources/Private/Partials/CommentElement.html";s:4:"f828";s:43:"Resources/Private/Partials/CommentForm.html";s:4:"326e";s:42:"Resources/Private/Partials/FormErrors.html";s:4:"1f8b";s:36:"Resources/Private/Partials/List.html";s:4:"41ad";s:43:"Resources/Private/Partials/ListElement.html";s:4:"c514";s:46:"Resources/Private/Partials/ListRawElement.html";s:4:"f0b7";s:48:"Resources/Private/Templates/Message/Comment.html";s:4:"fdf0";s:47:"Resources/Private/Templates/Message/Comment.txt";s:4:"a88a";s:49:"Resources/Private/Templates/Post/ArchiveList.html";s:4:"d449";s:50:"Resources/Private/Templates/Post/CategoryList.html";s:4:"1eb8";s:54:"Resources/Private/Templates/Post/CategoryOverview.html";s:4:"7834";s:52:"Resources/Private/Templates/Post/CategoryWidget.html";s:4:"df7d";s:49:"Resources/Private/Templates/Post/CommentsRss.html";s:4:"e92c";s:52:"Resources/Private/Templates/Post/DateMenuWidget.html";s:4:"0149";s:44:"Resources/Private/Templates/Post/Detail.html";s:4:"2d4b";s:50:"Resources/Private/Templates/Post/LatestWidget.html";s:4:"01fc";s:42:"Resources/Private/Templates/Post/List.html";s:4:"189f";s:45:"Resources/Private/Templates/Post/PostRss.html";s:4:"9ceb";s:48:"Resources/Private/Templates/Post/SearchList.html";s:4:"9aa5";s:50:"Resources/Private/Templates/Post/SearchWidget.html";s:4:"096e";s:49:"Resources/Private/Templates/Post/ViewsWidget.html";s:4:"0d2a";s:70:"Resources/Private/Templates/ViewHelpers/Widget/Autocomplete/Index.html";s:4:"b955";s:66:"Resources/Private/Templates/ViewHelpers/Widget/Paginate/Index.html";s:4:"95ec";s:34:"Resources/Public/CSS/extension.css";s:4:"32a6";s:44:"Resources/Public/CSS/images/list_sidebar.png";s:4:"0c0c";s:43:"Resources/Public/Icons/default_gravatar.gif";s:4:"6087";s:43:"Resources/Public/Icons/gravatar_default.png";s:4:"b4bc";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:58:"Resources/Public/Icons/tx_tkblog_domain_model_category.gif";s:4:"1103";s:57:"Resources/Public/Icons/tx_tkblog_domain_model_comment.gif";s:4:"1103";s:54:"Resources/Public/Icons/tx_tkblog_domain_model_post.gif";s:4:"1103";s:32:"Resources/Public/JS/extension.js";s:4:"a4dc";s:36:"Resources/Public/JS/jquery.cookie.js";s:4:"e1fd";}',
);

?>