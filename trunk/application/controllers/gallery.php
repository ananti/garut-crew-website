<?php defined('SYSPATH') OR die('No direct access allowed.');

class Gallery_Controller extends Template_Controller {
    protected $restrict_guest = FALSE;
    protected $thumbnails_per_page = 4;

    public function view($product_id) {
        $product = ORM::factory('product' , $product_id);
        if ($product->loaded) {
            $pagin = new Pagination (array(
                'uri_segment' => 'page',
                'items_per_page' => $this->thumbnails_per_page,
                'style' => 'digg',
                'total_items' => $product->CountPictureFile(),
                'auto_hide' => true
            ));

            $this->title = $product->name . " gallery";
            $this->content->product = $product;
            $this->content->pagin = $pagin;
            $this->content->picture_offset = $pagin->sql_offset + 1;
            $this->head->picture_offset = $pagin->sql_offset + 1;
            $this->content->picture_count = $this->thumbnails_per_page;
        }
        else {
            $this->redirect(request::referrer() , 'Failed' , "There is no such product");
        }
    }
}