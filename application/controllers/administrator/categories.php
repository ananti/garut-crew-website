<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Products category and design category
 *
 * 
 */

class Categories_Controller extends Template_Controller {
    protected $restrict_outside_role = array('administrator');

    public function index() {
        if ($_POST) {
            if (!Category_Model::IsCategoryExist($_POST['name']) && strlen($_POST['name']) > 0) {
                $category = ORM::factory('category');
                $category->name = $_POST['name'];
                $category->save();
                $this->redirect('administrator/categories' , "Success" , "Category is successfully added");
            }
            else if (strlen($_POST['name']) == 0) {
                $this->redirect('administrator/categories' , "Failed" , "Empty category name");
            }
            else if (Category_Model::IsCategoryExist($_POST['name'])) {
                $this->redirect('administrator/categories' , "Failed" , "Category name already exists");
            }
        }
        else {
            $this->title = "Category List";
            $this->content->categories = ORM::factory('category')->find_all();
        }
    }


    public function delete($category_id) {
        $category = ORM::factory('category' , $category_id);
        if ($category->loaded) {
            $category->delete();
            $this->redirect('administrator/categories' , "Success" , "Category is successfully deleted");
        }
    }
    
}