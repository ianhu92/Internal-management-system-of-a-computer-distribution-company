<?php
    $pid=$_GET["pid"];
    $sid=$_GET["sid"];
    include 'conn.php';

    $sql="SELECT unitPrice, unitCost,number FROM orderdetail NATURAL JOIN orders NATURAL JOIN product WHERE productID=$pid AND storeID=$sid  ;";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $sales =0;
        $profit =0;
        while($row = mysqli_fetch_array($result)){
            $sales += $row['unitPrice'] * $row['number'];
            $profit += ($row['unitPrice'] -  $row['unitCost']) * $row['number'];
        }
        //$profit = $sales -  $row['unitCost'] * $row['num'];
        echo "<tr>";
        echo "<td class='col-md-5'>$sales</td>";
        echo "<td class='col-md-5'>$profit</td>";
        echo "</tr>";
    }
    else {
        echo 'No sales yet';
    }
        
    mysqli_close($conn);
