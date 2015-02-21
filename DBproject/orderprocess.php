<?php
    if($_POST){
        $data = $_POST['data'];//这里获取的直接就是数组了，不需要用到json_decode
        $rownum = $data['countrow'];
        $orderdate = $data['orderdate'];
        $employeeID = $data['employeeID'];
        $customerID = $data['customerID'];
        $totalprice = 0;
        include 'conn.php';

        $getstoreid = "SELECT * FROM storeemployee WHERE employeeID=$employeeID";
        $resultgetstoreid = mysqli_query($conn, $getstoreid);
        $row = mysqli_fetch_array($resultgetstoreid);
        $storeID = $row['assignedStoreID'];
        

        
        for ($i = 1; $i <= $rownum; $i++) {
            $productID = $data['pid'.$i];
            $num = $data['num'.$i];
            
            mysqli_autocommit($conn, FALSE);
            mysqli_query($conn, "START TRANSACTION;");
            $sql = "SELECT number FROM inventory WHERE productID=$productID AND storeID=$storeID limit 0,100 lock in share mode;";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $invnum = $row['number'];
            if($invnum < $num) {
                exit("Create order failed!Please check inventory.");
            }
            if (!mysqli_commit($conn)) {
                exit("Transaction commit failed");
            }
            mysqli_autocommit($conn, TRUE);
        }
        
        mysqli_query($conn, "INSERT INTO `orders` VALUES (NULL,$customerID,$employeeID,$storeID,\"$orderdate\",DEFAULT)");
        $getorderid = "SELECT * FROM orders WHERE salesmanID=$employeeID AND customerID=$customerID ORDER BY orderID DESC";
        $resultgetorderid = mysqli_query($conn, $getorderid);
        $roworderID = mysqli_fetch_array($resultgetorderid);
        $orderID = $roworderID['orderID'];
        
        for ($index = 1; $index <= $rownum; $index++) {
            $productID = $data['pid'.$index];
            $num = $data['num'.$index];
            $price = $data['price'.$index];
            $totalprice += $num * $price;
                  
            mysqli_query($conn, "INSERT INTO `orderDetail` VALUES (NULL,$orderID,$productID,$num,$price)");
        }
        mysqli_query($conn, "INSERT INTO orderpayment VALUES ($orderID,$totalprice,0,DEFAULT)");

        exit("Create order success!");
    }