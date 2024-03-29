<?
    //print_r($articles);
    foreach($articles as $article) {
        //echo $article->id;
    }
?>

<?if ($lang == Controller::LANG_EN) : ?>
    <div id="news_list" class="main">
        <div id="news">
            <?if (!$articles || empty($articles) || count($articles) < 1):?>
                There is no news right now
            <?else :?>
                <?foreach ($articles as $article) :?>
                <div class="post">
                    <h1 class="title"><?=html::anchor('news/view/'.$article->id, $article->title_en)?></h1>
                    <h2 class="subtitle">Written by <?=isset($article->user_id)?(ORM::factory('user', $article->user_id)->first_name ." ". ORM::factory('user', $article->user_id)->last_name):''?> on <?=$article->created_date?></h2>
                    <div class="content">
                        <?=isset($article->content)?substr(strip_tags($article->content_en), 0, 300):''?>
                    </div>
                    <div class="links">
                        <ul>
                            <li><?=html::anchor('news/view/'.$article->id, 'Read more')?></li>
                        </ul>
                    </div>
                </div>
                <?endforeach;?>
            <?endif;?>
        </div>
        <?=$pagin->render();?>
    </div>
<?else:?>
<div id="news_list" class="main">
        <div id="news">
            <?if (!$articles || empty($articles) || count($articles) < 1):?>
                Tidak ada berita saat ini
            <?else :?>
                <?foreach ($articles as $article) :?>
                <div class="post">
                    <h1 class="title"><?=html::anchor('news/view/'.$article->id, $article->title)?></h1>
                    <h2 class="subtitle">Ditulis oleh <?=isset($article->user_id)?(ORM::factory('user', $article->user_id)->first_name ." ". ORM::factory('user', $article->user_id)->last_name):''?> pada <?=$article->created_date?></h2>
                    <div class="content">
                        <?=isset($article->content)?substr(strip_tags($article->content), 0, 300):''?>
                    </div>
                    <div class="links">
                        <ul>
                            <li><?=html::anchor('news/view/'.$article->id, 'Baca Lebih Lengkap')?></li>
                        </ul>
                    </div>
                </div>
                <?endforeach;?>
            <?endif;?>
        </div>
        <?=$pagin->render();?>
    </div>
<?endif;?>