<?=html::script("public/scripts/jquery/jquery.form.js")?>
<?=html::script("public/scripts/jquery/jquery.validate.js")?>
<script type="text/javascript" language="javascript">
    $(document).ready(function(){
        var validation = $('#account_settings_form').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 2
                },
                password: {
                    minlength: 5
                },
                confpassword: {
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
                    minlength: jQuery.format("Enter at least {0} characters")
                },
                confpassword: {
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
                $("#account_settings_form").ajaxSubmit({
                    url: '<?=url::site('json/user/accountedit/'.$user->id)?>',
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
