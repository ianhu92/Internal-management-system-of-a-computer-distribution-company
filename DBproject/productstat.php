<?php
    $pid=$_GET["pid"];
    $sid=$_GET["sid"];
    include 'conn.php';

    $sql="SELECT productID,customerID,name,sum(number) AS num FROM orderdetail NATURAL JOIN orders NATURAL JOIN customer WHERE productID=$pid AND storeID=$sid GROUP BY customerID DESC LIMIT 0,4;";
    $result = mysqli_query($conn, $sql);
    if ($result){
        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td class='col-md-5'>".$row['customerID']."</td>";
            echo "<td class='col-md-5'>".$row['name']."</td>";
            echo "<td class='col-md-5'>".$row['num']."</td>";
            echo "</tr>";
        }
    }
    else
        echo 'No one buy yet';

    mysqli_close($conn);
