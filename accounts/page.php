<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION['username']) || empty($_SESSION['username'])){

      header("location: login.php");

      exit;
    }
?>
<?php

  require_once "../config.php";

    $sql = 'SELECT * FROM posts ORDER BY id DESC';

    $query = mysqli_query($link, $sql);
?>
<?php
include "header.php";
?>

<title>nftresourcex - Pick Investments</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="nfts investment" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<link rel="icon" href="images/icon.png">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/mevo.css"> 
<link rel="stylesheet" href="css/responsive.css">
<link rel="stylesheet" href="css/garden.css">
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<!-- font-awesome-icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome-icons -->
<link href="//fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
</head>
<body>
	
	<!-- //banner -->
<!-- gallery -->
	<section class="section wb">
		<div class="container">
        
        <span class="bg-aqua"><a href="welcome.php" title=""><button type="button" class="btn btn-sm">Back</button></a></span>
        <center><span class="color-green"><a href="page.php" title="">NFTs Available</a></span></center>
				<div class="row">
                        <?php 
                            if (mysqli_num_rows($query)==0) {
                              echo "<b style='color:brown;'>Sorry there are no posts Yet :( We will be uploading new content soon! </b> ";
                              }
                            
                          
                          else
                          {

                          	while ($row=mysqli_fetch_array($query)) {
                            echo '
                          	
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
					<div class="page-wrapper">
					<div class="blog-list clearfix">
					<div class="blog-box row">
					<div class="col-md-4">
                                        <div class="post-media">
                                            <a href="nft-single.php?id='.$row["id"].'">
                                                <img src="../upload/'.$row["imgFullName"].'" alt="" class="img-fluid">
                                                <div class="hovereffect"></div>
                                            </a>
                                        </div>
                                    </div>

									<div class="blog-meta big-meta col-md-8">
                                        <span class="bg-aqua"><a href="page.php" title="">NFT</a></span>
                                        <a href="nft-single.php?id='.$row["id"].'"><h4>'.$row["title"].'</h4></a>
                                        <p>'.substr($row["content"], 0, 200).'</p>
                                        <h5>'.$row["amount"].'<i class="fab fa-ethereum"></i></h5>
                                        <small><h6 style="color: #1950c6;">'.$row["author"].'<b style="color: #000;">|</b>'.$row["date"].'</h6></small>
                                        
                                    </div>
						
						<br>
					</div>

					</div>
					</div>
					</div>
                    ';
						}
							}
						?>

</div>

			<script src="js/jzBox.js"></script>
		</div>
						</section>
<!-- //gallery -->
<!-- footer -->
	
	<footer class="page-footer font-small blue">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2022 Copyright:
    <a href="../index.php">Home</a>
    <a href="../contact.php">Contact</a>

    </div>
    <!-- Copyright -->

    </footer>

                        </body>
                        