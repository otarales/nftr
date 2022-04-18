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
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        
          mysqli_query($link, $sql);

        header("location: accounts/login.php?succesful-registered");
        } else{
      // Display an error message if password is not valid
        echo "Something is wrong";
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>nftresourcex.com: Fastest and easiest way to buy and sell NFTS
 - nftresourcex.com</title>
</head>
<body>
    <nav class="navbar navbar-fixed-top navbar-default" id="navbar-site">
  <div class="container">
    <div class="navbar-header">
      
        <a class="navbar-brand site-logo-img" href="/"><img src="../images/Logomaker.png" class="img-responsive site-logo"/></a>
      

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
              
                Sign up 
              
                </span>
              </a>
            </li>
            <li><a id="top-login-link" href="login.php"><i class="fa fa-user"></i>&nbsp;Log in</a></li>
          </ul>
        
      
    </div>
  </div>
</nav>

    <div class="wrapper">
        <h2>Register a new account</h2>
        <p>Sign up for a user account to start buying or selling NFTs</p>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                                <input class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"  name="username" placeholder="Username" required type="text" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div>
                            
                            <div class="form-group">
                                <input class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" name="password" placeholder="Password" required type="password" value="<?php echo $password; ?>">
                                
                            </div>
                                <div class="form-group">
                                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" placeholder="Confirm Password" value="<?php echo $confirm_password; ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            </div>
            <div>
            <label>Please verify you are a human.</label>
            <script src="https://hcaptcha.com/1/api.js" async defer></script>
            <div class="h-captcha" data-sitekey="9a916217-ab43-419b-a9da-90483b6478d8"></div>
    </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
             <a href="index.php">Go back</a>
    <p>Already have an account? <a href="accounts/login.php">Log In.</a></p>

    </form>
</body>
</html>