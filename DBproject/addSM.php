<?php
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $storeassigned = $_POST['storeassigned'];
    $age = $_POST['age'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
    
    include('conn.php');
    mysqli_query($conn, "INSERT INTO employee VALUES (NULL, '$fname', '$lname', 'salesman','$street', '$city', '$state', '$zipcode','$email',$salary)");
    $result = mysqli_query($conn, "SELECT LAST_INSERT_ID() AS employeeID;");
    $row = mysqli_fetch_array($result);
    $employeeID = $row['employeeID'];
    mysqli_query($conn, "INSERT INTO login VALUES ($employeeID, $employeeID,'salesman')");
    mysqli_query($conn, "INSERT INTO storeemployee VALUES ($employeeID, $storeassigned)");
    mysqli_query($conn, "UPDATE store SET salesmanNumber = salesmanNumber+1 WHERE storeID = $storeassigned)");
    mysqli_close($conn);
    exit("<script> alert(\"Add success! New employee ID: $employeeID\");window.location.href='regionManagerPage.php';  </script>");