<?php

    $pname=$_GET["pname"];

    include 'conn.php';

    $sql="SELECT * FROM product WHERE name LIKE '%". $pname."%' OR productID LIKE '%". $pname."%';";

    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td class=\"col-sm-3\">".$row['productID']. "</td>";
        echo "<td class=\"col-sm-7\">".$row['name']. "</td>";
        echo "<td class=\"col-sm-2\"><button class=\"btn btn-default\" type=\"button\" data-dismiss=\"modal\" onclick=\"selectProduct(this)\">Select</button></td>";
        echo "</tr>";
    }

    echo "</table>";

    mysqli_close($conn);
