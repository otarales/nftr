<?php

  ob_start();
  require_once "../config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION['username']) || empty($_SESSION['username'])){

      header("location: login.php");

      exit;
    }


$uid = $_SESSION['id'];


 $result = mysqli_query($link, "SELECT * FROM users WHERE id= $uid");
    
?><?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nftresourcex - Welcome user</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="evo.css"> -->
    <link rel="stylesheet" href="css/evo.css">
    
</head>
<body>
  <?php
                            while($row = mysqli_fetch_array($result))
                              { ?>
    <div class="container">
      
        <div class="d-flex flex-row">
        <div class="flex-row pl-1">
        <img src="../images/333.jpg" class="rounded-circle p-100px" width="100px"  height="100px" alt=""></div>
        <div class="flex-row"><h5><b><?php echo  $row['username'] ?></b></h5>
        <a href="profile.php"><button type="button" class="btn btn-primary btn-sm">Edit Profile</button></a>
        <br>
        <a href="logout.php"><button type="button" class="btn btn-sm">Logout</button></a>
        </div>
        
        </div>
        <br>
        <br>
        <br>
        <div id="trade">
            <center><img src="../images/Logomaker.png" height="40px" alt=""></center>
        </div>
        <center><h2>INVESTMENT SUMMARY</h2></center>
        <br>
        <div class="container-fluid">
        <table class="table table-striped">
  <tbody>
    <tr>
      <th scope="col">Active Investment Amount</th>
      <th scope="col"><span style="color: blue"><?php echo  $row['justdeposit'] ?></span></th>
    </tr>
    
    <tr>
      <th>Possible End Returns</th>
      <th><span style="color: green"><?php echo  $row['endprofit'] ?></span></td>
    </tr>
    <tr>
        <th>NFT INVESTED IN</th>
        <th><?php echo  $row['nftbought'] ?></th>
    </tr>
    <tr>
        <th>Current Investment Progress</th>
        <th><?php echo  $row['per'] ?></th>
    </tr>
  </tbody>
</table>
</div>
        <center><p class="bold">Your End Returns for this current investment will be added to your balance when your current investment progress reaches 100%</p></center>
        <br>
        <br>
        <br> 
<h4 ><b>TOTAL BALANCE: <span style="color: green"><?php echo  $row['totaldeposit'] ?></span></b></h4>
<br>
<div class="d-flex flex-row" style="align-self: center">
<a href="page.php"><button type="button" class="btn btn-primary btn-sm">New Investment</button></a>
<br>
<a href="#"><button type="button" class="btn btn-warning btn-sm" disabled>Witdraw Earnings</button></a></div>
<br>
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2022 Copyright:
    <a href="../index.php">Home</a>
    <a href="../contact.php">Contact</a>

  </div>
  <!-- Copyright -->

</footer>
        <script>
    var access_key = '406291127edddb8ec7ccad4320972798';
     
fetch('http://api.coinlayer.com/live?access_key=' + access_key)
.then(response => response.json())
.then(data => {
    console.log(data);
});

</script>

</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>

<?php
                              }
?>