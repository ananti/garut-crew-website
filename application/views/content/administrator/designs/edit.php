<?
    $ar_category = array();
    foreach ($categories as $category)
        $ar_category[$category->id] = $category->id . ". " . $category->name;
    $fileurl = json_decode($design->picture_file_url);
?>
<?if ($lang == Controller::LANG_EN) : ?>
<div id="product_edit" class="main">
    <h1 class="title">Edit Design</h1>
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
    <?=form::input(array('name' => 'name' , 'id' => 'title' , 'class' => 'required') , $design->name)?>
    <h3>Design Description</h3>
    <?=form::textarea(array('name' => 'description' , 'id' => 'content') , $design->description)?>
    <h3>Design Description in English</h3>
    <?=form::textarea(array('name' => 'description_en' , 'id' => 'content_en' , 'style' => 'height:300px;') , $design->description_en)?>
    <h3>Category</h3>
    <?=form::dropdown('category_id' , $ar_category , $design->category_id);?>
    <h3>Picture</h3>
    <?if (is_null($design->picture_file_path)) : ?>
        <?=form::upload(array('name' => 'picture_file[1]'), '')?>
    <?else :?>
        <?$max = 0;?>
        <?foreach ($fileurl as $key => $url) :?>
            <img src="<?=$url?>" width="200px" alt="" /><br />
            <?=form::checkbox('delete_picture_file['.$key.']' , 'Delete')?><strong>Delete</strong><br /><br /><br />
            <?$max = $key?>
        <?endforeach;?>
    <?endif;?>
    <h3>Price</h3>
    <?=form::input(array('name' => 'price' , 'id' => 'price' , 'class' => 'required') , $design->price)?>
    <br />
    <?=form::submit('submit' , 'Submit')?>
    <?=form::close()?>
    </div>
</div>
<?else :?>
<div id="product_edit" class="main">
    <h1 class="title">Ubah Desain</h1>
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
    <?=form::input(array('name' => 'name' , 'id' => 'title' , 'class' => 'required') , $design->name)?>
    <h3>Deskripsi Desain</h3>
    <?=form::textarea(array('name' => 'description' , 'id' => 'content') , $design->description)?>
    <h3>Deskripsi Desain dalam Bahasa Inggris</h3>
    <?=form::textarea(array('name' => 'description_en' , 'id' => 'content_en' , 'style' => 'height:300px;') , $design->description_en)?>
    <h3>Kategori</h3>
    <?=form::dropdown('category_id' , $ar_category , $design->category_id);?>
    <h3>Gambar</h3>
    <?if (is_null($design->picture_file_path)) : ?>
        <?=form::upload(array('name' => 'picture_file[1]'), '')?>
    <?else :?>
        <?$max = 0;?>
        <?foreach ($fileurl as $key => $url) :?>
            <img src="<?=$url?>" width="200px" alt="" /><br />
            <?=form::checkbox('delete_picture_file['.$key.']' , 'Delete')?><strong>Hapus</strong><br /><br /><br />
            <?$max = $key?>
        <?endforeach;?>
    <?endif;?>
    <h3>Harga</h3>
    <?=form::input(array('name' => 'price' , 'id' => 'price' , 'class' => 'required') , $design->price)?>
    <br />
    <?=form::submit('submit' , 'Submit')?>
    <?=form::close()?>
    </div>
</div>
<?endif;?>