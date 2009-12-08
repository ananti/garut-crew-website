<?php defined('SYSPATH') OR die('No direct access allowed.');

class About_Controller extends Template_Controller {
    protected $restrict_guest = false;
    protected $thumbnails_per_page = 4;

    public function index() {
        $this->title = "About Garut Crew";
    }


    public function gallery() {
        $this->title = "Garut Crew Gallery";
        $path = DOCROOT . Kohana::config('core.gallery_picture_path');
        $path = opendir($path);
        $files = array();
        $count = 0;
        while (($file = readdir($path)) !== false) {
            $url = url::base() . Kohana::config('core.gallery_picture_path') . $file;
            if (!is_dir($file)) {
                $count++;
                $files[$count] = $url;
            }
        }

        $pagin = new Pagination (array(
                'uri_segment' => 'page',
                'items_per_page' => $this->thumbnails_per_page,
                'style' => 'digg',
                'total_items' => $count,
                'auto_hide' => true
            ));
        
        $this->content->files = $files;
        $this->content->pagin = $pagin;
        $this->head->file_offset = $pagin->sql_offset + 1;
        $this->content->file_offset = $pagin->sql_offset + 1;
        $this->content->file_count = $this->thumbnails_per_page;
    }
}
