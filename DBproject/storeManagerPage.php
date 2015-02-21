<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <title>storeManager Page</title>
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
            $employeeID = $_SESSION['username'];
            $sql="SELECT * FROM storeemployee WHERE employeeID=$employeeID ";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($result);
            $storeID = $row['assignedStoreID'];
            
            $sql="SELECT * FROM store WHERE storeID=$storeID ";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($result);
            
        ?>
        <div class="col-md-8 col-md-offset-2" style="margin-top: 3%; padding-top:2%; padding-bottom:2%;">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Store Information</strong></div>
                <div class="panel-body">
                    <div class="col-sm-4 col-sm-offset-2">
                        <h3><?php echo $row['name'];?></h3>
                        <address>
                            <?php echo $row['street'];?><br>
                            <?php echo $row['city'];?>,<?php echo $row['state']." ".$row['zipcode'];?><br>
                            
                        </address>
                    </div>
                    <?php
                        $sql="SELECT * FROM employee WHERE employeeID=$employeeID ";
                        $result2=mysqli_query($conn,$sql);
                        $row2=mysqli_fetch_array($result2);
                        
                    ?>
                    <div class="col-sm-5 col-sm-offset-1">
                        <h3>Manager</h3>
                        <p><?php echo $row2['firstName']." ".$row2['lastName'];?></p>
                        <p>Employee ID</p>
                        <p><?php echo $employeeID;?></p>
                    </div>
                    <div class="col-sm-8 col-sm-offset-2" style="margin-top: 5%">
                        <div class="col-sm-5" >
                            <a class="btn btn-block btn-primary" href="customerList.php" style="color: #ffffff"><strong>See Customers</strong></a>
                        </div>
                        <div class="col-sm-6 col-sm-offset-1" >                        
                            <a class="btn btn-block btn-primary" href="storeProductListPage.php" style="color: #ffffff"><strong>See Products & Inventory</strong></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>         

    </body>
</html>    