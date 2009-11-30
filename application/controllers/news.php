<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 *
 * Handling news management
 */

class News_Controller extends Template_Controller {
    protected $restrict_guest = FALSE;
    
    /**
     * Menampilkan daftar seluruh news yang ada.
     * Untuk sementara di limit 50 news dulu
     * Nanti kalo udah dewa pake pagination
     */
    public function index() {
        $pagin = new Pagination (array(
            'base_url' => 'news/index/page/',
            'uri_segment' => 'page',
            'items_per_page' => $this->news_per_page,
            'style' => 'digg',
            'total_items' => ORM::factory('article')->orderby('created_date' , 'DESC')->count_all(),
            'auto_hide' => true
        ));
        $articles = ORM::factory('article')->where('status' , Article_Model::STATUS_PUBLISHED)->orderby('created_date' , 'DESC')->find_all($this->news_per_page, $pagin->sql_offset);
        $this->content->articles = $articles;
        $this->content->pagin = $pagin;
        $this->title = "Recent News";
    }

    /**
     * Melihat detail sebuah news
     * @param <type> $article_id
     */
    public function view($article_id) {
        $article = ORM::factory('article' , $article_id);
        if (!$article->loaded || ($article->status != Article_Model::STATUS_PUBLISHED && !$this->auth_user->has_role('administrator')))
            $this->redirect(url::site('news') , "Failed" , "There is no such article");
        else {
            $this->title = "News : " . substr($article->title , 0 , 100);
            $this->content->prev_article = (!$this->auth_user->has_role('administrator')) ? ORM::factory('article')->where('id <' , $article_id)->where('status' , Article_Model::STATUS_PUBLISHED)->orderby('id' , 'DESC')->limit(1)->find()
            : ORM::factory('article')->where('id <' , $article_id)->orderby('id' , 'DESC')->limit(1)->find();
            $this->content->next_article = (!$this->auth_user->has_role('administrator')) ? ORM::factory('article')->where('id >' , $article_id)->where('status' , Article_Model::STATUS_PUBLISHED)->orderby('id' , 'ASC')->limit(1)->find()
            : ORM::factory('article')->where('id >' , $article_id)->orderby('id' , 'ASC')->limit(1)->find();
            $this->content->article = $article;
            $this->content->auth_user = $this->auth_user;
        }
    }
}
