<?php defined('SYSPATH') OR die('No direct access allowed.');

class Product_Model extends ORM {
    protected $belongs_to = array('categories');

    public static function GetPictureFileURL($picture_file_name) {
        return 'http://' . Kohana::config('config.site_domain') . 'public/files/' . $picture_file_name;
    }

    public static function GetThumbnailFileURL($thumbnail_file_name) {
        return 'http://' . Kohana::config('config.site_domain') . 'public/files/' . $thumbnail_file_name;
    }

    public function CountPictureFile() {
        $picturefiles = json_decode($this->picture_file_url , TRUE);
        return count($picturefiles);
    }

    public static function GetPictureFileURLList($picturefiles , $offset = 1 , $count = 100) {
        $retval = array();
        foreach($picturefiles as $key => $picturefile) {
            if ($key >= $offset && $key <= $offset + $count - 1)
                $retval[$key] = $picturefile;
        }
        return $retval;
    }
}
