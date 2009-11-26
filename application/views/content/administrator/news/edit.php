<div id="edit_article" class="main">
    <h1 class="title">Edit Article</h1>
    <div class="links">
        <ul>
            <li><a href="javascript:history.go(-1)">Back</a></li>
            <li><?=html::anchor(url::site('administrator/news'), 'List')?></li>
        </ul>
    </div>
    <div id='article_form'>
        <?=form::open(url::current(), array('name'=>'article', 'id' => 'article'))?>
        <h3>Title</h3>
        <?=form::input(array('name'=>'title', 'id'=>'title', 'class' => 'required') , $article->title)?>
        <h3>Status</h3>
        <?=form::radio('status', 'unpublished', $article->status == Article_Model::STATUS_UNPUBLISHED)?> Unpublished
        <?=form::radio('status', 'published', $article->status == Article_Model::STATUS_PUBLISHED)?> Published
        <h3>Content</h3>
        <?=form::textarea(array('name'=>'content', 'id'=>'content') , $article->content)?>
        <br/>
        <?=form::submit('submit', 'Save')?>
        <br/>
        <?=form::close()?>
        <br/>
    </div>
</div>