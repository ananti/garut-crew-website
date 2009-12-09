<?
    $ar_category = array();
    foreach ($categories as $category)
        $ar_category[$category->id] = $category->id . ". " . $category->name;
?>
<?if ($lang == Controller::LANG_EN) : ?>
<div id="product_edit" class="main">
    <h1 class="title">Create Design</h1>
    <div class="links">
        <ul>
            <li><a href="javascript:history.go(-1)">Back</a></li>
            <li><?=html::anchor('administrator/designs' , 'List')?></li>
        </ul>
    </div>
    <br />
    <div id="article_form">
    <?=form::open(url::current() , array('name' => 'design_form' , 'id' => 'design_form' , 'enctype' => 'multipart/form-data'))?>
    <h3>Design Name</h3>
    <?=form::input(array('name' => 'name' , 'id' => 'title' , 'class' => 'required'))?>
    <h3>Design Description</h3>
    <?=form::textarea(array('name' => 'description' , 'id' => 'content'))?>
    <h3>Design Description in English</h3>
    <?=form::textarea(array('name' => 'description_en' , 'id' => 'content_en' , 'style' => 'height:300px;'))?>
    <h3>Category</h3>
    <?=form::dropdown('category_id' , $ar_category);?>
    <h3>Picture</h3>
    <?=form::upload(array('name' => 'picture_file[1]'), '')?>
    <h3>Price</h3>
    <?=form::input(array('name' => 'price' , 'id' => 'price' , 'class' => 'required'))?>
    <br />
    <?=form::submit('submit' , 'Submit')?>
    <?=form::close()?>
    </div>
</div>
<?else :?>
<div id="product_edit" class="main">
    <h1 class="title">Buat Desain</h1>
    <div class="links">
        <ul>
            <li><a href="javascript:history.go(-1)">Kembali</a></li>
            <li><?=html::anchor('administrator/designs' , 'Daftar Desain')?></li>
        </ul>
    </div>
    <br />
    <div id="article_form">
    <?=form::open(url::current() , array('name' => 'design_form' , 'id' => 'design_form' , 'enctype' => 'multipart/form-data'))?>
    <h3>Nama Desain</h3>
    <?=form::input(array('name' => 'name' , 'id' => 'title' , 'class' => 'required'))?>
    <h3>Deskripsi Desain</h3>
    <?=form::textarea(array('name' => 'description' , 'id' => 'content'))?>
    <h3>Deskripsi Desain dalam Bahasa Inggris</h3>
    <?=form::textarea(array('name' => 'description_en' , 'id' => 'content_en' , 'style' => 'height:300px;'))?>
    <h3>Kategori</h3>
    <?=form::dropdown('category_id' , $ar_category);?>
    <h3>Gambar</h3>
    <?=form::upload(array('name' => 'picture_file[1]'), '')?>
    <h3>Harga</h3>
    <?=form::input(array('name' => 'price' , 'id' => 'price' , 'class' => 'required'))?>
    <br />
    <?=form::submit('submit' , 'Submit')?>
    <?=form::close()?>
    </div>
</div>
<?endif;?>