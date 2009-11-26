<?php defined('SYSPATH') OR die('No direct access allowed.');


/**
 * 
 *
 */
class Article_Model extends ORM {
    protected $belongs_to = array('users');

    const STATUS_PUBLISHED = 0;
    const STATUS_UNPUBLISHED = 1;
}
