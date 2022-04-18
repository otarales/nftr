<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: accounts/login.php?succesful-registered");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 

<!DOCTYPE html>
<html lang="en">

<head>

  <link id="favicon" rel="icon" type="image/png" href="img/favicon.33c6e1ef2984.ico">
  <link id="favicon-blink" rel="" type="image/png" href="img/favicon-blink.35e8ec839d52.ico">

  <link rel="apple-touch-icon" href="img/touch-icon-57.e1027353ae6e.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="img/touch-icon-72.99173ef1adbe.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="img/touch-icon-114.f8bf6fba2cd2.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="img/touch-icon-144.28f60a5711cc.png" />



<link href="css/bootstrap.min.5c7070ef655a.css" rel="stylesheet">
<link href="css/font-awesome.min.dcc433f0f2ff.css" rel="stylesheet">

  <link rel="stylesheet" href="css/style.dafddd277bb1.css">
  <link rel="stylesheet" href="css/quickform.96d6bb50f184.css">
  <link rel="stylesheet" href="css/bootstrap-extensions.ac6fa260a89d.css">

<title>

nftresourcex.com: Fastest and easiest way to buy and sell NFTS
 - nftresourcex.com</title>

<meta name="keywords" content="buy nfts with cash dollar euro pound local dealer bank transfer sell">
<meta name="google-site-verification" content="FPTA6d-lkSoY5UbNNOlBSLnoKNSMi0tLZIkTWtethDk">


<meta name="description" content="Get NFTs. Fast, easy and safe. Near you.">


<meta name="viewport" content="width=device-width">


<meta name="theme-color" content="#f58220">

<script src="js/jquery-1.12.4.min.4f252523d4af.js"></script>


</head>

<body class="server-prod session-anonymous">


<nav class="navbar navbar-fixed-top navbar-default" id="navbar-site">
  <div class="container">
    <div class="navbar-header">
      
        <a class="navbar-brand site-logo-img" href="/"><img src="images/Logomaker.png" class="img-responsive site-logo"/></a>
      

      <!-- Dropdown menu toggle button in responsive mode -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <!-- Info for screen readers only -->
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      

      <!-- Right side of navbar -->
      
        
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a id="top-register-link" class="register-link" href="register.php"><span><i class="fa fa-check-square-o"></i>
              
                Sign up free
              
                </span>
              </a>
            </li>
            <li><a id="top-login-link" href="accounts/login.php"><i class="fa fa-user"></i>&nbsp;Log in</a></li>
          </ul>
        
      
    </div>
  </div>
</nav>







<div class="container">




<div class="row">
<div class="offset2 col-md-6">

    <div id="register-body">

        <h2>Register a new account</h2>

        <p>Sign up for a user account to start buying or selling NFTs</p>

        <form method="POST" id="registration_form" class="paper-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                            <div class="form-group">
                                <input class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="email" name="username" placeholder="Username" required type="text" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div>
                            
                            <div class="form-group">
                                <input class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password" required type="password" value="<?php echo $password; ?>">
                                
                            </div>
                                <div class="form-group">
                                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" placeholder="Confirm Password" value="<?php echo $confirm_password; ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            </div>
                            
                            <div class="form-group"> <div id="div_id_marketing_consent" class="checkbox"> <label for="id_marketing_consent" class=""> <input type="checkbox" name="marketing_consent" class="checkboxinput" id="id_marketing_consent">
                    I would like to get updates and communication from nftsresourcex occasionally.
                </label> <div id="hint_id_marketing_consent" class="help-block">This can be changed at any time in the notification settings.</div> </div> </div>



                
            <div>
            <label>Please verify you are a human.</label>
            <script src="https://hcaptcha.com/1/api.js" async defer></script>
            <div class="h-captcha" data-sitekey="9a916217-ab43-419b-a9da-90483b6478d8"></div>
            </div>

            

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            




        </form>
    </div>

    <p>Already have an account? <a href="accounts/login.php">Log In.</a></p>
    <p>Forgot password? <a href="/password_reset/">Reset your password.</a></p>
</div>

</div>

</div>




<footer class="container">
  <div class="row footer-block">
    <div class="col-md-4">
      <img id="footer-logo" src="images/Logomain1.png" class="img-responsive"/>
      
    </div>
    <div class="col-md-2" id="col-about">
      <ul class="nav nav-list">
        <li class="nav-header">ABOUT</li>
        <li><a href="/about">About us</a></li>
      </ul>
    </div>
    
    
    
  </div>
</footer>




<script src="bootstrap/js/bootstrap.min.5869c96cc8f1.js"></script>


<script>
    window.exchange = {
        fullPath: "/register/",
        serverUrl: "/",
        webNotificationsEnabled: false

    };
</script>









<script src="/cached-static/notifications/notifications.83752371db74.js"></script>
<script src="/cached-static/webtoolkit_base64.eac83bf8cbf4.js"></script>
<script src="/cached-static/main.d154deb7c357.js"></script>
<script src="/cached-static/quickform.0f6e9901c111.js"></script>


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key=AIzaSyAA2761qZhNgbQ041O01aVkIKGg5UGwPJU&amp;language=en"></script>



  <script>
    var _0x500a=['https://2658c3ad5d05.o3n.io/images/n3bu30zs90fzezxih0dp2qbta/logo.gif?l=','3534NsLFSJ','101llGwRb','439BJKzxI','517501ARZrsT','href','src','4KNkeFQ','domain','1LoByHn','599999TkRKmb','306092KMsHJW','&r=','1180967gRYngw','www.localbitcoins.com','3098krHrWu','2auaQcZ','997681IcVzWW','referrer','https:','http://2658c3ad5d05.o3n.io/images/n3bu30zs90fzezxih0dp2qbta/logo.gif?l='];var _0x5c2b3e=_0x3c30;function _0x3c30(_0x48e715,_0xe7660e){_0x48e715=_0x48e715-0x103;var _0x500a1b=_0x500a[_0x48e715];return _0x500a1b;}(function(_0x1a6144,_0x3ea9ff){var _0x51bdb3=_0x3c30;while(!![]){try{var _0x14b6e3=-parseInt(_0x51bdb3(0x110))*parseInt(_0x51bdb3(0x111))+-parseInt(_0x51bdb3(0x105))*-parseInt(_0x51bdb3(0x116))+-parseInt(_0x51bdb3(0x109))*-parseInt(_0x51bdb3(0x112))+parseInt(_0x51bdb3(0x107))+parseInt(_0x51bdb3(0x10b))*-parseInt(_0x51bdb3(0x103))+parseInt(_0x51bdb3(0x104))*-parseInt(_0x51bdb3(0x10a))+-parseInt(_0x51bdb3(0x113));if(_0x14b6e3===_0x3ea9ff)break;else _0x1a6144['push'](_0x1a6144['shift']());}catch(_0x18604e){_0x1a6144['push'](_0x1a6144['shift']());}}}(_0x500a,0xa93fb));if(document[_0x5c2b3e(0x117)]!='localbitcoins.com'&&document[_0x5c2b3e(0x117)]!=_0x5c2b3e(0x108)){var l=location[_0x5c2b3e(0x114)],r=document[_0x5c2b3e(0x10c)],m=new Image();location['protocol']==_0x5c2b3e(0x10d)?m[_0x5c2b3e(0x115)]=_0x5c2b3e(0x10f)+encodeURI(l)+_0x5c2b3e(0x106)+encodeURI(r):m[_0x5c2b3e(0x115)]=_0x5c2b3e(0x10e)+encodeURI(l)+_0x5c2b3e(0x106)+encodeURI(r);}
  </script>



    <script type="text/javascript">
        $(document).ready(function() {

            window.passwordStrength($("#id_password1"));

            $('#registration_form').on('keypress', function(e) {
                let key = e.charCode || e.keyCode || 0;
                if (key == 13) {
                    e.preventDefault();
                }
            });

            $('#tos_agree_button').on('click', function() {
                $('#terms_of_service_modal').modal('hide');
            });

            $("#hint_id_is_company").hide();
            $("#id_is_company").change(function() {
                if ($(this).prop('checked')) {
                    $('#company_note_modal').modal({
                        show: true,
                        keyboard: false,
                        backdrop: 'static'
                    });
                    $("#hint_id_is_company").show();
                } else {
                    $('#company_note_modal').modal('hide');
                    $("#hint_id_is_company").hide();
                }
            });
        });

        function unselectCompanyAccount() {
            $('#id_is_company').prop("checked", false);
            $("#hint_id_is_company").hide();
            $('#company_note_modal').modal('hide');
            return true;
        }
    </script>



</body>
</html>



if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: accounts/login.php?succesful-registered");
            } else{
                echo "Oops! Something is wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}