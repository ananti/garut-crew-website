<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 *
 * @author petra.barus.barus
 */
abstract class JSON_Controller extends Controller {
    // Template view name
    public $return = null;

    // Default to do auto-rendering
    public $auto_render = TRUE;

    /**
     * Template loading and setup routine.
     */
    public function __construct()
    {
        parent::__construct();
        $session_key = Kohana::config('auth.session_key');
        $this->auth_user = Session::instance()->get($session_key);
        $this->is_login = (isset($this->auth_user) && ($this->auth_user != NULL));
        if ($this->restrict_guest && !$this->is_login)
        {
            echo "\"invalid\"";
            exit;
        }

        // Load the template
        if ($this->auto_render == TRUE)
        {
            // Render the template immediately after the controller method
            Event::add('system.post_controller', array($this, '_render'));
        }
    }

    /**
     * Render the loaded template.
     */
    public function _render()
    {
        if ($this->auto_render == TRUE)
        {
            echo json_encode($this->return);
        }
    }

    /**
     *
     */
    protected function error_exit($false = null)
    {
        echo json_encode($false);
        exit;
    }
}
//end of file