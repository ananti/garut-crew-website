<?if ($this->lang == Controller::LANG_EN) : ?>
    <div class="sidebar_block">
        <h2>Administrator Menu</h2>
        <ul>
            <li><?=html::anchor('administrator/products', 'Product List')?></li>
            <li><?=html::anchor('administrator/designs', 'Design List')?></li>
            <li><?=html::anchor('administrator/categories', 'Categories')?></li>
            <li><?=html::anchor('administrator/users', 'User management')?></li>
            <li><?=html::anchor('administrator/news', 'News List')?></li>
            <li><?=html::anchor('administrator/settings', 'Account Settings')?></li>
        </ul>
    </div>
<?else :?>
    <div class="sidebar_block">
        <h2>Administrator Menu</h2>
        <ul>
            <li><?=html::anchor('administrator/products', 'Daftar Produk')?></li>
            <li><?=html::anchor('administrator/designs', 'Daftar Desain')?></li>
            <li><?=html::anchor('administrator/categories', 'Kategori')?></li>
            <li><?=html::anchor('administrator/users', 'Manajemen Pengguna')?></li>
            <li><?=html::anchor('administrator/news', 'Daftar Berita')?></li>
            <li><?=html::anchor('administrator/settings', 'Pengaturan Akun')?></li>
        </ul>
    </div>
<?endif;?>