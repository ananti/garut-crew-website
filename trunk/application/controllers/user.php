<?php defined('SYSPATH') OR die('No direct access allowed.');

class User_Controller extends Template_Controller {
    protected $restrict_guest = false;

    public function view($user_id) {
        $user = ORM::factory('user' , $user_id);
        if ($user->loaded) {
            $this->title = "User Detail";
            $this->content->user = $user;
            $this->content->designs = ORM::factory('design')->where('user_id' , $user_id)->find_all();
            $this->content->auth_user = $this->auth_user;
        }
        else {
            $this->redirect(url::base() . request::referrer() , 'Not found' , 'There is no such user');
        }
    }
}