<?php defined('SYSPATH') OR die('No direct access allowed.');

class Product_Model extends ORM {
    protected $belongs_to = array('categories');

    public function GetPictureFileURL($picture_file_name) {
        return 'http://' . Kohana::config('config.site_domain') . 'public/files/' . $picture_file_name;
    }

    public function GetThumbnailFileURL($thumbnail_file_name) {
        return 'http://' . Kohana::config('config.site_domain') . 'public/files/' . $thumbnail_file_name;
    }
}
