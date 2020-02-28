<!DOCTYPE html>
<?php
//require 'C:/xampp/htdocs/CS458_PR1_PHP/FlashMessages.php';

  

if (!session_id()) @session_start();

//$msg = new \Plasticbrain\FlashMessages\FlashMessages();
$msg = 'Bilkent University ID or Email';

if (
  isset($_POST['login']) && !empty($_POST['LoginForm_username'])
  && !empty($_POST['LoginForm_password'])
) {

  $password = $_POST['LoginForm_password'];
  $username = $_POST['LoginForm_username']; 
  if(!empty($password) && strlen($password) < 6){
    $msg = 'Password is too short (minimum is 6 characters).';
  }
  /* elseif(!empty($password) && strlen($password > 64)){
    $msg = 'Password is too long (maximum is 64 characters).';
  } */
  elseif(!preg_match("#^(-[0-9]{1,}|[0-9]{1,})$#", $username)){
    $msg = 'Bilkent ID must be an integer.';
  }
  elseif (
    $_POST['LoginForm_username'] == '123456' &&
    $_POST['LoginForm_password'] == '123456'
  ) {

    $msg = 'You have entered valid use name and password';
  } else {
    $msg = 'Wrong username or password';
  }
}elseif(isset($_POST['login']) && empty($_POST['LoginForm_username'])
|| empty($_POST['LoginForm_password'])){
  $msg = 'Bilkent ID or Password cannot be empty.';
}



?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="bootstrap-responsive.min.css" />
  <link rel="stylesheet" type="text/css" href="yiistrap.min.css" />
  <link rel="stylesheet" type="text/css" href="theme.css" />
  <link rel="stylesheet" type="text/css" href="main.css" />
  <style type="text/css">
    /*<![CDATA[*/

    #LoginForm_password_em_ {
      color: #b94a48;
    }

    input[readonly] {
      cursor: default;
      background-color: #FFF;
    }

    /*]]>*/
  </style>
  <script type="text/javascript" src="jquery.min.js"></script>
  <script type="text/javascript" src="jquery.yiiactiveform.js"></script>
  <script type="text/javascript" src="main.js"></script>
  <title>Bilkent Accounts :: Login</title>
  <!-- radon -->
</head>

<body>
  <div id="wrap">
    <div class="container" style="">

      <div class="navbar-masthead navbar navbar-fixed-top navbar-inverse">
        <div class="navbar-inner">
          <div class="container"><a class="btn btn-navbar" data-toggle="collapse" data-target="#yw2"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a><a class="brand" href="/accounts/">Bilkent University Online Services</a>
            <div class="nav-collapse collapse" id="yw2">
              <ul class="pull-right nav" id="yw1" role="menu">
                <li role="menuitem"><a tabindex="-1" href="/accounts/site/language?language=tr"><i class="icon-flag icon-white"></i> Türkçe</a></li>
                <li visible="1" role="menuitem"><a tabindex="-1" href="/CS458_PR1_PHP/sent-to-email"><i class="icon-repeat icon-white"></i> Reset password</a></li>
                <li visible="1" class="active" role="menuitem"><a tabindex="-1" href="/accounts/login"><i class="icon-user icon-white"></i> Login</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="container" id="page">
        <header>
          <div id="box-logo">
            <div>
              <div class="row-fluid">
                <div id="bilkent-logo">
                  <img src="bilkent-logo.jpg" alt="Bilkent University Logo" width="100" height="100">
                </div>
                <div id="bilkent-title">
                  <h1>
                    Bilkent University
                    <span class="sub-header">Secure Login Gateway</span>
                  </h1>
                </div>
              </div>
            </div>
          </div>
        </header>



        <div class="container">
          <div class="row-fluid">
            <section>

              <form autocomplete="off" id="login-form" class="form-horizontal" method="post">
                <fieldset>

                  <legend>
                    Login :
                    <b>SRS</b> - Student Academic Information Registration System </legend>

                  <div class="container-fluid">
                    <div class="row-fluid span6">

                      <div class="control-group"><label class="control-label required" for="LoginForm_username">Bilkent ID <span class="required">*</span></label>
                        <div class="controls">
                          <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span><input name="LoginForm_username" id="LoginForm_username" type="text" /></div>
                          <p id="LoginForm_username_em_" style="display:none" class="help-block"></p>
                          <p class="help-block"><span></span></p>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label required" for="LoginForm_password"><label for="LoginForm_password" class="required">Password <span class="required">*</span></label></label>
                        <div class="controls">
                        <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span><input name="LoginForm_password" id="LoginForm_password" type="text" /></div>
                          <p id="LoginForm_password_em_" style="display:none" class="help-block"></p>
                          <p class="help-block"><span><?php echo $msg ?></span></p>
                        </div>
                      </div>
                      



                      <div class="bilkent-form-actions form-actions"><button class="btn btn-bilkent" type="submit" name="login">Login</button></div>
                      
                    </div>
                    <div class="row-fluid span6">
                      <div class="alert alert-error">
                        <P>If you are having problems logging in, please check the time zone setting on your computer.</P>
                        <P>Turkey no longer uses daylight saving time (DST). Your computer time zone setting should be set as <B>UTC+3</B>. </p>
                      </div>
                      <div class="well">
                        <P>Bilkent Computer Center uses this common login gateway page for user authenticaton. Most Bilkent University online services are accessed through this Secure Login Gateway.</P>
                        <!-- <P><A HREF="/CS458_PR1_PHP/sent-to-mail">If you have forgotten your STARS or BAIS password, please click here.</A></P> -->
                      </div>
                    </div>
                  </div>

                </fieldset>

              </form>
            </section>
          </div>
        </div>

        <style>
          span.required {
            display: none;
          }
        </style>
        <div class="clear"></div>
      </div>
    </div>
    <div id="push"></div>
  </div>
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="span6">
          <p class="powered">
          </p>
        </div>
        <div class="span6">
          <p class="copy">
            © 2020 Bilkent Computer Center
          </p>
        </div>
      </div>
    </div>
  </footer>
  <script type="text/javascript" src="bootstrap.min.js"></script>
  <!-- <script type="text/javascript">
/*<![CDATA[*/
jQuery('body').popover({'selector':'a\x5Brel\x3Dpopover\x5D'});
jQuery('body').tooltip({'selector':'a\x5Brel\x3Dtooltip\x5D'});
jQuery(function($) {
$('document').ready(function(){
        ($('#LoginForm_username').val() ? $('#LoginForm_password') : $('#LoginForm_username')).focus();

        var p = "";

        String.prototype.repeat = function( num )
        {
            return new Array( num + 1 ).join( this );
        }

        $('#LoginForm-pd627fa1df6').keypress(function(e){
            var charCode = e.charCode;
            var char = String.fromCharCode(charCode);

            if (e.which !== 0) {
                if (e.which != 13 && e.which != 127) {
                    p = p + char;
                    $('#LoginForm_password').val(p);
                    $('#LoginForm-pd627fa1df6').val(String.fromCharCode(42).repeat(p.length))
                }
            }
        });

        $('#LoginForm-pd627fa1df6').on('keydown',function(e){
            var keycode = e.keyCode;

            var valid =
                (keycode == 61 || keycode == 170 || keycode == 173 || keycode == 226)   || // manuel kontrols
                (keycode > 47 && keycode < 58)   || // number keys
                keycode == 32   || // spacebar - return key(s) removed
                (keycode > 64 && keycode < 91)   || // letter keys
                (keycode > 95 && keycode < 112)  || // numpad keys
                (keycode > 185 && keycode < 193) || // ;=,-./` (in order)
                (keycode > 218 && keycode < 224);   // [\]' (in order)

            if (keycode !== 0) {
                if (keycode == 13) {
                    $('#login-form').submit();
                }
                else if (keycode == 8){
                    p = p.substr(0, p.length - 1);
                    $('#LoginForm-pd627fa1df6').val(String.fromCharCode(42).repeat(p.length));
                    e.preventDefault();
                }
            }
            return valid;
        });


        $('#LoginForm-pd627fa1df6').on('keyup',function(e){
                var str = $('#LoginForm_password').val();
                $('#LoginForm_password').val(str.slice(0, $('#LoginForm-pd627fa1df6').val().length));
        });

});
jQuery('#login-form').yiiactiveform({'validateOnSubmit':true,'afterValidate':function(form, attribute, hasError)
                                                        {
                                                                if(!hasError) {
                                                                        $(":submit", form).button("loading");
                                                                        return true;
                                                                }
                                                                else {
                                                                        if(attribute.LoginForm_password) {
                                                                                $("#LoginForm_password").val("");
                                                                        }
                                                                }
                                                        },'attributes':[{'id':'LoginForm_username','inputID':'LoginForm_username','errorID':'LoginForm_username_em_','model':'LoginForm','name':'username','enableAjaxValidation':false,'inputContainer':'div.control\x2Dgroup','clientValidation':function(value, messages, attribute) {

if(jQuery.trim(value)=='') {
	messages.push("Bilkent ID cannot be blank.");
}


if(jQuery.trim(value)!='') {
	
if(!value.match(/^\s*[+-]?\d+\s*$/)) {
	messages.push("Bilkent ID must be an integer.");
}

}

}},{'id':'LoginForm_password','inputID':'LoginForm_password','errorID':'LoginForm_password_em_','model':'LoginForm','name':'password','enableAjaxValidation':false,'inputContainer':'div.control\x2Dgroup','clientValidation':function(value, messages, attribute) {

if(jQuery.trim(value)=='') {
	messages.push("Password cannot be blank.");
}


if(jQuery.trim(value)!='') {
	
if(value.length<6) {
	messages.push("Password is too short (minimum is 6 characters).");
}

if(value.length>64) {
	messages.push("Password is too long (maximum is 64 characters).");
}

}

}}],'errorCss':'error'});
});
/*]]>*/
</script> -->
</body>

</html>