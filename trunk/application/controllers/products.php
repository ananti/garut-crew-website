<?php defined('SYSPATH') OR die('No direct access allowed.');

class Products_Controller extends Template_Controller {
    protected $restrict_guest = false;

    public function index($category_id = 0) {
        if ($category_id == 0) {
            $pagin = new Pagination (array(
                'base_url' => 'products/index/0/page/',
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

    public function view($product_id) {
        $product = ORM::factory('product' , $product_id);
        if ($product->loaded) {
            if ($_POST) {
                if (isset($_POST['submit']) && $_POST['submit'] == 'Rate') {
                    $rate_count = $product->rate_count;
                    $product->rating = ($product->rating * $rate_count + $_POST['rate']) / ($rate_count + 1);
                    $rate_count++;
                    $product->rate_count = $rate_count;
                    $product->save();
                    $this->redirect(url::current() , "Success" , "Rating submitted");
                }
                else if (isset($_POST['submit']) && $_POST['submit'] == 'Comment') {
                    $comment = ORM::factory('comment');
                    if (isset($_POST['name']) && isset($_POST['email'])) {
                        $comment->commentator = $_POST['name'];
                        $comment->commentator_email = $_POST['email'];
                    }
                    else {
                        $comment->user_id = $this->auth_user->id;
                    }
                    $comment->content = $_POST['content'];
                    $comment->product_id = $product_id;
                    $comment->save();
                    $this->redirect(url::current() , "Success" , "Comment submitted");
                }
            }
            else {
                $pagin = new Pagination (array(
                    'uri_segment' => 'comment',
                    'items_per_page' => $this->comments_per_page,
                    'style' => 'digg',
                    'total_items' => ORM::factory('comment')->where('product_id' , $product_id)->count_all(),
                    'auto_hide' => true
                ));
                $this->title = $product->name . " Details";
                $this->content->product = $product;
                $this->content->comments = ORM::factory('comment')->where('product_id' , $product_id)->orderby('submit_date' , 'DESC')->find_all($this->comments_per_page , $pagin->sql_offset);
                $this->content->pagin = $pagin;
            }
        }
        else {
            $this->redirect('products' , "Failed" , "There is no such product");
        }
    }
}
