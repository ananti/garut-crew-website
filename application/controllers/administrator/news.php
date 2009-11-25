<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 * Handling news management
 */

class News_Controller extends Template_Controller {
    protected $restrict_outside_roles = array('administrator');

    /**
     * Menampilkan daftar seluruh news yang ada.
     * Untuk sementara di limit 50 news dulu
     * Nanti kalo udah dewa pake pagination
     */
    public function index() {
        $pagin = new Pagination (array(
            'base_url' => 'administrator/news/index/page/',
            'uri_segment' => 'page',
            'items_per_page' => $this->items_per_page,
            'style' => 'digg',
            'total_items' => ORM::factory('article')->orderby('created_date' , 'DESC')->count_all(),
            'auto_hide' => true
        ));
        $articles = ORM::factory('article')->orderby('created_date' , 'DESC')->find_all($this->items_per_page, $pagin->sql_offset);
        $this->content->articles = $articles;
        $this->content->pagin = $pagin;
        $this->title = "News List";
    }


    /**
     * Mendelete sekumpulan article
     * @param array of article / article $article_id => bisa array ataupun single-int
     */
    public function delete($article_id) {
        $article = ORM::factory('article' , $article_id);
        if (!$article->loaded) {
            $this->redirect(url::site('administrator/news') , "Not found" , "There is no such article");
        }
        else {
            $article->delete();
            $this->redirect(url::site('administrator/news') , "Success" , "Article has been successfully deleted");
        }
    }
}
