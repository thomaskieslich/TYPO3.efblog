<?php

########################################################################
# Extension Manager/Repository config file for ext "efblog".
#
# Auto generated 15-04-2011 09:20
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Simple Blog',
	'description' => 'Blog- Newsextension, based on extbase/fluid.',
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
	'createDirs' => 'uploads/tx_efblog',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '0.0.1',
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
	'_md5_values_when_last_written' => 'a:90:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"dd87";s:14:"ext_tables.php";s:4:"343b";s:14:"ext_tables.sql";s:4:"b55e";s:41:"Classes/Controller/CategoryController.php";s:4:"29b8";s:40:"Classes/Controller/CommentController.php";s:4:"84c7";s:37:"Classes/Controller/PostController.php";s:4:"9681";s:38:"Classes/Domain/Model/Administrator.php";s:4:"9f57";s:33:"Classes/Domain/Model/Category.php";s:4:"7bb0";s:32:"Classes/Domain/Model/Comment.php";s:4:"8a10";s:32:"Classes/Domain/Model/Content.php";s:4:"5d47";s:29:"Classes/Domain/Model/Post.php";s:4:"8853";s:53:"Classes/Domain/Repository/AdministratorRepository.php";s:4:"b125";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"c8dc";s:47:"Classes/Domain/Repository/CommentRepository.php";s:4:"6600";s:44:"Classes/Domain/Repository/PostRepository.php";s:4:"65a0";s:33:"Classes/Service/AvatarService.php";s:4:"af96";s:42:"Classes/ViewHelpers/GravatarViewHelper.php";s:4:"9693";s:41:"Classes/ViewHelpers/MetaTagViewHelper.php";s:4:"59a5";s:45:"Classes/ViewHelpers/SetPropertyViewHelper.php";s:4:"9253";s:43:"Classes/ViewHelpers/TranslateViewHelper.php";s:4:"e863";s:41:"Classes/ViewHelpers/Be/IconViewHelper.php";s:4:"5b4f";s:46:"Classes/ViewHelpers/Be/TableListViewHelper.php";s:4:"4a75";s:49:"Classes/ViewHelpers/Document/AuthorViewHelper.php";s:4:"bf15";s:54:"Classes/ViewHelpers/Document/DescriptionViewHelper.php";s:4:"fe4b";s:51:"Classes/ViewHelpers/Document/KeywordsViewHelper.php";s:4:"724e";s:48:"Classes/ViewHelpers/Document/TitleViewHelper.php";s:4:"7fb4";s:45:"Classes/ViewHelpers/Format/DateViewHelper.php";s:4:"3492";s:50:"Classes/ViewHelpers/Format/MonthNameViewHelper.php";s:4:"99f6";s:44:"Classes/ViewHelpers/Format/RawViewHelper.php";s:4:"79a0";s:53:"Classes/ViewHelpers/Widget/AutocompleteViewHelper.php";s:4:"fc63";s:49:"Classes/ViewHelpers/Widget/PaginateViewHelper.php";s:4:"a347";s:64:"Classes/ViewHelpers/Widget/Controller/AutocompleteController.php";s:4:"6796";s:60:"Classes/ViewHelpers/Widget/Controller/PaginateController.php";s:4:"a1ab";s:36:"Configuration/FlexForms/flexform.xml";s:4:"42c8";s:30:"Configuration/TCA/Category.php";s:4:"c547";s:29:"Configuration/TCA/Comment.php";s:4:"b912";s:26:"Configuration/TCA/Post.php";s:4:"258f";s:38:"Configuration/TypoScript/constants.txt";s:4:"abf5";s:34:"Configuration/TypoScript/setup.txt";s:4:"2d60";s:40:"Resources/Private/Language/locallang.xml";s:4:"afaa";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"bb0d";s:38:"Resources/Private/Layouts/Default.html";s:4:"64da";s:47:"Resources/Private/Partials/CategoryElement.html";s:4:"9347";s:46:"Resources/Private/Partials/CommentElement.html";s:4:"fa56";s:43:"Resources/Private/Partials/CommentForm.html";s:4:"8498";s:44:"Resources/Private/Partials/DetailSocial.html";s:4:"8ecc";s:42:"Resources/Private/Partials/FormErrors.html";s:4:"1f8b";s:36:"Resources/Private/Partials/List.html";s:4:"f849";s:43:"Resources/Private/Partials/ListElement.html";s:4:"8345";s:46:"Resources/Private/Partials/ListRawElement.html";s:4:"396f";s:58:"Resources/Private/Templates/Category/CategoryOverview.html";s:4:"ce91";s:56:"Resources/Private/Templates/Category/CategoryWidget.html";s:4:"39cc";s:61:"Resources/Private/Templates/Comment/LatestCommentsWidget.html";s:4:"464d";s:48:"Resources/Private/Templates/Message/Comment.html";s:4:"72a0";s:47:"Resources/Private/Templates/Message/Comment.txt";s:4:"26ea";s:50:"Resources/Private/Templates/Post/CategoryList.html";s:4:"ce87";s:50:"Resources/Private/Templates/Post/CombinedList.html";s:4:"043c";s:49:"Resources/Private/Templates/Post/CommentsRss.html";s:4:"dba6";s:50:"Resources/Private/Templates/Post/DateMenuList.html";s:4:"ad70";s:52:"Resources/Private/Templates/Post/DateMenuWidget.html";s:4:"56a2";s:44:"Resources/Private/Templates/Post/Detail.html";s:4:"6549";s:55:"Resources/Private/Templates/Post/LatestPostsWidget.html";s:4:"3dd7";s:42:"Resources/Private/Templates/Post/List.html";s:4:"76ed";s:45:"Resources/Private/Templates/Post/PostRss.html";s:4:"6777";s:48:"Resources/Private/Templates/Post/SearchList.html";s:4:"8530";s:50:"Resources/Private/Templates/Post/SearchWidget.html";s:4:"e2d3";s:49:"Resources/Private/Templates/Post/ViewsWidget.html";s:4:"3097";s:70:"Resources/Private/Templates/ViewHelpers/Widget/Autocomplete/Index.html";s:4:"b955";s:66:"Resources/Private/Templates/ViewHelpers/Widget/Paginate/Index.html";s:4:"bf3d";s:34:"Resources/Public/CSS/extension.css";s:4:"9de4";s:42:"Resources/Public/CSS/images/breadCrumb.svg";s:4:"72e0";s:47:"Resources/Public/CSS/images/breadcrumb_left.png";s:4:"f809";s:48:"Resources/Public/CSS/images/breadcrumb_right.png";s:4:"37b2";s:46:"Resources/Public/CSS/images/breadcrumb_top.png";s:4:"b283";s:45:"Resources/Public/CSS/images/list-more-act.png";s:4:"47e1";s:41:"Resources/Public/CSS/images/list-more.png";s:4:"d836";s:41:"Resources/Public/CSS/images/list-more.svg";s:4:"e507";s:43:"Resources/Public/CSS/images/list_orange.png";s:4:"0c0c";s:44:"Resources/Public/CSS/images/list_sidebar.png";s:4:"0c0c";s:44:"Resources/Public/CSS/images/list_sidebar.svg";s:4:"2521";s:43:"Resources/Public/Icons/default_gravatar.gif";s:4:"6087";s:43:"Resources/Public/Icons/gravatar_default.png";s:4:"1199";s:43:"Resources/Public/Icons/openGraphDefault.png";s:4:"65a5";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:58:"Resources/Public/Icons/tx_efblog_domain_model_category.gif";s:4:"1103";s:57:"Resources/Public/Icons/tx_efblog_domain_model_comment.gif";s:4:"1103";s:54:"Resources/Public/Icons/tx_efblog_domain_model_post.gif";s:4:"1103";s:32:"Resources/Public/JS/extension.js";s:4:"89e1";s:36:"Resources/Public/JS/jquery.cookie.js";s:4:"e1fd";}',
);

?>