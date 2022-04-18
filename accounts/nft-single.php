

    <?php

    require_once "../config.php";
    

        if (isset($_GET['id'])) {
        $postid = $_GET['id'];

        $sql = "SELECT * FROM posts WHERE id='$postid'";
        $query = mysqli_query($link, $sql);

        $sql2 = "SELECT * FROM comments WHERE blogid=$postid";
        $query2 = mysqli_query($link, $sql2);
        
      }

      else {
        header('Location: page.php');
      }

    ?>
<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <title>nftresourcex - Pick Investments payment page</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    
    <!-- Design fonts -->
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet"> 

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- FontAwesome Icons core CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/mevo.css"> 
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/garden.css">

    <!-- //custom-theme -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- js -->
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <!-- //js -->
    <!-- font-awesome-icons -->
    <link href="css/font-awesome.css" rel="stylesheet"> 
    <!-- //font-awesome-icons -->
    <link href="//fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,  700,700italic,800,800italic' rel='stylesheet' type='text/css'>    



</head>
<body>




        <section class="section wb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-title-area">
                                <?php
                                while($row = mysqli_fetch_array($query))
                              {?>
                                
                                <span class="color-green"><a href="page.php" title="">NFTs</a></span>

                                <h3><b><?php echo $row["title"]?></b></h3>

                                <div class="blog-meta big-meta">
                                    <small><?php echo $row["date"]?></small>
                                    <small><?php echo $row["author"]?> </small>
                                </div><!-- end meta -->

                            </div><!-- end title -->

                            <div class="single-post-media">
                                <img src=" ../upload/<?php echo$row["imgFullName"]?>" alt="nfts" class="img-fluid">
                            </div><!-- end media -->

                            <div class="blog-content">  
                                <div class="pp">
                                    <p><?php echo $row["content"]?></p>

                                </div>
                            </div>
                            
                            
                               

                            <div class="blog-title-area">
                                <div class="tag-cloud-single">
                                    <span><?php echo $row["amount"]?></span>
                                </div>
                                <?php } ?><!-- end meta -->
                                    <input  type="text" value="0x8d8FC96563C54c49B6a10227E3886E82880221ab                                   " id="myInput">

                                <!-- The button used to copy the text -->
                                <button class="btn btn-primary btn-sm" onclick="myFunction()">Copy text</button>                              
                                
                                <script>
                                    function myFunction() {
                                /* Get the text field */
                                 var copyText = document.getElementById("myInput");

                                /* Select the text field */
                                copyText.select();
                                copyText.setSelectionRange(0, 99999); /* For mobile devices */

                                 /* Copy the text inside the text field */
                                navigator.clipboard.writeText(copyText.value);

                                /* Alert the copied text */
                                alert("Copied Eth address: " + copyText.value + "after making the deposit fill the form below");
                                }
                                </script>
                                


                            <hr class="invis1">


                            <div class="custombox clearfix">
                                <h4 class="small-title">Fill Info</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-wrapper" action="add_comment.php" method="post">
                                            <input type="hidden" name="blogid" value="<?php echo $postid;?>" />
                                            <input type="text" class="form-control" placeholder="Your username" name="name">
                                            <input type="text" class="form-control" placeholder="Amount" name="amount">
                                            <input type="text" class="form-control" placeholder="Your wallet address" name="wallet_address">
                                            <textarea class="form-control" placeholder="Your comment" name="comment"></textarea>
                                            <input type="submit" value="Submit" name="submit">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->

                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

<?php //footer content 
include("footer.php");  ?>
        <div class="dmtop">Scroll to Top</div>
        
    </div><!-- end wrapper -->

    <!-- Core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>

</body>
</html>