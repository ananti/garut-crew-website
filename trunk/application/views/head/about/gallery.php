<?=html::script("public/scripts/jquery/jquery.form.js");?>
<?=html::script("public/scripts/jquery/jquery.validate.js");?>
<?=html::script("public/scripts/tiny_mce/tiny_mce_src.js");?>
<script type="text/javascript" language="javascript">


</script>
<script type="text/javascript" language="javascript">
    $(document).ready(function(){
        $('.picture').hide();
        $('#pic_<?=$file_offset?>').show();
        var current = '#pic_<?=$file_offset?>';
        $('.thumbnail').click(function() {
            $(current).hide();
            //alert($(this).attr("id"));
            $(".picture[id='pic_" + $(this).attr("id") + "']").fadeIn("slow");
            current = ".picture[id='pic_" + $(this).attr("id") + "']";
        });

    });
</script>

