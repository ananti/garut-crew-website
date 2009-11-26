<?php defined('SYSPATH') OR die('No direct access allowed.');


/**
 *
 *
 */
class Design_Model extends ORM {
    protected $belongs_to = array('categories' , 'users');

    public function GetPictureFileURL($picture_file_name) {
        return 'http://' . Kohana::config('config.site_domain') . 'public/files/' . $picture_file_name;
    }
}
