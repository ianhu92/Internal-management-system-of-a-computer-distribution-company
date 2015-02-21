<?php
    session_start();

    $pid = $_POST['pid'];
    $num = $_POST['invnum'];
    $sid = $_SESSION['sid'];
    include 'conn.php';
    mysqli_query($conn, "UPDATE inventory SET number = number + $num WHERE productID = $pid AND storeID = $sid");
    mysqli_close($conn);
    exit("<script> alert(\"Add success!\");window.location.href='storeProductListPage.php';  </script>");