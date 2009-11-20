<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Allows a template to be automatically loaded and displayed. Display can be
 * dynamically turned off in the controller methods, and the template file
 * can be overloaded.
 *
 * To use it, declare your controller to extend this class:
 * `class Your_Controller extends Template_Controller`
 *
 * $Id: template.php 4134 2009-03-28 04:37:54Z zombor $
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
abstract class Template_Controller extends Controller {
    // Template view name
    public $template = 'two_column';
    public $head = '';
    public $content = '';
    public $title = '';

    //
    public $scripts = array();
    public $styles = array();

    //
    //public $head = NULL;
    //public $content = NULL;

    // Default to do auto-rendering
    public $auto_render = TRUE;
	public $need_template = true;
    /**
     * Template loading and setup routine.
     */
    public function __construct()
    {
        parent::__construct();

        //Load the template
        //if (!$this->is_login)
            //$this->template = 'one_column';
			
        if ($this->need_template) {
            $this->template = new View($this->template);

            //Getting segments
            $tsegments = array_diff(Router::$rsegments, Router::$arguments);
            if ($tsegments[count($tsegments) - 1] != Router::$method) $tsegments[] = Router::$method;
            $path = implode('/', $tsegments);

            $headpath = "head/".$path;
            $contentpath = "content/".$path;
            try
            {
                    $this->head = View::factory($headpath);
            }
            catch (Exception $ex)
            {
                    $this->head = View::factory('null');
            }
            try
            {
                    $this->content = View::factory($contentpath);
            }
            catch (Exception $ex)
            {
                    $this->content = View::factory('null');
            }
            if ($this->auto_render == TRUE)
            {
                    // Render the template immediately after the controller method
                    Event::add('system.post_controller', array($this, '_render'));
            }
        }
    }

    /**
     * Render the loaded template.
     */
    public function _render()
    {
        if ($this->auto_render == TRUE)
        {
            //
            $this->template->scripts = $this->scripts;
            $this->template->styles = $this->styles;
            //$this->template->head = $this->head;
            //$this->template->content = $this->content;

            // Render the template when the class is destroyed
            $this->template->head = $this->head;
            $this->template->content = $this->content->render();
            $this->template->title = $this->title;
            $this->template->render(TRUE);
        }
    }

    /**
     * Set template
     * @param string $template
     */
    public function set_template($template = NULL)
    {
        if ($template)
        $this->template = $template;
        $this->template = new View($this->template);
        if ($this->auto_render == TRUE)
        {
            Event::add('system.post_controller', array($this, '_render'));
        }
    }

    /**
     * Add script
     * @param string $script
     */
    public function add_script($script)
    {
        if (is_array($script))
        {
            foreach ($script as $s)
            {
                $this->scripts[] = $s;
            }
        }
        else
        {
            $this->scripts[] = $script;
        }
    }

    /**
     * Add style
     * @param string $style
     */
    public function add_style($style)
    {
        if (is_array($style))
        {
            foreach ($style as $s)
            {
                $this->styles[] = $s;
            }
        }
        else
        {
            $this->styles[] = $style;
        }
    }

} // End Template_Controller