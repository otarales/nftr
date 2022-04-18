<?php

if (count($_POST)>0) {
    $id = $_POST['id'];
    $justdeposit = $_POST['justdeposit'];
    $endprofit = $_POST['endprofit'];
    $totaldeposit = $_POST['totaldeposit'];
    $nftbought = $_POST['nftbought'];
    $per = $_POST['per'];

    require_once "functions/config.php";


    mysqli_query($conn,"UPDATE users set id='" . $_POST['id'] . "', justdeposit='" . $_POST['justdeposit'] . "', endprofit='" . $_POST['endprofit'] . "', totaldeposit='" . $_POST['totaldeposit'] . "' ,nftbought='" . $_POST['nftbought'] . "', per='" . $_POST['per'] . "' , WHERE id='" . $_POST['id'] . "'");


    header("Location: client-detail.php??order-successful");

} else {
	header("Location: client-detail.php?error");
}
?>