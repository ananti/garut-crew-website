<?
    $ar_category = array();
    foreach ($categories as $category)
        $ar_category[$category->id] = $category->id . ". " . $category->name;
    $fileurl = json_decode($product->picture_file_url , TRUE);
?>
<div id="product_edit" class="main">
    <h1 class="title">Edit Product</h1>
    <div class="links">
        <ul>
            <li><a href="javascript:history.go(-1)">Back</a></li>
            <li><?=html::anchor('administrator/products' , 'List')?></li>
        </ul>
    </div>
    <br />
    <div id="article_form">
    <?=form::open(url::current() , array('name' => 'product_form' , 'id' => 'product_form' , 'enctype' => 'multipart/form-data'))?>
    <h2>Product Name</h2>
    <?=form::input(array('name' => 'name' , 'id' => 'title' , 'class' => 'required') , $product->name)?>
    <h2>Product Description</h2>
    <?=form::textarea(array('name' => 'description' , 'id' => 'content') , $product->description)?>
    <h2>Product Description in English</h2>
    <?=form::textarea(array('name' => 'description_en' , 'id' => 'content_en' , 'style' => 'height:300px;') , $product->description_en)?>
    <h2>Category</h2>
    <?=form::dropdown('category_id' , $ar_category , $product->category_id);?>
    <br />
    <?if (is_null($product->picture_file_path)) : ?>
        <h2>Main Picture</h2>
        <?=form::upload(array('name' => 'picture_file[1]'), '')?>
    <?else :?>
        <?if (!isset($fileurl[1])) :?>
            <h2>Main Picture</h2>
            <?=form::upload(array('name' => 'picture_file[1]'), '')?>
        <?endif;?>
        <h2>Picture</h2>
        <?$max = 0;?>
        <?foreach ($fileurl as $key => $url) :?>
            <img src="<?=$url?>" width="200px" alt="" /><br />
            <?=form::checkbox('delete_picture_file['.$key.']' , 'Delete')?><strong>Delete</strong><?=($key == 1) ? "<strong> (Main Picture)</strong>" : ""?><br /><br /><br />
            <?$max = $key?>
        <?endforeach;?>
        <?$max++;?>
        <br /><br />
        <h2><?=form::label('upload' , 'Upload new picture')?></h2>
        <?=form::upload(array('name' => 'picture_file['.$max.']'), '')?>
    <?endif;?>
    <h2>Price</h2>
    <?=form::input(array('name' => 'price' , 'id' => 'price' , 'class' => 'required') , $product->price)?>
    <br />
    <?=form::submit('submit' , 'Submit')?>
    <?=form::close()?>
    </div>
</div>