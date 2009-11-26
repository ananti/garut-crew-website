<?=html::script("public/scripts/jquery/jquery.form.js")?>
<?=html::script("public/scripts/jquery/jquery.validate.js")?>
<script type="text/javascript" language="javascript">
    $(document).ready(function(){
        var validation = $('#comment_form').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                name: {
                    required: "Please enter your name"
                },
                email: {
                    required: "Please enter a valid email address",
                    remote: "Email already exists",
                    email: "Please enter a valid email address"
                }
            }
        });
    });
</script>
