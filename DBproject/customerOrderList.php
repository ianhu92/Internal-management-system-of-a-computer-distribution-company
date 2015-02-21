<?php session_start();
    $customerID = $_GET['customerID'];

?>
<!DOCTYPE html>
<html>
    <head>
        <title>customerOrderList Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/customize.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">    
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div style="margin-left: 180px !important;">
                        <a class="navbar-brand" href="#">Dell</a>
                    </div>   
                </div>

                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <!-- Server Dropdown -->
                    </ul>

                    <!-- User Dropdown -->
                    <div  style="margin-left: 24% !important;">
                        <ul class="nav navbar-nav navbar-default navbar-center">
                            <li><a href="storeManagerPage.php"><i class="fa fa-btn "></i>Homepage</a></li>
                            <li><a href="customerList.php"><i class="fa fa-btn "></i>Customer List</a></li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Order<span class="caret"></span></a>
                              <ul class="dropdown-menu" style="color: #0099CC;" role="menu">
                                <li><a href="createorder.php" style="color: #000000 !important;">Create Order</a></li>
                                <li class="divider"></li>
                                <li><a href="checkorder.php" style="color: #000000 !important;">Check Order</a></li>
                              </ul>
                            </li>    
                        </ul>
                    </div>          
                        
                        <ul class="nav navbar-nav navbar-default navbar-right">
                            <?php
                                if(!isset($_SESSION['username'])){
                            ?>  
                            <li><a href="#"><i class="fa fa-btn "></i>Username</a></li>
                            <?php
                                }
                                else {
                                    echo "<li><a href=\"#\"><i class=\"fa fa-btn\"></i>".$_SESSION['username']."</a></li>";
                                }
                            ?>
                            <li><a href="logout.php"><i class="fa fa-btn "></i>Logout</a></li>
                        </ul>
                    
                </div>
            </div>
        </nav>
        <?php
            include 'conn.php';
            $sql="SELECT * FROM orders WHERE customerID=$customerID ORDER BY orderID DESC";// LIMIT $offset,$Page_size";
            $result=mysqli_query($conn,$sql);
            while ($row=mysqli_fetch_array($result)) {
                $totalprice=0;
        ?> 
        <div class="col-sm-8 col-sm-offset-2" style="margin-top: 3%; padding-top:2%; padding-bottom:2%; background-color: #E8E8E8;">
                <div class="col-sm-2 order">Date:<?php echo $row['date']?></div>
                <div class="col-sm-3 order">Order ID:<?php echo $row['orderID']?></div>
                <div class="col-sm-3 order">Customer ID:<?php echo $row['customerID']?></div>        
                <div class="col-sm-3 order">Order Status:<?php echo $row['status']?></div> 

                <div class="col-sm-12" style="margin-top: 2%; padding-top: 2%; background-color:#ffffff">    
                    <table class="table table-bordered">
                        <tr style="font-weight: bold !important;">
                            <th class="col-sm-4">Product Name</th>
                            <th class="col-sm-1">Unit Price</th>
                            <th class="col-sm-1">Quantity</th>
                            <th class="col-sm-1">Price</th>        
                        </tr>
                        <?php 
                            $oid = $row['orderID'] ;
                            $subsql="SELECT * FROM orderdetail WHERE orderID=$oid";
                            $subresult=mysqli_query($conn,$subsql);
                            while ($subrow = mysqli_fetch_array($subresult)) {
                                $pid = $subrow['productID'];
                                $num = $subrow['number']; 
                                $price = $subrow['unitPrice'];
                                $subsql2="SELECT * FROM product WHERE productID=$pid";
                                $subresult2=mysqli_query($conn,$subsql2);
                                $subrow2 = mysqli_fetch_array($subresult2);
                        ?>
                        <tr>
                            <td class="col-sm-4"><?php echo $subrow2['name'];?></td>
                            <td class="col-sm-1"><?php echo $price;?></td>
                            <td class="col-sm-1"><?php echo $num;?></td>
                            <td class="col-sm-1"><?php echo $price*$num; $totalprice += $price*$num;?></td>                      
                        </tr>
                        <?php                                                           
                            }
                        ?>
                    </table>
                </div> 
                
                    <div class="col-sm-2 col-sm-offset-8 order" style="margin-top: 2%; margin-left: 68.5%;">Total price</div> 
                    <div class="col-sm-1 order" style="margin-top: 2%;"><?php echo $totalprice;?></div>   
                
        </div>
        <?php
            }
        ?>

   </body>
</html>           