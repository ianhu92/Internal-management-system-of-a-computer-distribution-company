<?php
    $cname = $_POST['name'];
    $category = $_POST['category'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $annualincome = $_POST['annualincome'];
    
    include('conn.php');
    mysqli_query($conn, "INSERT INTO customer VALUES (NULL, '$cname', '$street', '$city', '$state', '$zipcode','business')");
    $result = mysqli_query($conn, "SELECT LAST_INSERT_ID() AS customerID;");
    $row = mysqli_fetch_array($result);
    $customerID = $row['customerID'];
    mysqli_query($conn, "INSERT INTO businesscustomer VALUES ($customerID, '$category', $annualincome)");

    mysqli_close($conn);
    exit("<script> alert(\"Add success!\");window.location.href='businessCustomerListPage.php';  </script>");