<?php
    $conn = new mysqli("localhost", "infsci2710", "infsci2710", "infsci2710");
    if ($conn->connect_errno) {
        echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
    }
    /*
    if($_SESSION['username'] != NULL){
        $id = $_SESSION['username'];
        $result = mysqli_query($conn, "SELECT password FROM login WHERE employeeID = $id");
        $row = mysqli_fetch_array($result);
        $password = $row['password'];
        $conn = new mysqli("localhost", "$id", "$password", "infsci2710");
    }
?>
     * 
     */