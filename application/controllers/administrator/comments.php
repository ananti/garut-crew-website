<?php defined('SYSPATH') OR die('No direct access allowed.');

class Comments_Controller extends Template_Controller {
    protected $restrict_outside_roles = array('administrator');

    public function delete($comment_id) {
        $comment = ORM::factory('comment' , $comment_id);
        if ($comment->loaded) {
            $comment->delete();
            $this->redirect(url::base() . request::referrer() , "Success" , "Comment deleted");
        }
        else {
            $this->redirect(url::base() . request::referrer() , "Failed" , "There is no such comment");
        }
    }
}