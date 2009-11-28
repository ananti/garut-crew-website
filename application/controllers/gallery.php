<?php defined('SYSPATH') OR die('No direct access allowed.');

class Gallery_Controller extends Template_Controller {
    protected $restrict_guest = FALSE;

    public function view($product_id) {
        $product = ORM::factory('product' , $product_id);
        if ($product->loaded) {
            $this->title = $product->name . " gallery";
            $this->content->product = $product;
        }
        else {
            $this->redirect(request::referrer() , 'Failed' , "There is no such product");
        }
    }
}