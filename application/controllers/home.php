<?php defined('SYSPATH') OR die('No direct access allowed.');


class Home_Controller extends Template_Controller {
    public $template = 'two_column';
    protected $restrict_guest = FALSE;

    /**
     * Menampilkan index
     */
    public function index()
    {
        $this->title = "Home";
        $this->content->new_product = ORM::factory('product')->orderby('id' , 'DESC')->limit(1)->find();
        $this->content->new_design = ORM::factory('design')->orderby('id' , 'DESC')->limit(1)->find();
        $this->content->most_wanted_product = ORM::factory('product')->orderby('rating' , 'DESC')->limit(1)->find();
        $this->content->most_wanted_design = ORM::factory('design')->orderby('rating' , 'DESC')->limit(1)->find();
        $this->content->latest_news = ORM::factory('article')->orderby('created_date' , 'DESC')->where('status' , Article_Model::STATUS_PUBLISHED)->limit(1)->find();
    }

}
//end of file