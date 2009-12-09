<?
    $ar_category = array();
    foreach ($categories as $category)
        $ar_category[$category->id] = $category->id . ". " . $category->name;
?>
<?if ($lang == Controller::LANG_EN) : ?>
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
    <?=form::input(array('name' => 'name' , 'id' => 'title' , 'class' => 'required'))?>
    <h2>Product Description</h2>
    <?=form::textarea(array('name' => 'description' , 'id' => 'content'))?>
    <h2>Product Description in English</h2>
    <?=form::textarea(array('name' => 'description_en' , 'id' => 'content_en' , 'style' => 'height:300px;'))?>
    <h2>Category</h2>
    <?=form::dropdown('category_id' , $ar_category);?>
    <h2>Main Picture</h2>
    <?=form::upload(array('name' => 'picture_file[1]'), '')?>
    <h2>Price</h2>
    <?=form::input(array('name' => 'price' , 'id' => 'price' , 'class' => 'required'))?>
    <br />
    <?=form::submit('submit' , 'Submit')?>
    <?=form::close()?>
    </div>
</div>
<?else :?>
<div id="product_edit" class="main">
    <h1 class="title">Buat Produk</h1>
    <div class="links">
        <ul>
            <li><a href="javascript:history.go(-1)">Kembali</a></li>
            <li><?=html::anchor('administrator/products' , 'Daftar Produk')?></li>
        </ul>
    </div>
    <br />
    <div id="article_form">
    <?=form::open(url::current() , array('name' => 'product_form' , 'id' => 'product_form' , 'enctype' => 'multipart/form-data'))?>
    <h2>Nama Produk</h2>
    <?=form::input(array('name' => 'name' , 'id' => 'title' , 'class' => 'required'))?>
    <h2>Deskripsi Produk</h2>
    <?=form::textarea(array('name' => 'description' , 'id' => 'content'))?>
    <h2>Deskripsi Produk dalam Bahasa Inggris</h2>
    <?=form::textarea(array('name' => 'description_en' , 'id' => 'content_en' , 'style' => 'height:300px;'))?>
    <h2>Kategori</h2>
    <?=form::dropdown('category_id' , $ar_category);?>
    <h2>Gambar Utama</h2>
    <?=form::upload(array('name' => 'picture_file[1]'), '')?>
    <h2>Harga</h2>
    <?=form::input(array('name' => 'price' , 'id' => 'price' , 'class' => 'required'))?>
    <br />
    <?=form::submit('submit' , 'Submit')?>
    <?=form::close()?>
    </div>
</div>
<?endif;?>