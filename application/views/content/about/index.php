<?if ($lang == Controller::LANG_EN) : ?>
<div id ="about" class="main">
    <h1 class="title">About Garut Crew</h1>
    <div class="links">
        <ul>
            <li><?=html::anchor('about/gallery' , "Gallery")?></li>
        </ul>
    </div>
</div>
<?else :?>
<div id ="about" class="main">
    <h1 class="title">Sekilas Garut Crew</h1>
    <div class="links">
        <ul>
            <li><?=html::anchor('about/gallery' , "Galeri Foto")?></li>
        </ul>
    </div>
</div>
<?endif;?>