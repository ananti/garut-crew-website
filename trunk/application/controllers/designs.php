<?php defined('SYSPATH') OR die('No direct access allowed.');

class Designs_Controller extends Template_Controller {
    protected $restrict_guest = FALSE;

    public function index($category_id = 0) {
        if ($category_id == 0) {
            $pagin = new Pagination (array(
                'base_url' => 'designs/index/0/page/',
                'uri_segment' => 'page',
                'items_per_page' => $this->items_per_page,
                'style' => 'digg',
                'total_items' => ORM::factory('design')->count_all(),
                'auto_hide' => true
            ));
            $designs = ORM::factory('design')->orderby('id' , 'DESC')->find_all($this->items_per_page , $pagin->sql_offset);
        }
        else {
            $pagin = new Pagination (array(
                'uri_segment' => 'page',
                'items_per_page' => $this->items_per_page,
                'style' => 'digg',
                'total_items' => ORM::factory('design')->where('category_id' , $category_id)->count_all(),
                'auto_hide' => true
            ));
            $designs = ORM::factory('design')->orderby('id' , 'DESC')->where('category_id' , $category_id)->find_all($this->items_per_page , $pagin->sql_offset);
        }

        $this->title = "Design List";
        $this->content->designs = $designs;
        $this->content->categories = ORM::factory('category')->find_all();
        $this->content->pagin = $pagin;
    }


    public function view($design_id) {
        $design = ORM::factory('design' , $design_id);
        if ($design->loaded) {
            if ($_POST) {
                if (isset($_POST['submit']) && $_POST['submit'] == 'Rate') {
                    $rate_count = $design->rate_count;
                    $design->rating = ($design->rating * $rate_count + $_POST['rate']) / ($rate_count + 1);
                    $rate_count++;
                    $design->rate_count = $rate_count;
                    $design->save();
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
                    $comment->design_id = $design_id;
                    $comment->save();
                    $this->redirect(url::current() , "Success" , "Comment submitted");
                }
            }
            else {
                $pagin = new Pagination (array(
                    'uri_segment' => 'comment',
                    'items_per_page' => $this->comments_per_page,
                    'style' => 'digg',
                    'total_items' => ORM::factory('comment')->where('design_id' , $design_id)->count_all(),
                    'auto_hide' => true
                ));
                $this->title = $design->name . " Details";
                $this->content->design = $design;
                $this->content->prev_product = ORM::factory('design')->where('id < ' , $design_id)->orderby('id' , 'DESC')->limit(1)->find();
                $this->content->next_product = ORM::factory('design')->where('id > ' , $design_id)->orderby('id' , 'ASC')->limit(1)->find();
                $this->content->comments = ORM::factory('comment')->where('design_id' , $design_id)->orderby('submit_date' , 'DESC')->find_all($this->comments_per_page , $pagin->sql_offset);
                $this->content->pagin = $pagin;
            }
        }
        else {
            $this->redirect('products' , "Failed" , "There is no such product");
        }
    }
}