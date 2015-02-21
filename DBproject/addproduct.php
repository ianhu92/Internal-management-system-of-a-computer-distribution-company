<?php
    $pid=$_GET["pid"];
    $sid=$_GET["sid"];
    include 'conn.php';

    $sql="SELECT * FROM product NATURAL JOIN inventory WHERE productID =$pid AND number>0 AND storeID=$sid";

    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr id='".$row['productID']."'>";
        echo "<td class='productid'>".$row['productID']."</td>";
        echo "<td class='productname'>".$row['name']."</td>";
        //echo "<td class='price' id='price".$row['productID']."'>".$row['referenceUnitPrice']."</td>";
        echo "<td class='price'><input id='price".$row['productID']."' class=\"form-control input-sm col-sm-6\" name=\"price\" type=\"text\" value=\"".$row['referenceUnitPrice']."\" onchange=\"countoneitemtotalprice(".$row['productID'].")\"></td>";
        echo "<td id='inv".$row['productID']."'>".$row['number']."</td>";
        echo "<td class='num'><input id='number".$row['productID']."' class=\"form-control input-sm col-sm-6\" name=\"quantity\" type=\"text\" value=\"1\" onchange=\"checknum(".$row['productID'].")\"></td>";
        echo "<td id='totalprice".$row['productID']."'>".$row['referenceUnitPrice']."</td>";
        echo "<td><button class=\"btn btn-default\" type=\"button\" onclick=\"removeitem(".$row['productID'].")\">Remove</button></td>";
        echo "</tr>";
        //echo "<tr>";
    }


    mysqli_close($conn);
