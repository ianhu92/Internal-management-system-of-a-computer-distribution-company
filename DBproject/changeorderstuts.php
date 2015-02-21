<?php
    $oid=$_GET["oid"];
    $st =$_GET["st"];
    $yy =$_GET["y"];
    $mm =$_GET["m"];
    $dd =$_GET["d"];
    include 'conn.php';
    
    if($st == "pr"){
        $result = mysqli_query($conn, "SELECT amountShouldPay FROM orderpayment WHERE orderID=$oid");
        $row = mysqli_fetch_array($result);
        $shouldpay = $row['amountShouldPay'];
        mysqli_query($conn, "INSERT INTO orderpaymenttransaction VALUES(NULL,$oid,$shouldpay)");
        mysqli_query($conn, "UPDATE orders SET `status`=\"payment received\" WHERE orderID=$oid");
        mysqli_query($conn, "UPDATE orderpayment SET amountPaid = $shouldpay, status=\"finished\" WHERE orderID=$oid");
        echo 'Order Status:payment received';
    }
    else if($st == "ship") {
        $result = mysqli_query($conn, "INSERT INTO inventoryorder VALUES (NULL,$oid,'$yy/$mm/$dd','finished');");
        $result = mysqli_query($conn, "SELECT LAST_INSERT_ID() AS ID;");
        $row = mysqli_fetch_array($result);
        $inventoryOrderID = $row['ID'];
        $result = mysqli_query($conn, "SELECT productID, storeID,number FROM orderdetail NATURAL JOIN orders WHERE orderID=$oid");
        while($row = mysqli_fetch_array($result)) {
            $pid = $row['productID'];
            $sid = $row['storeID'];
            $num = $row['number'];  
            
            mysqli_query($conn, "INSERT INTO inventoryorderdetail VALUES(NULL,$inventoryOrderID,$pid,$sid,$num)");
            mysqli_autocommit($conn, FALSE);
            mysqli_query($conn, "START TRANSACTION;");
            $result = mysqli_query($conn, "SELECT * FROM inventory WHERE storeID=$sid AND productID=$pid FOR UPDATE;");
            $subrow = mysqli_fetch_array($result);
            $invnum = $subrow['number'];
            $num = $invnum - $num;
            if ($num < 0) {
                exit("<script> alert(\"Shipping failed, out of stock!\");window.location.href='checkorder.php';  </script>");
            }
            mysqli_query($conn, "UPDATE inventory SET number = $num WHERE storeID=$sid AND productID=$pid ;");
            if (!mysqli_commit($conn)) {
                exit("Transaction commit failed");
            }
            mysqli_autocommit($conn, TRUE);
        }
        
        mysqli_query($conn, "UPDATE `orders` SET `status`=\"shipping\" WHERE orderID=$oid");
        echo 'Order Status:shipping';
    }
    else if($st == "cancel") {
        
        mysqli_query($conn, "UPDATE `orders` SET `status`=\"cancel\" WHERE orderID=$oid");
        echo 'Order Status:calcelled';
    }
    mysqli_close($conn);