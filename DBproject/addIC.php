<?php
    $cname = $_POST['name'];
    if ($_POST['gender'] == 1) {
        $gender = "male";
    }
    else {
        $gender = "female";
    }
    switch ($_POST['marriagest']){
        case 1:$marriagest = "Single"; break;
        case 2:$marriagest = "Common-Law"; break;
        case 3:$marriagest = "Married"; break;
        case 4:$marriagest = "Divorced"; break;
    }
    $age = $_POST['age'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $annualincome = $_POST['annualincome'];
    echo $gender;

    include('conn.php');
    mysqli_query($conn, "INSERT INTO customer VALUES (NULL, '$cname', '$street', '$city', '$state', '$zipcode','individual')");
    $result = mysqli_query($conn, "SELECT LAST_INSERT_ID() AS customerID;");
    $row = mysqli_fetch_array($result);
    $customerID = $row['customerID'];
    mysqli_query($conn, "INSERT INTO individualcustomer VALUES ($customerID, '$gender', $age,$annualincome,'$marriagest')");

    mysqli_close($conn);
    exit("<script> alert(\"Add success!\");window.location.href='customerList.php';  </script>");