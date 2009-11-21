<?=html::script("public/scripts/jquery/jquery.form.js")?>
<?=html::script("public/scripts/jquery/jquery.validate.js")?>
<script type="text/javascript" language="javascript">
    $(document).ready(function(){
        var validation = $('#registration').validate({
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
                },
                confemail: {
                    required: true,
                    equalTo: "#email"
                },
                fullname: "required",
                captcha: "required"
            },
            messages: {
                username: {
                    required: "Enter your username",
                    remote: "Username already exists",
                    minlength: jQuery.format("Enter at least {0} characters")
                },
                password: {
                    required: "Enter your password",
                    minlength: jQuery.format("Enter at least {0} characters")
                },
                confpassword: {
                    required: "Repeat your password",
                    minlength: jQuery.format("Enter at least {0} characters"),
                    equalTo: "Enter the same password as above"
                },
                email: {
                    required: "Please enter a valid email address",
                    remote: "Email already exists",
                    email: "Please enter a valid email address"
                },
                confemail: {
                    required: "Please enter a valid email address",
                    email: "Please enter a valid email address",
                    equalTo: "Enter the same email as above"
                },
                fullname: "Enter your name",
                captcha: "Enter code above"
            },
            submitHandler : function(){
                $("#registration").ajaxSubmit({
                    url: '<?=url::site('json/user/register')?>',
                    dataType: 'json',
                    success: function(data){
                        if (!data.result){
                            if (data.reason == 'exists_username') {
                                validation.showErrors({'username' : 'Username already exists'});
                            } else if (data.reason == 'exists_email') {
                                validation.showErrors({'email' : 'Email already exists'});
                            } else if (data.reason == 'invalid_captcha') {
                                $("#captchaimg").attr("src", "<?=url::site('captcha')?>?"+((new Date()).getTime()));
                                validation.showErrors({'captcha' : 'Wrong input'});
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
