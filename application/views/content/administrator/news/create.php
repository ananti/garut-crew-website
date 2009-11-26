<div id="create_article" class="main">
    <h1 class="title">Create Article</h1>
    <div class="links">
        <ul>
            <li><?=html::anchor(url::site('administrator/news/create'), 'Create')?></li>
            <li><?=html::anchor(url::site('administrator/news'), 'List')?></li>
        </ul>
    </div>
    <div id='article_form'>
        <?=form::open(url::current(), array('name'=>'article', 'id' => 'article'))?>
        <h3>Title</h3>
        <?=form::input(array('name'=>'title', 'id'=>'title', 'class' => 'required'))?>
        <h3>Status</h3>
        <?=form::radio('visibility', 'unpublished', TRUE)?> Unpublished
        <?=form::radio('visibility', 'published')?> Published
        <h3>Content</h3>
        <?=form::textarea(array('name'=>'content', 'id'=>'content'))?>
        <br/>
        <?=form::submit('submit', 'Create')?>
        <br/>
        <?=form::close()?>
        <br/>
    </div>
</div>