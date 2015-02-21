<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <title>Region Manager Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/customize.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">    
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
        function showModal1(){
           $('#myModal1').modal('show');
        }
        </script>
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
                            <li><a href="addSalesmanPage.php"><i class="fa fa-btn "></i>Add employee</a></li>
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
                                        echo "<li><a href=\"#\" id='employeeID'>".$_SESSION['username']."</a></li>";
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
            $sql="SELECT * FROM region WHERE regionManagerID=$employeeID";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            
            $regionID = $row['regionID'];            
        ?>
        <!-- 显示Region的名字 -->
        <div class="col-sm-12 col-sm-offset-5"><h2><?php echo $row['name']?></h2></div>
        <?php
            $sql="SELECT * FROM employee WHERE employeeID=$employeeID";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
        ?>
        <!-- Region manager Panel -->
        <div class="col-md-4 col-md-offset-1" style="margin-top: 2%; padding-top:2%; padding-bottom:2%;">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Region Manager</strong></div>
                <div class="panel-body">
                    <div class="col-sm-6 col-sm-offset-3" align="center" style="margin-top: 2%;">
                        <h3><?php echo $row['firstName']." ". $row['lastName'];?></h3>
                        <h5><?php echo $employeeID;?></h5>
                    </div>
                    <div class="col-sm-6" style="margin-top: 5%">
                        <a class="btn btn-block btn-primary" href="customerList.php" style="color: #ffffff"><strong>View Customers</strong></a>
                        <!-- <a class="btn btn-block btn-primary" href="customerList.html" style="color: #ffffff"><strong>Sales Comparison</strong></a> -->
                    </div>
                    <div class="col-sm-6" style="margin-top: 5%">
                        <!-- <a class="btn btn-block btn-primary" href="customerList.html" style="color: #ffffff"><strong>View Customers</strong></a> -->
                        <a class="btn btn-block btn-primary" onclick="showModal1()" style="color: #ffffff"><strong>Sales Comparison</strong></a>
                    </div>
                </div>
            </div>
        </div>         
        
        <!-- Store Information Panel -->
        <div class="col-md-6" style="margin-top: 2%; padding-top:2%; padding-bottom:2%;">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Store Information</strong></div>
                <div class="panel-body">
                    <?php
                            $sql = "SELECT * FROM store WHERE regionID=$regionID";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_array($result)){
                            
                    ?>
                    <!-- store信息开始 -->
                    <div>
                        <div class="col-sm-5 col-sm-offset-1">
                            <h3><?php echo $row['name'];?></h3>
                            <address>
                                <?php echo $row['street'];?><br>
                                <?php echo $row['city'].$row['state'];?><br>
                                Store ID : <?php echo $row['storeID'];?><br>
                            </address>
                        </div>
                        <div class="col-sm-5 col-sm-offset-1" style="margin-top: 10%; margin-bottom: 8%" >                        
                            <a class="btn btn-block btn-primary" href=<?php echo "\"storeProductListPage.php?sid=".$row['storeID']."\""?> style="color: #ffffff"><strong>View Products & Inventory</strong></a>
                        </div>
                    </div>
                    <!-- store信息结束 -->


                            <?php }?>
                    
                </div>
            </div>
        </div>
        <!-- store information panel结束 -->
        
        <!-- Sales Comparation Modal -->
        <div class="modal fade large" id="myModal1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Region Sales Comparation</h4>
                    </div>
                    <div class="modal-body" align="center">
                        <div class="col-md-10 col-md-offset-1" style="margin-top: 5%">
                            <div class="panel panel-default">
                            <!-- <div class="panel-heading" style="color: #0099CC" align="left">
                                <strong>Business Buying Most</strong>
                            </div> -->
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="col-md-4">Region</th>
                                        <th class="col-md-4">Sales Profits</th>    
                                    </tr>
                                    <?php
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
                                    ?>
                                </table>
                            </div>
                        </div>                
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>    