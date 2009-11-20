<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Menangani login
 * @author petra.barus
 */
class Home_Controller extends Template_Controller {
    public $template = 'two_column';
    protected $restrict_guest = FALSE;

    /**
     * Menampilkan index
     */
    public function index()
    {
        $this->title = "Home";
        $this->content->body = "<strong>Hello world</strong>";
        $this->head->head = "tests";
    }

}
//end of file