<?php
    $sid=$_GET["sid"];
    include 'conn.php';

    $sql="SELECT category,productType,sum(number) AS num FROM orderdetail NATURAL JOIN orders NATURAL JOIN product WHERE storeID=$sid GROUP BY category,productType ORDER BY num DESC";
    $result = mysqli_query($conn, $sql);
    if ($result) {
    while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td class='col-md-5'>".$row['category']."</td>";
            echo "<td class='col-md-5'>For ".$row['productType']."</td>";
            echo "<td class='col-md-5'>".$row['num']."</td>";
            echo "</tr>";
        }
    }
    else {
        echo "<tr>";
        echo "<td class='col-md-5'>Sales amount</td>";
        echo "<td class='col-md-5'>not enough</td>";
        echo "</tr>";
    }


    mysqli_close($conn);
