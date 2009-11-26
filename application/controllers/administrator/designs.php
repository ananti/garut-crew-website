<?php defined('SYSPATH') OR die('No direct access allowed.');

class Designs_Controller extends Template_Controller {
    protected $restrict_outside_roles = array('administrator');


    public function index($category_id = NULL) {
        $pagin = new Pagination (array(
            'base_url' => 'administrator/designs/index/page/',
            'uri_segment' => 'page',
            'items_per_page' => $this->items_per_page,
            'style' => 'digg',
            'total_items' => ORM::factory('design')->count_all(),
            'auto_hide' => true
        ));
        if (is_null($category_id))
            $designs = ORM::factory('design')->find_all($this->items_per_page , $pagin->sql_offset);
        else
            $designs = ORM::factory('design')->where('category_id' , $category_id)->find_all($this->items_per_page , $pagin->sql_offset);
        $this->title = "Design List";
        $this->content->designs = $designs;
        $this->content->categories = ORM::factory('category')->find_all();
        $this->content->pagin = $pagin;
    }

    public function edit($design_id) {
        $design = ORM::factory('design' , $design_id);
        if ($_POST) {
            if ($design->loaded) {
                $design->name = $_POST['name'];
                $design->category_id = $_POST['category_id'];
                $design->user_id = $this->auth_user->id;
                $design->description = $_POST['description'];
                $design->price = $_POST['price'];

                $root = DOCROOT."public". DIRECTORY_SEPARATOR."files";
                if (isset($_FILES['picture_file']) && $_FILES['picture_file']['error'] == UPLOAD_ERR_OK) {
                    $filepath = $root.DIRECTORY_SEPARATOR.basename($_FILES['picture_file']['name']);
                    if (move_uploaded_file($_FILES['picture_file']['tmp_name'], $filepath)) {
                        $design->picture_file_path = $filepath;
                        $design->picture_file_url = $design->GetPictureFileURL(basename($_FILES['picture_file']['name']));
                    } else {
                        $this->redirect(request::referrer(), 'Upload failed','Upload failed');
                    }
                }

                if (isset($_POST['delete_picture_file']) && $_POST['delete_picture_file'] == "Delete") {
                    if (file_exists($design->picture_file_path)) unlink($design->picture_file_path);
                    $design->picture_file_path = NULL;
                    $design->picture_file_url = NULL;
                }

                $design->save();
                $this->redirect('administrator/designs' , 'Success' , 'Design successfully saved');
            }
        }
        else {
            if ($design->loaded) {
                $this->title = "Edit Design Detail";
                $this->content->design = $design;
                $this->content->categories = ORM::factory('category')->find_all();
            }
        }
    }

    public function delete($design_id) {
        $design = ORM::factory('design' , $design_id);
        if ($design->loaded) {
            $design->delete();
            $this->redirect('administrator/designs' , 'Success' , 'Design successfully deleted');
        }
    }
}