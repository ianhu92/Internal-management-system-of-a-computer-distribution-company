<?php

    $cname=$_GET["cname"];

    include 'conn.php';

    if (!$conn)
     {
        die('Could not connect: ' . mysql_error());
     }

    $sql="SELECT * FROM customer WHERE name LIKE '%$cname' LIMIT 200;";

    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_array($result))
    {
        
        echo "<tr>";
        echo "<td class=\"col-sm-5\">".$row['customerID']. "</td>";
        echo "<td class=\"col-sm-5\">".$row['name']. "</td>";
        echo "<td class=\"col-sm-2\"><button class=\"btn btn-default\" type=\"button\" data-dismiss=\"modal\" onclick=\"selectCustomer(this)\">Select</button></td>";
        echo "</tr>";
        
    }

    echo "</table>";

    mysqli_close($conn);