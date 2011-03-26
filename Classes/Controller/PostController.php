<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * Controller for the Post object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Tkblog_Controller_PostController extends Tx_Extbase_MVC_Controller_ActionController {

    /**
     * @var	array
     */
    protected $settings;
    /**
     * @var	array
     */
    protected $setup;
    /**
     * @var	array
     */
    protected $persistence;
    /**
     * @var Tx_Tkblog_Domain_Repository_PostRepository
     */
    protected $postRepository;
    /**
     *
     * @var object 
     */
    protected $cObj;

    /**
     * Initializes the current action
     *
     * @return void
     */
    protected function initializeAction () {
        $this->postRepository = $this->objectManager->get('Tx_Tkblog_Domain_Repository_PostRepository');
        $defaultSettings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK, 'tkblog', 'tkblog_fe1');
        $flexSettings = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);

        // start override
        if (isset($defaultSettings['settings']['overrideFlexformSettingsIfEmpty'])) {
            $overrideCategories = t3lib_div::trimExplode(',', $defaultSettings['settings']['overrideFlexformSettingsIfEmpty'], TRUE);
            foreach ($overrideCategories as $category) {
                $overrideSettings = t3lib_div::trimExplode('.', $category, TRUE);
                if ((!isset($flexSettings['settings'][$overrideSettings[0]][$overrideSettings[1]]) || empty($flexSettings['settings'][$overrideSettings[0]][$overrideSettings[1]]))
                        && isset($defaultSettings['settings'][$overrideSettings[0]][$overrideSettings[1]])) {
                    $flexSettings['settings'][$overrideSettings[0]][$overrideSettings[1]] = $defaultSettings['settings'][$overrideSettings[0]][$overrideSettings[1]];
                }
            }
        }

        $this->settings = $flexSettings['settings'];
        $this->persistence = $flexSettings['persistence'];
        $this->setup = $defaultSettings['settings'];

        //get cObj
        $this->cObj = $this->configurationManager->getContentObject();
    }

    /**
     * list action
     *
     * @return string The rendered list action
     */
    public function listAction () {
        $pagerConfig = array (
            'itemsPerPage' => $this->settings['displayList']['itemsPerPage'],
            'insertAbove' => $this->settings['displayList']['insertAbove'],
            'insertBelow' => $this->settings['displayList']['insertBelow'],
            'maxPages' => $this->settings['displayList']['maxPages']
        );
        $this->view->assign('pagerConfig', $pagerConfig);


        $request = $this->request->getArguments();
        if (isset($request['category'])) {
            $this->settings['displayList']['category'] = $this->request->getArgument('category');
        }

        if (isset($request['searchPhrase'])) {
            $this->settings['displayList']['searchPhrase'] = $this->request->getArgument('searchPhrase');
        }

        if (isset($request['year'])) {
            $this->settings['displayList']['year'] = $this->request->getArgument('year');
        }

        if (isset($request['month'])) {
            $this->settings['displayList']['month'] = $this->request->getArgument('month');
        }

        $this->view->assign('posts', $this->postRepository->findPosts($this->settings));
    }

    /**
     * post detail
     * @param Tx_Tkblog_Domain_Model_Post $post
     * 
     */
    public function detailAction (Tx_Tkblog_Domain_Model_Post $post = NULL) {
        if ($post) {

            $content = $post->getContent();
            $pages = array ();
            $divider = 0;

            foreach ($content as $single) {
                if ($single->getCtype() == $this->settings['displaySingle']['divType']) {
                    $divider++;
                    $pages[$divider][title] = $single->getHeader();
                }
                if ($single->getCtype() != $this->settings['displaySingle']['divType']) {
                    $pages[$divider][elements][] = $single;
                }
            }

            $this->view->assign('pages', $pages);
            $this->view->assign('setup', $this->setup);
            $this->view->assign('post', $post);

            //Update Views
            $currentViews = $post->getViews();
            $post->setViews($currentViews + 1);

            //render Description
            if ($post->getTeaserDescription()) {
                $description = $post->getTeaserDescription();
            } else {
                $singleCounter = 0;
                foreach ($content as $element) {
                    if ($singleCounter == 0 && $element->getBodytext()) {
                        $description = $element->getBodytext();
                        $singleCounter++;
                    }
                }
            }
            $this->view->assign('description', strip_tags($description));
        } else {
            $this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('notice_noPost', $this->extensionName), Tx_Extbase_Utility_Localization::translate('notice_error', $this->extensionName), t3lib_Flashmessage::WARNING);
        }
    }

    public function latestWidgetAction () {
        $this->view->assign('posts', $this->postRepository->findLatest((int) $this->settings['latestWidget']['maxEntrys']));
        $this->view->assign('header', $this->cObj->data['header']);
    }

    public function viewsWidgetAction () {
        $this->view->assign('posts', $this->postRepository->findViews((int) $this->settings['viewsWidget']['maxEntrys']));
        $this->view->assign('header', $this->cObj->data['header']);
    }

    public function searchWidgetAction () {
        $this->view->assign('header', $this->cObj->data['header']);
    }

    public function searchViewAction () {
        $request = $this->request->getArguments();
        if (isset($request['searchPhrase'])) {
            $this->settings['displayList']['searchPhrase'] = $this->request->getArgument('searchPhrase');
            $this->view->assign('searchPhrase', $this->request->getArgument('searchPhrase'));
        }
        $this->view->assign('posts', $this->postRepository->findPosts($this->settings));

        $pagerConfig = array (
            'itemsPerPage' => $this->settings['displayList']['itemsPerPage'],
            'insertAbove' => $this->settings['displayList']['insertAbove'],
            'insertBelow' => $this->settings['displayList']['insertBelow'],
            'maxPages' => $this->settings['displayList']['maxPages']
        );
        $this->view->assign('pagerConfig', $pagerConfig);
    }

    public function categoryWidgetAction () {
        $categoryRepository = $this->objectManager->get('Tx_Tkblog_Domain_Repository_CategoryRepository');
        $this->view->assign('categories', $categoryRepository->findMainCategory());
        $this->view->assign('header', $this->cObj->data['header']);
    }

    public function categoryViewAction () {
        $categoryRepository = $this->objectManager->get('Tx_Tkblog_Domain_Repository_CategoryRepository');
        $this->view->assign('categories', $categoryRepository->findMainCategory());
    }

    public function dateMenuWidgetAction () {
        $this->settings['displayList']['orderBy'] = 'date';
        $this->view->assign('posts', $this->postRepository->findPosts($this->settings));
        $this->view->assign('header', $this->cObj->data['header']);
    }

    public function rssAction () {
        $posts = $this->postRepository->findLatest((int) 25);
        $rssItems = array ();

        foreach ($posts as $key => $post) {
            $rssItems[$key]['title'] = $post->getTitle();
            $rssItems[$key]['date'] = $post->getDate();
            $rssItems[$key]['post'] = $post->getUid();

            $content = $post->getContent();
            //render Description
            if ($post->getTeaserDescription()) {
                $description = $post->getTeaserDescription();
            } else {
                $singleCounter = 0;
                foreach ($content as $element) {
                    if ($singleCounter == 0 && $element->getBodytext()) {
                        $description = $element->getBodytext();
                        $singleCounter++;
                    }
                }
            }
            $rssItems[$key]['description'] = strip_tags($description);
            $categories = '';

            foreach ($post->getCategories() as $category) {
                $categories .= $category->getTitle() . ' ';
            }
            $rssItems[$key]['categories'] = $categories;
            $rssItems[$key]['views'] = $post->getViews();
        }
        $this->view->assign('rssItems', $rssItems);
    }

}

?>