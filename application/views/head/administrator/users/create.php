<?=html::script("public/scripts/jquery/jquery.form.js")?>
<?=html::script("public/scripts/jquery/jquery.validate.js")?>
<script type="text/javascript" language="javascript">
    $(document).ready(function(){
        var validation = $('#user_create_form').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 2
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confpassword: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                username: {
                    required: "Enter your username",
                    remote: "Username already exists",
                    minlength: jQuery.format("Enter at least {0} characters")
                },
                password: {
                    required: "Enter password",
                    minlength: jQuery.format("Enter at least {0} characters")
                },
                confpassword: {
                    required: "Repeat password",
                    minlength: jQuery.format("Enter at least {0} characters"),
                    equalTo: "Enter the same password as above"
                },
                email: {
                    required: "Please enter a valid email address",
                    remote: "Email already exists",
                    email: "Please enter a valid email address"
                },
                fullname: "Enter the name"
            },
            submitHandler : function(){
                $("#user_create_form").ajaxSubmit({
                    url: '<?=url::site('json/user/usercreate')?>',
                    dataType: 'json',
                    success: function(data){
                        if (!data.result){
                            if (data.reason == 'exists_username') {
                                validation.showErrors({'username' : 'Username already exists'});
                            } else if (data.reason == 'exists_email') {
                                validation.showErrors({'email' : 'Email already exists'});
                            } else if (data.reason == 'member_not_found') {

                            }
                        } else {
                            //Redirect
                            window.location = '<?=url::site('redirect')?>';
                        }
                    }
                })
                return false;
            }
        });
    });
</script>
