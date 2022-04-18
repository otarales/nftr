
<?php 

include_once "config.php";


  session_start();

  // If session variable is not set it will redirect to login page

  if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
      header('Location:../login.php');
    exit;

  }

  // $email = $_SESSION['email'];
  $author = $_POST['author'];
  $title = $_POST['title'];
  $content = $_POST['content'];

  


    // Add task to DB
    $sql = "INSERT INTO posts(author, title, content) VALUES ('$author', '$title', '$content')";

    mysqli_query($conn, $sql);
    header("Location: ../newp.php?succes");
      
        
?>



$stmt = mysqli_stmt_init($conn);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $rowCount = mysqli_num_rows($result);
            $setImageOrder = $rowCount + 1;

            $sql = "INSERT INTO posts (author, title, content, amount, imgFullName) VALUES (?, ?, ?, ?, ?);";
            mysqli_stmt_bind_param($stmt, "sssss", $author, $title, $content, $amount, $imageFullName);

            mysqli_stmt_execute($stmt);

            move_uploaded_file($fileTempName, $fileDestination);

            header("Location: ../newp.php?upload-success");