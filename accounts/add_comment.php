<?php

if (isset($_POST["submit"])) {

    $blogid = $_POST['blogid'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $wallet_address = $_POST['wallet_address'];
    $comment = $_POST['comment'];

    require_once "../config.php";


	$sql = "INSERT INTO comments(name, amount, wallet_address, comment, blogid)
    VALUES ('$name','$amount','$wallet_address','$comment','$blogid')";

    mysqli_query($link, $sql);

    header("Location: nft-single.php??order-placed");

} else {
	header("Location: nft-single.php?error");
}
?>
