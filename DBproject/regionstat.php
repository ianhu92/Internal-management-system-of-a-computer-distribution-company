<?php
    include 'conn.php';
    $result = mysqli_query($conn, "SELECT *,sum(paymentAmount) as sales FROM orderpaymenttransaction NATURAL JOIN orders NATURAL JOIN store GROUP BY regionID ORDER BY sales DESC");
    if ($result) {
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td class='col-md-5'>".$row['regionID']."</td>";
            echo "<td class='col-md-5'>".$row['sales']."</td>";
            echo "</tr>";
        }
    }
    else {
        echo 'No sales yet';
    }
        
    mysqli_close($conn);