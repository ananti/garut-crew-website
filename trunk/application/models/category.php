<?php defined('SYSPATH') OR die('No direct access allowed.');


/**
 *
 *
 */
class Category_Model extends ORM {
    protected $has_many = array('products' , 'designs');

    /**
     * Mengecek apakah sebuah category_name terdapat di dalam database
     * @param <type> $category_name 
     */

    public static function IsCategoryExist($category_name) {
        $categories = ORM::factory('category')->find_all();
        $retval = false;
        foreach ($categories as $category)
            if (strtolower($category_name) == strtolower($category->name))
                $retval = true;
        return $retval;
    }
}
