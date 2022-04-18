<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php?id=$id");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
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
    <link href="../css/bootstrap.min.5c7070ef655a.css" rel="stylesheet">
<link href="../css/font-awesome.min.dcc433f0f2ff.css" rel="stylesheet">

  <link rel="stylesheet" href="../css/style.dafddd277bb1.css">
  <link rel="stylesheet" href="../css/quickform.96d6bb50f184.css">
  <link rel="stylesheet" href="../css/bootstrap-extensions.ac6fa260a89d.css">
    <meta charset="UTF-8">
    <title>nftresourcex.com: Login</title>
    <link rel="stylesheet" type="text/css" href="../css/cookieconsent.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
    <script src="../js/jquery-1.12.4.min.4f252523d4af.js"></script>
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
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <!-- <label>User-id</label> -->
                <input type="text" name="username" placeholder="Username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <!-- <label>Password</label> -->
                <input type="password" name="password" placeholder="Enter password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div>
            <label>Please verify you are a human.</label>
            <script src="https://hcaptcha.com/1/api.js" async defer></script>
            <div class="h-captcha" data-sitekey="9a916217-ab43-419b-a9da-90483b6478d8"></div>
    </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
             <a href="../index.php">Go back</a>
             <a href="../register.php">Sign up</a>
             
        </form>
    </div>
</body>
</html>