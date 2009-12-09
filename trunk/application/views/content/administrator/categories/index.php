<?if ($lang == Controller::LANG_EN) : ?>
<div id="category_list" class="main">
    <h1 class="title">Category List</h1>
    <h3></h3>
    <table class="list main">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?if (!isset($categories) || count($categories) < 1) :?>
            <tr class="empty">
                <td colspan="3">No categories</td>
            </tr>
            <?else:?>
            <?foreach($categories as $category) :?>
            <tr class="<?=text::alternate('odd' , 'even')?>">
                <td><?=$category->id?></td>
                <td><?=$category->name?></td>
                <td><?=html::anchor('administrator/categories/delete/' . $category->id , "Delete")?></td>
            </tr>
            <?endforeach;?>
            <?endif;?>
        </tbody>
    </table>
    <div id="category_add_form">
        <h3>Add New Category</h3>
        <?=form::open(url::current() , array('name' => 'category_add' , 'id' => 'category_add'))?>
        <?=form::input(array('name'=>'name', 'id'=>'name'))?>
        <?=form::input(array('name'=>'name_en', 'id'=>'name_en' , 'style' => 'display:none;'))?>
        <?=form::submit('submit' , 'Add')?>
        <?=form::close()?>
    </div>
</div>
<?else :?>
<div id="category_list" class="main">
    <h1 class="title">Daftar Kategori</h1>
    <h3></h3>
    <table class="list main">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?if (!isset($categories) || count($categories) < 1) :?>
            <tr class="empty">
                <td colspan="3">Tidak ada kategori</td>
            </tr>
            <?else:?>
            <?foreach($categories as $category) :?>
            <tr class="<?=text::alternate('odd' , 'even')?>">
                <td><?=$category->id?></td>
                <td><?=$category->name?></td>
                <td><?=html::anchor('administrator/categories/delete/' . $category->id , "Hapus")?></td>
            </tr>
            <?endforeach;?>
            <?endif;?>
        </tbody>
    </table>
    <div id="category_add_form">
        <h3>Add New Category</h3>
        <?=form::open(url::current() , array('name' => 'category_add' , 'id' => 'category_add'))?>
        <?=form::input(array('name'=>'name', 'id'=>'name'))?>
        <?=form::input(array('name'=>'name_en', 'id'=>'name_en' , 'style' => 'display:none;'))?>
        <?=form::submit('submit' , 'Add')?>
        <?=form::close()?>
    </div>
</div>
<?endif;?>