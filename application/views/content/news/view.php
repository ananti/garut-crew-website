<div id="news_detail" class="main">
    <h1 class="title"><?=$article->title?></h1>
    <div class="links" style="clear:both">
        <ul>
            <li><a href="javascript:history.go(-1)">Back</a></li>
            <li><?if ($auth_user && $auth_user->has_role('administrator')) echo html::anchor(url::site('administrator/news/edit/' . $article->id) , "Edit");?></li>
        </ul>
    </div>
    <br />
    <div class="content">
        <?=$article->content?>
    </div>
</div>
