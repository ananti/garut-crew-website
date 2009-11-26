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

    /**
     * Membuat article baru
     * 
     */

    public function create() {
        if ($_POST) {
            $article = ORM::factory('article');
            $article->title = $_POST['title'];
            $article->user_id = $this->auth_user->id;
            $article->content = $_POST['content'];
            $article->status = ($_POST['status'] == 'unpublished')? Article_Model::STATUS_UNPUBLISHED : Article_Model::STATUS_PUBLISHED;
            $article->save();
            $this->redirect(url::site('administrator/news/edit/'.$article->id), 'Success', 'Article successfully created');
        }
        else {
            $this->title = "Create New Article";
        }
    }

    /**
     * Mengedit sebuah article
     * @param <type> $article_id
     */
    public function edit($article_id) {
        if ($_POST) {
            $article = ORM::factory('article' , $article_id);
            $article->title = $_POST['title'];
            $article->user_id = $this->auth_user->id;
            $article->status = ($_POST['status'] == 'unpublished')? Article_Model::STATUS_UNPUBLISHED : Article_Model::STATUS_PUBLISHED;
            $article->content = $_POST['content'];
            $article->save();
            $this->redirect(url::site('administrator/news/edit/'.$article->id), 'Success', 'Article successfully saved');
        }
        else {
            $article = ORM::factory('article' , $article_id);
            if ($article->loaded) {
                $this->content->article = $article;
                $this->title = "Edit Article";
            }
        }
    }
}
