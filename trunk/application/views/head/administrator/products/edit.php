<?=html::script("public/scripts/jquery/jquery.form.js");?>
<?=html::script("public/scripts/jquery/jquery.validate.js");?>
<?=html::script("public/scripts/tiny_mce/tiny_mce_src.js");?>
<script type="text/javascript" language="javascript">
    tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        theme_advanced_buttons1_add_before : "defaultdesc",
        convert_urls : false,
        // Theme options
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom"
    });

</script>
<script type="text/javascript" language="javascript">
    $(document).ready(function(){
        $('#product_form').validate();
    });
</script>

