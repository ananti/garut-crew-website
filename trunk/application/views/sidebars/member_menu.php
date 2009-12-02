<?if ($this->lang == Controller::LANG_EN) : ?>
    <div class="sidebar_block">
        <h2>Member Menu</h2>
        <ul>
            <li><?=html::anchor('member/designs', 'My Designs')?></li>
            <li><?=html::anchor('member/settings', 'Account Settings')?></li>
        </ul>
    </div>
<?else :?>
    <div class="sidebar_block">
        <h2>Member Menu</h2>
        <ul>
            <li><?=html::anchor('member/designs', 'Desain Saya')?></li>
            <li><?=html::anchor('member/settings', 'Pengaturan Akun')?></li>
        </ul>
    </div>
<?endif;?>