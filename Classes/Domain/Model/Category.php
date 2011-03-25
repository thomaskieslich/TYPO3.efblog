<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Kieslich <thomaskieslich@gmx.net>
 *  	
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Category
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Tkblog_Domain_Model_Category extends Tx_Extbase_DomainObject_AbstractEntity {

    /**
     * title
     *
     * @var string $title
     * @validate NotEmpty
     */
    protected $title;
    /**
     * category description
     *
     * @var string $description
     */
    protected $description;
    /**
     * category image
     *
     * @var string $image
     */
    protected $image;
    /**
     * parentCategory
     *
     * @var Tx_Tkblog_Domain_Model_Category $parentCategory
     */
    protected $parentCategory;
    /**
     * children
     *
     * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Tkblog_Domain_Model_Category> $children
     */
    protected $children;
    /**
     * posts
     *
     * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Tkblog_Domain_Model_Post> $posts
     */
    protected $posts;

    /**
     * The constructor of this Category
     *
     * @return void
     */
    public function __construct () {
        $this->children = new Tx_Extbase_Persistence_ObjectStorage();
        $this->posts = new Tx_Extbase_Persistence_ObjectStorage();
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle () {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle ($title) {
        $this->title = $title;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription () {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription ($description) {
        $this->description = $description;
    }

    /**
     * category image
     * @return string $image 
     */
    public function getImage () {
        return $this->image;
    }

    /**
     * set image
     * @param string $image 
     */
    public function setImage ($image) {
        $this->image = $image;
    }

    /**
     * Returns the parentCategory
     *
     * @return Tx_Tkblog_Domain_Model_Category $parentCategory
     */
    public function getParentCategory () {
        return $this->parentCategory;
    }

    /**
     * Sets the parentCategory
     *
     * @param Tx_Tkblog_Domain_Model_Category $parentCategory
     * @return void
     */
    public function setParentCategory ($parentCategory) {
        $this->parentCategory = $parentCategory;
    }

    /**
     * Returns the child categories
     *
     * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Tkblog_Domain_Model_Category> $children
     */
    public function getChildren () {
        $categoryRepository = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager')->get('Tx_Tkblog_Domain_Repository_CategoryRepository');
        $children = $categoryRepository->findAllChildren($this);
        return clone $children;
    }

    /**
     * Returns post in categories
     *
     * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Tkblog_Domain_Model_Post > $posts
     */
    public function getPosts () {        
        $postRepository = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager')->get('Tx_Tkblog_Domain_Repository_PostRepository');
        $posts = (int)$postRepository->countCategoryPosts($this);
        return $posts;
    }

}

?>