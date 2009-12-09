<?if ($lang == Controller::LANG_EN) : ?>
<div id="product_list" class="main">
    <h1 class="title">Design List</h1>
    <div class="links">
        <ul>
            <li><?=html::anchor('administrator/designs/create' , 'Create')?></li>
            <li><?=html::anchor('administrator/designs' , 'List')?></li>
        </ul>
    </div>
    <table>
        <tr>
            <td valign="top">
                <?=html::anchor(url::site('administrator/designs') , "All")?><br />
                <?foreach ($categories as $category) :?>
                <?=html::anchor(url::site('administrator/designs/index/' . $category->id) , $category->name)?><br />
                <?endforeach;?>
            </td>
            <td><table class="list main">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Submitter</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?if (count($designs) < 1) :?>
                    <tr class="empty">
                        <td colspan="5">No Products</td>
                    </tr>
                <?else :?>
                    <?foreach ($designs as $design) :?>
                    <tr class="<?=text::alternate('odd' , 'even')?>">
                        <td><?=html::anchor('designs/view/' . $design->id , $design->name)?></td>
                        <td><?=ORM::factory('category' , $design->category_id)->name?></td>
                        <td><?=html::anchor('users/view/' . $design->user_id , ORM::factory('user' , $design->user_id)->first_name . " " . ORM::factory('user' , $design->user_id)->last_name)?></td>
                        <td>Rp <?=$design->price?></td>
                        <td><?=html::anchor('administrator/designs/edit/' . $design->id , "Edit")?> <span class="delete"><?=html::anchor('administrator/designs/delete/' . $design->id , "Delete")?></span></td>
                    </tr>
                    <?endforeach;?>
                <?endif;?>
                </tbody>
            </table></td>
        </tr>
    </table>
    <?=$pagin->render()?>
</div>
<?else :?>
<div id="product_list" class="main">
    <h1 class="title">Daftar Desain</h1>
    <div class="links">
        <ul>
            <li><?=html::anchor('administrator/designs/create' , 'Buat Desain')?></li>
            <li><?=html::anchor('administrator/designs' , 'Daftar Desain')?></li>
        </ul>
    </div>
    <table>
        <tr>
            <td valign="top">
                <?=html::anchor(url::site('administrator/designs') , "Semua")?><br />
                <?foreach ($categories as $category) :?>
                <?=html::anchor(url::site('administrator/designs/index/' . $category->id) , $category->name)?><br />
                <?endforeach;?>
            </td>
            <td><table class="list main">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Pembuat</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?if (count($designs) < 1) :?>
                    <tr class="empty">
                        <td colspan="5">Tidak ada produk</td>
                    </tr>
                <?else :?>
                    <?foreach ($designs as $design) :?>
                    <tr class="<?=text::alternate('odd' , 'even')?>">
                        <td><?=html::anchor('designs/view/' . $design->id , $design->name)?></td>
                        <td><?=ORM::factory('category' , $design->category_id)->name?></td>
                        <td><?=html::anchor('users/view/' . $design->user_id , ORM::factory('user' , $design->user_id)->first_name . " " . ORM::factory('user' , $design->user_id)->last_name)?></td>
                        <td>Rp <?=$design->price?></td>
                        <td><?=html::anchor('administrator/designs/edit/' . $design->id , "Ubah")?> <span class="delete"><?=html::anchor('administrator/designs/delete/' . $design->id , "Hapus")?></span></td>
                    </tr>
                    <?endforeach;?>
                <?endif;?>
                </tbody>
            </table></td>
        </tr>
    </table>
    <?=$pagin->render()?>
</div>
<?endif;?>