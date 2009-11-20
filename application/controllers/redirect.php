<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Menangani redirect
 * @author petra.barus
 */
class Redirect_Controller extends Template_Controller {
	public $template = 'one_column';
    protected $restrict_guest = FALSE;
	
	/**
     * Menampilkan index 
     */
	public function index()
	{
		//Redirecting
		$time = 1;
        //NOTE: pakai method get karena sudah set_flash
		$url = Session::instance()->get('redirect_url');
		$title = Session::instance()->get('redirect_title');
		$message = Session::instance()->get('redirect_message');
        $time = Session::instance()->get('redirect_time');
        $time = ($time == NULL)? 1 : $time;
		if ($url == '') url::redirect('home'); //kalau tidak dari halaman lain
		$this->content->message = $message;
        $this->content->title = $title;
		$this->head = "<meta http-equiv=\"refresh\" content=\"$time;url=$url\" />";
		$this->title = $title;
	}
}
//end of file
