<?php defined('SYSPATH') OR die('No direct access allowed.');

class Register_Controller extends Template_Controller {
    public $template = 'two_column';
    //protected $restrict_roles = array('member' , 'administrator');
    protected $restrict_guest = FALSE;


    public function index()
    {
        $this->content->captcha = Captcha::factory();
        $this->title = "Registration";
    }
    

}