
<?php
if (isset($_POST['submit'])) {

  $newFileName = $_POST['filename'];
  if (empty($newFileName)) {
    $newFileName = 'gallary';
  } else {
    $newFileName = strtolower(str_replace(" ", "-", $newFileName));
  }
  $author = $_POST['author'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  $amount = $_POST['amount'];

  $file = $_FILES['file'];

  $fileName = $file['name'];
  $fileType = $file['type'];
  $fileTempName = $file['tmp_name'];
  $fileError = $file['error'];
  $fileSize = $file['size'];

  $fileExt = explode(".", $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array("jpg", "jpeg", "png");

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 200000) {
        $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
        $fileDestination = "../upload" . $imageFullName;

        include_once "function/config.php";

        if (empty($title) || empty($content)) {
          header('Location: newp.php?upload-empty');
          exit();
        } else {
          $sql = "SELECT * FROM posts ";
          
          $sql = "INSERT INTO posts(author, title, content, amount, imgFullName) VALUES ('$author', '$title', '$content',  '$amount', '$imageFullName')";

          mysqli_query($conn, $sql);

          move_uploaded_file($fileTempName, $fileDestination);

          header("Location: newp.php??upload-success");
          
        }
      } else {
        echo "file size is too big!";
        exit();
      }
    } else {
      echo "You had an error";
      exit();
    }
  } else {
    echo "you need to upload a proper file type!";
    exit();
  }


}
?>