<?php

########################################################################
# Extension Manager/Repository config file for ext "tkblog".
#
# Auto generated 07-04-2011 14:45
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
	'_md5_values_when_last_written' => 'a:89:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"dd87";s:14:"ext_tables.php";s:4:"f3ff";s:14:"ext_tables.sql";s:4:"ce70";s:41:"Classes/Controller/CategoryController.php";s:4:"7fec";s:40:"Classes/Controller/CommentController.php";s:4:"ab4c";s:37:"Classes/Controller/PostController.php";s:4:"8827";s:38:"Classes/Domain/Model/Administrator.php";s:4:"5c50";s:33:"Classes/Domain/Model/Category.php";s:4:"f2d7";s:32:"Classes/Domain/Model/Comment.php";s:4:"3d7b";s:32:"Classes/Domain/Model/Content.php";s:4:"bb81";s:29:"Classes/Domain/Model/Post.php";s:4:"2da9";s:53:"Classes/Domain/Repository/AdministratorRepository.php";s:4:"d627";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"6fef";s:47:"Classes/Domain/Repository/CommentRepository.php";s:4:"0a98";s:44:"Classes/Domain/Repository/PostRepository.php";s:4:"fae7";s:33:"Classes/Service/AvatarService.php";s:4:"e7a4";s:42:"Classes/ViewHelpers/GravatarViewHelper.php";s:4:"c9e4";s:41:"Classes/ViewHelpers/MetaTagViewHelper.php";s:4:"b93f";s:45:"Classes/ViewHelpers/SetPropertyViewHelper.php";s:4:"ff0a";s:43:"Classes/ViewHelpers/TranslateViewHelper.php";s:4:"13c2";s:41:"Classes/ViewHelpers/Be/IconViewHelper.php";s:4:"a3d2";s:46:"Classes/ViewHelpers/Be/TableListViewHelper.php";s:4:"3a70";s:49:"Classes/ViewHelpers/Document/AuthorViewHelper.php";s:4:"b63c";s:54:"Classes/ViewHelpers/Document/DescriptionViewHelper.php";s:4:"6e68";s:51:"Classes/ViewHelpers/Document/KeywordsViewHelper.php";s:4:"9c66";s:48:"Classes/ViewHelpers/Document/TitleViewHelper.php";s:4:"d52a";s:45:"Classes/ViewHelpers/Format/DateViewHelper.php";s:4:"ec87";s:50:"Classes/ViewHelpers/Format/MonthNameViewHelper.php";s:4:"516a";s:44:"Classes/ViewHelpers/Format/RawViewHelper.php";s:4:"d16d";s:53:"Classes/ViewHelpers/Widget/AutocompleteViewHelper.php";s:4:"f681";s:49:"Classes/ViewHelpers/Widget/PaginateViewHelper.php";s:4:"2142";s:64:"Classes/ViewHelpers/Widget/Controller/AutocompleteController.php";s:4:"d5c0";s:60:"Classes/ViewHelpers/Widget/Controller/PaginateController.php";s:4:"64ec";s:36:"Configuration/FlexForms/flexform.xml";s:4:"0f2b";s:30:"Configuration/TCA/Category.php";s:4:"5020";s:29:"Configuration/TCA/Comment.php";s:4:"db27";s:26:"Configuration/TCA/Post.php";s:4:"823f";s:38:"Configuration/TypoScript/constants.txt";s:4:"4597";s:34:"Configuration/TypoScript/setup.txt";s:4:"f563";s:40:"Resources/Private/Language/locallang.xml";s:4:"af85";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"d580";s:38:"Resources/Private/Layouts/Default.html";s:4:"1bfb";s:47:"Resources/Private/Partials/CategoryElement.html";s:4:"b749";s:46:"Resources/Private/Partials/CommentElement.html";s:4:"704b";s:43:"Resources/Private/Partials/CommentForm.html";s:4:"0f9f";s:44:"Resources/Private/Partials/DetailSocial.html";s:4:"b047";s:42:"Resources/Private/Partials/FormErrors.html";s:4:"1f8b";s:36:"Resources/Private/Partials/List.html";s:4:"eee2";s:43:"Resources/Private/Partials/ListElement.html";s:4:"fd9c";s:46:"Resources/Private/Partials/ListRawElement.html";s:4:"eeed";s:58:"Resources/Private/Templates/Category/CategoryOverview.html";s:4:"a20e";s:56:"Resources/Private/Templates/Category/CategoryWidget.html";s:4:"71de";s:61:"Resources/Private/Templates/Comment/LatestCommentsWidget.html";s:4:"a391";s:48:"Resources/Private/Templates/Message/Comment.html";s:4:"fdf0";s:47:"Resources/Private/Templates/Message/Comment.txt";s:4:"a88a";s:50:"Resources/Private/Templates/Post/CategoryList.html";s:4:"5a3a";s:49:"Resources/Private/Templates/Post/CommentsRss.html";s:4:"83f2";s:50:"Resources/Private/Templates/Post/DateMenuList.html";s:4:"5aca";s:52:"Resources/Private/Templates/Post/DateMenuWidget.html";s:4:"59ce";s:44:"Resources/Private/Templates/Post/Detail.html";s:4:"8258";s:55:"Resources/Private/Templates/Post/LatestPostsWidget.html";s:4:"8d10";s:42:"Resources/Private/Templates/Post/List.html";s:4:"d36a";s:45:"Resources/Private/Templates/Post/PostRss.html";s:4:"9ceb";s:48:"Resources/Private/Templates/Post/SearchList.html";s:4:"b5ea";s:50:"Resources/Private/Templates/Post/SearchWidget.html";s:4:"4e2d";s:49:"Resources/Private/Templates/Post/ViewsWidget.html";s:4:"df2e";s:70:"Resources/Private/Templates/ViewHelpers/Widget/Autocomplete/Index.html";s:4:"b955";s:66:"Resources/Private/Templates/ViewHelpers/Widget/Paginate/Index.html";s:4:"95ec";s:34:"Resources/Public/CSS/extension.css";s:4:"b7e1";s:42:"Resources/Public/CSS/images/breadCrumb.svg";s:4:"72e0";s:47:"Resources/Public/CSS/images/breadcrumb_left.png";s:4:"f809";s:48:"Resources/Public/CSS/images/breadcrumb_right.png";s:4:"37b2";s:46:"Resources/Public/CSS/images/breadcrumb_top.png";s:4:"b283";s:45:"Resources/Public/CSS/images/list-more-act.png";s:4:"47e1";s:41:"Resources/Public/CSS/images/list-more.png";s:4:"d836";s:41:"Resources/Public/CSS/images/list-more.svg";s:4:"e507";s:43:"Resources/Public/CSS/images/list_orange.png";s:4:"0c0c";s:44:"Resources/Public/CSS/images/list_sidebar.png";s:4:"0c0c";s:44:"Resources/Public/CSS/images/list_sidebar.svg";s:4:"2521";s:43:"Resources/Public/Icons/default_gravatar.gif";s:4:"6087";s:43:"Resources/Public/Icons/gravatar_default.png";s:4:"1199";s:43:"Resources/Public/Icons/openGraphDefault.png";s:4:"65a5";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:58:"Resources/Public/Icons/tx_tkblog_domain_model_category.gif";s:4:"1103";s:57:"Resources/Public/Icons/tx_tkblog_domain_model_comment.gif";s:4:"1103";s:54:"Resources/Public/Icons/tx_tkblog_domain_model_post.gif";s:4:"1103";s:32:"Resources/Public/JS/extension.js";s:4:"a4dc";s:36:"Resources/Public/JS/jquery.cookie.js";s:4:"e1fd";}',
);

?>