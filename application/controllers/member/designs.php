<?php defined('SYSPATH') OR die('No direct access allowed.');

class Designs_Controller extends Template_Controller {
    protected $restrict_outside_roles = array('member');


    public function index($category_id = 0) {
        if ($category_id == 0) {
            $pagin = new Pagination (array(
                'base_url' => 'member/designs/index/0/page/',
                'uri_segment' => 'page',
                'items_per_page' => $this->items_per_page,
                'style' => 'digg',
                'total_items' => ORM::factory('design')->count_all(),
                'auto_hide' => true
            ));
            $designs = ORM::factory('design')->where('user_id' , $this->auth_user->id)->find_all($this->items_per_page , $pagin->sql_offset);
        }
        else {
            $pagin = new Pagination (array(
                //'base_url' => 'administrator/designs/index/page/',
                'uri_segment' => 'page',
                'items_per_page' => $this->items_per_page,
                'style' => 'digg',
                'total_items' => ORM::factory('design')->where('category_id' , $category_id)->count_all(),
                'auto_hide' => true
            ));
            $designs = ORM::factory('design')->where('user_id' , $this->auth_user->id)->where('category_id' , $category_id)->find_all($this->items_per_page , $pagin->sql_offset);
        }

        $this->title = "Design List";
        $this->content->designs = $designs;
        $this->content->categories = ORM::factory('category')->find_all();
        $this->content->pagin = $pagin;
    }

    public function edit($design_id) {
        $design = ORM::factory('design' , $design_id);
        if ($design->loaded) {
            if ($design->user_id == $this->auth_user->id) {
                if ($_POST) {
                    $design->name = $_POST['name'];
                    $design->category_id = $_POST['category_id'];
                    $design->description = $_POST['description'];
                    $design->price = $_POST['price'];

                    $root = DOCROOT."public". DIRECTORY_SEPARATOR."files";

                    $picture_file_path = json_decode($design->picture_file_path , TRUE);
                    $picture_file_url = json_decode($design->picture_file_url , TRUE);

                    if (isset($_FILES['picture_file'])) {
                        $names = $_FILES['picture_file']['name'];
                        $types = $_FILES['picture_file']['type'];
                        $tmp_names = $_FILES['picture_file']['tmp_name'];
                        $errors = $_FILES['picture_file']['error'];
                        $sizes = $_FILES['picture_file']['size'];
                        foreach($names as $key => $name) {
                            if ($_FILES['picture_file']['error'][$key] == UPLOAD_ERR_OK) {
                                $filepath = $root.DIRECTORY_SEPARATOR.basename($_FILES['picture_file']['name'][$key]);
                                if (move_uploaded_file($_FILES['picture_file']['tmp_name'][$key], $filepath)) {
                                    $picture_file_path[$key] = $filepath;
                                    $picture_file_url[$key] = design_Model::GetPictureFileURL(basename($_FILES['picture_file']['name'][$key]));;
                                } else {
                                    $this->redirect(request::referrer(), 'Upload failed','Upload failed');
                                }
                            }
                        }
                    }

                    if (isset($_POST['delete_picture_file'])) {
                        foreach($_POST['delete_picture_file'] as $key => $delete) {
                            if ($delete == 'Delete') {
                                unset($picture_file_path[$key]);
                                unset($picture_file_url[$key]);
                            }
                        }
                    }

                    $design->picture_file_path = (count($picture_file_path) > 0) ? json_encode($picture_file_path) : NULL;
                    $design->picture_file_url = (count($picture_file_url) > 0) ? json_encode($picture_file_url) : NULL;
                    $design->save();
                    $this->redirect('member/designs' , 'Success' , 'Design successfully saved');
                }
                else {
                    $this->title = "Edit design Detail";
                    $this->content->design = $design;
                    $this->content->categories = ORM::factory('category')->find_all();
                }
            }
            else {
                $this->redirect('member/designs' , 'Failed' , 'You are not authorized to edit this design');
            }
        }
        else {
            $this->redirect('member/designs' , 'Failed' , 'There is no such design');
        }
    }

    public function create() {
        if ($_POST) {
            $design = ORM::factory('design');
            $design->name = $_POST['name'];
            $design->category_id = $_POST['category_id'];
            $design->description = $_POST['description'];
            $design->price = $_POST['price'];
            $design->user_id = $this->auth_user->id;

            $root = DOCROOT."public". DIRECTORY_SEPARATOR."files";

            $picture_file_path = array();
            $picture_file_url = array();

            if (isset($_FILES['picture_file'])) {
                $names = $_FILES['picture_file']['name'];
                $types = $_FILES['picture_file']['type'];
                $tmp_names = $_FILES['picture_file']['tmp_name'];
                $errors = $_FILES['picture_file']['error'];
                $sizes = $_FILES['picture_file']['size'];
                foreach($names as $key => $name) {
                    if ($_FILES['picture_file']['error'][$key] == UPLOAD_ERR_OK) {
                        $filepath = $root.DIRECTORY_SEPARATOR.basename($_FILES['picture_file']['name'][$key]);
                        if (move_uploaded_file($_FILES['picture_file']['tmp_name'][$key], $filepath)) {
                            $picture_file_path[$key] = $filepath;
                            $picture_file_url[$key] = design_Model::GetPictureFileURL(basename($_FILES['picture_file']['name'][$key]));;
                        } else {
                            $this->redirect(request::referrer(), 'Upload failed','Upload failed');
                        }
                    }
                }
            }

            $design->picture_file_path = (count($picture_file_path) > 0) ? json_encode($picture_file_path) : NULL;
            $design->picture_file_url = (count($picture_file_url) > 0) ? json_encode($picture_file_url) : NULL;
            $design->save();
            $this->redirect('member/designs' , 'Success' , 'Design successfully saved');
        }
        else {
            $this->title = "Create design";
            $this->content->categories = ORM::factory('category')->find_all();
        }
    }

    public function delete($design_id) {
        $design = ORM::factory('design' , $design_id);
        if ($design->loaded) {
            if ($design->user_id == $this->auth_user->id) {
                $design->delete();
                $this->redirect('member/designs' , 'Success' , 'Design successfully deleted');
            }
            else {
                $this->redirect('member/designs' , 'Failed' , 'You are not authorized to delete this design');
            }
        }
        else {
            $this->redirect('member/designs' , 'Failed' , 'There is no such design');
        }
    }
}