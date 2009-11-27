<?
    $ar_category = array();
    foreach ($categories as $category)
        $ar_category[$category->id] = $category->id . ". " . $category->name;
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
    <h3>Product Name</h3>
    <?=form::input(array('name' => 'name' , 'id' => 'title' , 'class' => 'required') , $product->name)?>
    <h3>Product Description</h3>
    <?=form::textarea(array('name' => 'description' , 'id' => 'content') , $product->description)?>
    <h3>Category</h3>
    <?=form::dropdown('category_id' , $ar_category , $product->category_id);?>
    <h3>Picture</h3>
    <?if (is_null($product->picture_file_path)) : ?>
    <?=form::upload(array('name' => 'picture_file[2]'), '')?>
    <?else :?>
    <img src="<?=$product->picture_file_url?>" width="400px" alt="" /><br />
    <?=form::checkbox('delete_picture_file' , 'Delete')?><strong>Delete</strong>
    <?endif;?>
    <h3>Price</h3>
    <?=form::input(array('name' => 'price' , 'id' => 'price' , 'class' => 'required') , $product->price)?>
    <br />
    <?=form::submit('submit' , 'Submit')?>
    <?=form::close()?>
    </div>
</div>