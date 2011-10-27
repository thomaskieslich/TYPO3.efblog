<?php

########################################################################
# Extension Manager/Repository config file for ext "efblog".
#
# Auto generated 20-10-2011 17:41
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
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => 'uploads/tx_efblog',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '0.0.12',
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
	'_md5_values_when_last_written' => 'a:138:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"2f9e";s:14:"ext_tables.php";s:4:"63dd";s:14:"ext_tables.sql";s:4:"4c20";s:41:"Classes/Controller/AbstractController.php";s:4:"4e8b";s:41:"Classes/Controller/CategoryController.php";s:4:"a4d8";s:40:"Classes/Controller/CommentController.php";s:4:"f978";s:37:"Classes/Controller/PostController.php";s:4:"9355";s:38:"Classes/Domain/Model/Administrator.php";s:4:"adab";s:33:"Classes/Domain/Model/Category.php";s:4:"7bb0";s:32:"Classes/Domain/Model/Comment.php";s:4:"1e7f";s:32:"Classes/Domain/Model/Content.php";s:4:"5d47";s:29:"Classes/Domain/Model/Post.php";s:4:"48f1";s:53:"Classes/Domain/Repository/AdministratorRepository.php";s:4:"b125";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"c8dc";s:47:"Classes/Domain/Repository/CommentRepository.php";s:4:"6600";s:44:"Classes/Domain/Repository/PostRepository.php";s:4:"241b";s:48:"Classes/Domain/Validator/EmptyEmailValidator.php";s:4:"d0ea";s:33:"Classes/Service/AvatarService.php";s:4:"af96";s:42:"Classes/ViewHelpers/GravatarViewHelper.php";s:4:"9693";s:41:"Classes/ViewHelpers/MetaTagViewHelper.php";s:4:"59a5";s:45:"Classes/ViewHelpers/SetPropertyViewHelper.php";s:4:"9253";s:43:"Classes/ViewHelpers/TranslateViewHelper.php";s:4:"e863";s:41:"Classes/ViewHelpers/Be/IconViewHelper.php";s:4:"5b4f";s:46:"Classes/ViewHelpers/Be/TableListViewHelper.php";s:4:"4a75";s:49:"Classes/ViewHelpers/Document/AuthorViewHelper.php";s:4:"bf15";s:54:"Classes/ViewHelpers/Document/DescriptionViewHelper.php";s:4:"fe4b";s:51:"Classes/ViewHelpers/Document/KeywordsViewHelper.php";s:4:"724e";s:48:"Classes/ViewHelpers/Document/TitleViewHelper.php";s:4:"7fb4";s:45:"Classes/ViewHelpers/Format/DateViewHelper.php";s:4:"3492";s:50:"Classes/ViewHelpers/Format/MonthNameViewHelper.php";s:4:"99f6";s:44:"Classes/ViewHelpers/Format/RawViewHelper.php";s:4:"79a0";s:53:"Classes/ViewHelpers/Widget/AutocompleteViewHelper.php";s:4:"fc63";s:49:"Classes/ViewHelpers/Widget/CalendarViewHelper.php";s:4:"4732";s:49:"Classes/ViewHelpers/Widget/PaginateViewHelper.php";s:4:"a347";s:64:"Classes/ViewHelpers/Widget/Controller/AutocompleteController.php";s:4:"6796";s:60:"Classes/ViewHelpers/Widget/Controller/CalendarController.php";s:4:"0f24";s:60:"Classes/ViewHelpers/Widget/Controller/PaginateController.php";s:4:"a1ab";s:36:"Configuration/FlexForms/flexform.xml";s:4:"d644";s:30:"Configuration/TCA/Category.php";s:4:"c547";s:29:"Configuration/TCA/Comment.php";s:4:"1c93";s:26:"Configuration/TCA/Post.php";s:4:"b852";s:38:"Configuration/TypoScript/constants.txt";s:4:"abf5";s:34:"Configuration/TypoScript/setup.txt";s:4:"d126";s:40:"Resources/Private/Language/locallang.xml";s:4:"5400";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"d0e6";s:38:"Resources/Private/Layouts/Default.html";s:4:"64da";s:47:"Resources/Private/Partials/CategoryElement.html";s:4:"9347";s:46:"Resources/Private/Partials/CommentElement.html";s:4:"fa56";s:43:"Resources/Private/Partials/CommentForm.html";s:4:"8498";s:44:"Resources/Private/Partials/DetailSocial.html";s:4:"c062";s:42:"Resources/Private/Partials/FormErrors.html";s:4:"1f8b";s:36:"Resources/Private/Partials/List.html";s:4:"f849";s:43:"Resources/Private/Partials/ListElement.html";s:4:"8345";s:46:"Resources/Private/Partials/ListRawElement.html";s:4:"396f";s:58:"Resources/Private/Templates/Category/CategoryOverview.html";s:4:"ce91";s:56:"Resources/Private/Templates/Category/CategoryWidget.html";s:4:"39cc";s:61:"Resources/Private/Templates/Comment/LatestCommentsWidget.html";s:4:"464d";s:48:"Resources/Private/Templates/Message/Comment.html";s:4:"5e87";s:47:"Resources/Private/Templates/Message/Comment.txt";s:4:"dbde";s:50:"Resources/Private/Templates/Post/CalendarView.html";s:4:"eeb8";s:50:"Resources/Private/Templates/Post/CategoryList.html";s:4:"ce87";s:50:"Resources/Private/Templates/Post/CombinedList.html";s:4:"043c";s:49:"Resources/Private/Templates/Post/CombinedRss.html";s:4:"8e0c";s:49:"Resources/Private/Templates/Post/CommentsRss.html";s:4:"dba6";s:50:"Resources/Private/Templates/Post/DateMenuList.html";s:4:"ad70";s:52:"Resources/Private/Templates/Post/DateMenuWidget.html";s:4:"56a2";s:44:"Resources/Private/Templates/Post/Detail.html";s:4:"2037";s:55:"Resources/Private/Templates/Post/LatestPostsWidget.html";s:4:"3dd7";s:42:"Resources/Private/Templates/Post/List.html";s:4:"76ed";s:45:"Resources/Private/Templates/Post/PostRss.html";s:4:"5185";s:48:"Resources/Private/Templates/Post/SearchList.html";s:4:"8530";s:50:"Resources/Private/Templates/Post/SearchWidget.html";s:4:"e2d3";s:49:"Resources/Private/Templates/Post/ViewsWidget.html";s:4:"3097";s:70:"Resources/Private/Templates/ViewHelpers/Widget/Autocomplete/Index.html";s:4:"b955";s:66:"Resources/Private/Templates/ViewHelpers/Widget/Calendar/Index.html";s:4:"71b2";s:66:"Resources/Private/Templates/ViewHelpers/Widget/Paginate/Index.html";s:4:"bf3d";s:34:"Resources/Public/CSS/extension.css";s:4:"e5fd";s:42:"Resources/Public/CSS/images/breadCrumb.svg";s:4:"72e0";s:47:"Resources/Public/CSS/images/breadcrumb_left.png";s:4:"f809";s:48:"Resources/Public/CSS/images/breadcrumb_right.png";s:4:"37b2";s:46:"Resources/Public/CSS/images/breadcrumb_top.png";s:4:"b283";s:45:"Resources/Public/CSS/images/list-more-act.png";s:4:"47e1";s:41:"Resources/Public/CSS/images/list-more.png";s:4:"d836";s:41:"Resources/Public/CSS/images/list-more.svg";s:4:"e507";s:43:"Resources/Public/CSS/images/list_orange.png";s:4:"0c0c";s:44:"Resources/Public/CSS/images/list_sidebar.png";s:4:"0c0c";s:44:"Resources/Public/CSS/images/list_sidebar.svg";s:4:"2521";s:58:"Resources/Public/CSS/uithemes/base/jquery.ui.accordion.css";s:4:"4de2";s:52:"Resources/Public/CSS/uithemes/base/jquery.ui.all.css";s:4:"c891";s:61:"Resources/Public/CSS/uithemes/base/jquery.ui.autocomplete.css";s:4:"7f6c";s:53:"Resources/Public/CSS/uithemes/base/jquery.ui.base.css";s:4:"acc3";s:55:"Resources/Public/CSS/uithemes/base/jquery.ui.button.css";s:4:"1712";s:53:"Resources/Public/CSS/uithemes/base/jquery.ui.core.css";s:4:"1e5f";s:59:"Resources/Public/CSS/uithemes/base/jquery.ui.datepicker.css";s:4:"0c4d";s:55:"Resources/Public/CSS/uithemes/base/jquery.ui.dialog.css";s:4:"d448";s:60:"Resources/Public/CSS/uithemes/base/jquery.ui.progressbar.css";s:4:"91bd";s:58:"Resources/Public/CSS/uithemes/base/jquery.ui.resizable.css";s:4:"7971";s:59:"Resources/Public/CSS/uithemes/base/jquery.ui.selectable.css";s:4:"5b81";s:55:"Resources/Public/CSS/uithemes/base/jquery.ui.slider.css";s:4:"299a";s:53:"Resources/Public/CSS/uithemes/base/jquery.ui.tabs.css";s:4:"7322";s:54:"Resources/Public/CSS/uithemes/base/jquery.ui.theme.css";s:4:"ab6e";s:72:"Resources/Public/CSS/uithemes/base/images/ui-bg_flat_0_aaaaaa_40x100.png";s:4:"2a44";s:73:"Resources/Public/CSS/uithemes/base/images/ui-bg_flat_75_ffffff_40x100.png";s:4:"8692";s:73:"Resources/Public/CSS/uithemes/base/images/ui-bg_glass_55_fbf9ee_1x400.png";s:4:"f8f4";s:73:"Resources/Public/CSS/uithemes/base/images/ui-bg_glass_65_ffffff_1x400.png";s:4:"e5a8";s:73:"Resources/Public/CSS/uithemes/base/images/ui-bg_glass_75_dadada_1x400.png";s:4:"c12c";s:73:"Resources/Public/CSS/uithemes/base/images/ui-bg_glass_75_e6e6e6_1x400.png";s:4:"f425";s:73:"Resources/Public/CSS/uithemes/base/images/ui-bg_glass_95_fef1ec_1x400.png";s:4:"5a3b";s:82:"Resources/Public/CSS/uithemes/base/images/ui-bg_highlight-soft_75_cccccc_1x100.png";s:4:"72c5";s:69:"Resources/Public/CSS/uithemes/base/images/ui-icons_222222_256x240.png";s:4:"9129";s:69:"Resources/Public/CSS/uithemes/base/images/ui-icons_2e83ff_256x240.png";s:4:"2516";s:69:"Resources/Public/CSS/uithemes/base/images/ui-icons_454545_256x240.png";s:4:"7710";s:69:"Resources/Public/CSS/uithemes/base/images/ui-icons_888888_256x240.png";s:4:"faf6";s:69:"Resources/Public/CSS/uithemes/base/images/ui-icons_cd0a0a_256x240.png";s:4:"5d88";s:68:"Resources/Public/CSS/uithemes/smoothness/jquery-ui-1.8.14.custom.css";s:4:"e3be";s:78:"Resources/Public/CSS/uithemes/smoothness/images/ui-bg_flat_0_aaaaaa_40x100.png";s:4:"2a44";s:79:"Resources/Public/CSS/uithemes/smoothness/images/ui-bg_flat_75_ffffff_40x100.png";s:4:"8692";s:79:"Resources/Public/CSS/uithemes/smoothness/images/ui-bg_glass_55_fbf9ee_1x400.png";s:4:"f8f4";s:79:"Resources/Public/CSS/uithemes/smoothness/images/ui-bg_glass_65_ffffff_1x400.png";s:4:"e5a8";s:79:"Resources/Public/CSS/uithemes/smoothness/images/ui-bg_glass_75_dadada_1x400.png";s:4:"c12c";s:79:"Resources/Public/CSS/uithemes/smoothness/images/ui-bg_glass_75_e6e6e6_1x400.png";s:4:"f425";s:79:"Resources/Public/CSS/uithemes/smoothness/images/ui-bg_glass_95_fef1ec_1x400.png";s:4:"5a3b";s:88:"Resources/Public/CSS/uithemes/smoothness/images/ui-bg_highlight-soft_75_cccccc_1x100.png";s:4:"72c5";s:75:"Resources/Public/CSS/uithemes/smoothness/images/ui-icons_222222_256x240.png";s:4:"ebe6";s:75:"Resources/Public/CSS/uithemes/smoothness/images/ui-icons_2e83ff_256x240.png";s:4:"2b99";s:75:"Resources/Public/CSS/uithemes/smoothness/images/ui-icons_454545_256x240.png";s:4:"119d";s:75:"Resources/Public/CSS/uithemes/smoothness/images/ui-icons_888888_256x240.png";s:4:"9c46";s:75:"Resources/Public/CSS/uithemes/smoothness/images/ui-icons_cd0a0a_256x240.png";s:4:"3e45";s:43:"Resources/Public/Icons/default_gravatar.gif";s:4:"6087";s:43:"Resources/Public/Icons/gravatar_default.png";s:4:"1199";s:43:"Resources/Public/Icons/openGraphDefault.png";s:4:"65a5";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:58:"Resources/Public/Icons/tx_efblog_domain_model_category.gif";s:4:"1103";s:57:"Resources/Public/Icons/tx_efblog_domain_model_comment.gif";s:4:"1103";s:54:"Resources/Public/Icons/tx_efblog_domain_model_post.gif";s:4:"1103";s:32:"Resources/Public/JS/extension.js";s:4:"89e1";s:36:"Resources/Public/JS/jquery.cookie.js";s:4:"e1fd";}',
);

?>