<?php
    session_start();

    if(!isset($_POST['submit'])){
        exit('Unauthorized Access!');
    }
    $employeeID = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    include('conn.php');
    $result = mysqli_query($conn, "SELECT userType FROM login WHERE employeeID = $employeeID AND password = '$password'");

    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['username'] = $employeeID;
        switch ($row['userType']) {
            case "salesman":
                $_SESSION['usertype']= "salesman";
                header("Location:salesmanPage.php");
                exit();
                break;
            case "store manager":
                $_SESSION['usertype']= "storemanager";
                header("Location:storeManagerPage.php");
                exit();
                break;
            case "region manager":
                $_SESSION['usertype']= "regionmanager";
                header("Location:regionManagerPage.php");
                exit();
                break;
        }
        
    }
    else {
        exit("<script> alert(\"Error username or password, please try again.\");window.location.href='login.php';  </script>");
    }