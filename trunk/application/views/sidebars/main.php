<?if ($this->lang == Controller::LANG_EN) : ?>
    <div class="sidebar_block">
        <h2>Main Menu</h2>
        <ul>
            <li><?=html::anchor(url::site('', 'http'), 'Home')?></li>
            <li><?=html::anchor('news', 'News')?></li>
            <li><?=html::anchor('products', 'Our Products')?></li>
            <li><?=html::anchor('designs', 'Our Designs')?></li>
            <li><?=html::anchor('order', 'How To Buy')?></li>
            <li><?=html::anchor('about', 'About Us')?></li>
        </ul>
    </div>
<?else :?>
    <div class="sidebar_block">
        <h2>Main Menu</h2>
        <ul>
            <li><?=html::anchor(url::site('', 'http'), 'Halaman Awal')?></li>
            <li><?=html::anchor('news', 'Berita')?></li>
            <li><?=html::anchor('products', 'Produk Kami')?></li>
            <li><?=html::anchor('designs', 'Desain Kami')?></li>
            <li><?=html::anchor('order', 'Pemesanan')?></li>
            <li><?=html::anchor('about', 'Tentang Kami')?></li>
        </ul>
    </div>
<?endif;?>