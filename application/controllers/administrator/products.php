<?php defined('SYSPATH') OR die('No direct access allowed.');

class Products_Controller extends Template_Controller {
    protected $restrict_outside_roles = array('administrator');

    public function index($category_id = 0) {
        if ($category_id == 0) {
            $pagin = new Pagination (array(
                'base_url' => 'administrator/products/index/0/page/',
                'uri_segment' => 'page',
                'items_per_page' => $this->items_per_page,
                'style' => 'digg',
                'total_items' => ORM::factory('product')->count_all(),
                'auto_hide' => true
            ));
            $products = ORM::factory('product')->find_all($this->items_per_page , $pagin->sql_offset);
        }
        else {
            $pagin = new Pagination (array(
                //'base_url' => 'administrator/products/index/page/',
                'uri_segment' => 'page',
                'items_per_page' => $this->items_per_page,
                'style' => 'digg',
                'total_items' => ORM::factory('product')->where('category_id' , $category_id)->count_all(),
                'auto_hide' => true
            ));
            $products = ORM::factory('product')->where('category_id' , $category_id)->find_all($this->items_per_page , $pagin->sql_offset);
        }

        $this->title = "Product List";
        $this->content->products = $products;
        $this->content->categories = ORM::factory('category')->find_all();
        $this->content->pagin = $pagin;
    }


    public function create() {
        if ($_POST) {
            $product = ORM::factory('product');
            $product->name = $_POST['name'];
            $product->category_id = $_POST['category_id'];
            $product->description = $_POST['description'];
            $product->price = $_POST['price'];

            $root = DOCROOT."public". DIRECTORY_SEPARATOR."files";
            if (isset($_FILES['picture_file']) && $_FILES['picture_file']['error'] == UPLOAD_ERR_OK) {
                $filepath = $root.DIRECTORY_SEPARATOR.basename($_FILES['picture_file']['name']);
                if (move_uploaded_file($_FILES['picture_file']['tmp_name'], $filepath)) {
                    $product->picture_file_path = $filepath;
                    $product->picture_file_url = Product_Model::GetPictureFileURL(basename($_FILES['picture_file']['name']));
                } else {
                    $this->redirect(request::referrer(), 'Upload failed','Upload failed');
                }
            }

            if (isset($_POST['delete_picture_file']) && $_POST['delete_picture_file'] == "Delete") {
                if (file_exists($product->picture_file_path)) unlink($product->picture_file_path);
                $product->picture_file_path = NULL;
                $product->picture_file_url = NULL;
            }

            $product->save();
            $this->redirect('administrator/products' , 'Success' , 'Product successfully saved');
        }
        else {
            $this->title = "Create Product";
            $this->content->categories = ORM::factory('category')->find_all();
        }
    }


    public function edit($product_id) {
        $product = ORM::factory('product' , $product_id);
        if ($product->loaded) {
            if ($_POST) {
                $product->name = $_POST['name'];
                $product->category_id = $_POST['category_id'];
                $product->description = $_POST['description'];
                $product->price = $_POST['price'];
                
                $root = DOCROOT."public". DIRECTORY_SEPARATOR."files";
                
                if (isset($_FILES['picture_file'])) {
                    $picture_file_path = array();
                    $picture_file_url = array();
                    $names = $_FILES['picture_file']['name'];
                    $types = $_FILES['picture_file']['type'];
                    $tmp_names = $_FILES['picture_file']['tmp_name'];
                    $errors = $_FILES['picture_file']['error'];
                    $sizes = $_FILES['picture_file']['size'];
                    foreach($names as $key => $name) {
                        if ($_FILES['picture_file']['error'][$key] == UPLOAD_ERR_OK) {
                            $filepath = $root.DIRECTORY_SEPARATOR.basename($_FILES['picture_file']['name'][$key]);
                            if (move_uploaded_file($_FILES['picture_file']['tmp_name'][$key], $filepath)) {
                                $product->picture_file_path = $filepath;
                                $product->picture_file_url = Product_Model::GetPictureFileURL(basename($_FILES['picture_file']['name'][$key]));
                                $picture_file_path[$key] = $filepath;
                                $picture_file_url[$key] = Product_Model::GetPictureFileURL(basename($_FILES['picture_file']['name'][$key]));;
                            } else {
                                $this->redirect(request::referrer(), 'Upload failed','Upload failed');
                            }
                        }
                    }
                    //echo json_encode($picture_file_path);
                }

                if (isset($_POST['delete_picture_file']) && $_POST['delete_picture_file'] == "Delete") {
                    //if (file_exists($product->picture_file_path)) unlink($product->picture_file_path);
                    $product->picture_file_path = NULL;
                    $product->picture_file_url = NULL;
                }

                $product->save();
                $this->redirect('administrator/products' , 'Success' , 'Product successfully saved');
            }
            else {
                $this->title = "Edit Product Detail";
                $this->content->product = $product;
                $this->content->categories = ORM::factory('category')->find_all();
            }
        }
        else {
            $this->redirect('administrator/products' , 'Failed' , 'There is no such product');
        }
    }

    public function delete($product_id) {
        $product = ORM::factory('product' , $product_id);
        if ($product->loaded) {
            $product->delete();
            $this->redirect('administrator/products' , 'Success' , 'Product successfully deleted');
        }
        else {
            $this->redirect('administrator/products' , 'Failed' , 'There is no such product');
        }
    }
}
