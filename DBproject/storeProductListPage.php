<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <title>storeProductList Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/customize.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">    
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/productstatistics.js"></script>
        <script>
        $(document).ready(function(){
              $(".close").click(function(){
                $("#topcustomer tr td").remove();
              });
              $(".modal-footer #close").click(function(){
                $("#topcustomer tr td").remove();
              });
            });
        function showModal1(pid,sid){
           $('#myModal1').modal('show');
           productstat(pid,sid);
           profitstat(pid,sid);
        }
        
        function showModal2(sid){
           $('#myModal2').modal('show');
           topcate(sid);
           
        }
        
        function showModal3(sid){
           $('#myModal3').modal('show');
           topprod(sid);
        }
        
        function showModal4(pid,sid){
           $('#myModal4').modal('show');
           $('#pid').val(pid);
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

                    
                    <div  style="margin-left: 24% !important;">
                        <ul class="nav navbar-nav navbar-default navbar-center">
                            <li><a href="storeManagerPage.php"><i class="fa fa-btn "></i>Homepage</a></li>
                            
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Order<span class="caret"></span></a>
                              <ul class="dropdown-menu" style="color: #0099CC;" role="menu">
                                <li><a href="#" style="color: #000000 !important;">Create Order</a></li>
                                <li class="divider"></li>
                                <li><a href="#" style="color: #000000 !important;">Check Order</a></li>
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
                                        echo "<li><a href=\"#\" id='employeeID'>".$_SESSION['username']."</a></li>";
                                    }
                           
                            include 'conn.php';
                            if ($_SESSION['usertype'] == "salesman") {
                                echo "Sorry! salesman cannnot check this page";
                                exit();
                            }
                            elseif ($_SESSION['usertype'] == "storemanager") {
                                $employeeID = $_SESSION['username'];
                                $sql1="SELECT * FROM storeemployee WHERE employeeID=$employeeID ";
                                $result1=mysqli_query($conn,$sql1);
                                $row1=mysqli_fetch_array($result1);
                                $storeID = $row1['assignedStoreID'];
                                $_SESSION['sid'] = $storeID;
                            }
                            if ($_SESSION['usertype'] == "regionmanager"){
                                $storeID=$_GET["sid"];
                                $_SESSION['sid'] = $storeID;
                            }
                                $sql="SELECT * FROM product NATURAL JOIN inventory WHERE storeID=$storeID";
                                $result=mysqli_query($conn,$sql);
                            ?>
                            <li><a href="logout.php"><i class="fa fa-btn "></i>Logout</a></li>
                        </ul>
                    
                </div>
            </div>
        </nav>

        <div class="dropdown col-md-8 col-md-offset-4" style="margin-top: 3%;">
            <button type="button" class="btn btn-primary" onclick="showModal2(<?php echo $storeID;?>)">
                <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Top Category
            </button>
            <button type="button" class="btn btn-primary col-md-offset-1" onclick="showModal3(<?php echo $storeID;?>)">
                <span class="glyphicon glyphicon-star" aria-hidden="true"></span> Top Product
            </button>
        </div>    


        <div class="col-md-10 col-md-offset-1" style="margin-top: 1%; padding-top:2%; padding-bottom:2%;">
            <div class="panel panel-default">
                <div class="panel-heading" style="color: #0099CC"><strong>Product List</strong></div>
                <table class="table table-bordered" align="center">
                        <tr style="font-weight: bold !important;">
                            <th class="col-sm-1">ID</th>
                            <th class="col-sm-3">Product</th>
                            <th class="col-sm-2">Series</th>
                            <th class="col-sm-2">Category</th> 
                            <th class="col-sm-1">Price</th>
                            <th class="col-sm-1">Storage</th>
                            <th class="col-sm-1">Statistics</th>
                            
                        </tr>
                        <?php
                            
                                while($row=mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['productID']?></td>
                            <td><?php echo $row['name']?></td>
                            <td><?php echo $row['series']?></td>
                            <td><?php echo $row['category']?></td>
                            <td><?php echo $row['referenceUnitPrice']?></td>
                            <td><?php echo $row['number']?><a class="btn btn-small btn-default pull-right" <?php echo "onclick=\"showModal4(".$row['productID'].",$storeID)\"" ?> style="color: #000000">Add</a></td>
                            <td align="center"><a class="btn btn-small btn-default" <?php echo "onclick=\"showModal1(".$row['productID'].",$storeID)\"" ?> style="color: #000000">View</a></td>
                        </tr>
                        <?php
                                }
                        ?>
                    </table>
            </div>
        </div>
        

        <!-- product statistic modal -->
        <div class="modal fade large" id="myModal1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Product Statistic</h4>
                    </div>
                    <div class="modal-body" align="center">
                        <div class="col-md-10 col-md-offset-1" style="margin-top: 5%">
                            <div class="panel panel-default">
                            <div class="panel-heading" style="color: #0099CC" align="left">
                                <strong>Top 5 customer</strong>
                            </div>
                                <table id='topcustomer' class="table table-bordered">
                                    <tr>
                                        <th class="col-md-5">ID</th>
                                        <th class="col-md-5">Customer Name</th>
                                        <th class="col-md-5">Number</th>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1" style="margin-top: 5%">
                            <div class="panel panel-default">
                            <div class="panel-heading" style="color: #0099CC" align="left">
                                <strong>Sales & Profits</strong>
                            </div>
                                <table id='saleprofit' class="table table-bordered">
                                    <tr>
                                        <th class="col-md-5">Sales</th>
                                        <th class="col-md-5">Profits</th>
                                    </tr>                                    
                                </table>
                            </div>
                        </div>                
                    </div>    
                    <div class="modal-footer">
                        <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Top Product Category Modal -->
        <div class="modal fade large" id="myModal2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Top Product Category</h4>
                    </div>
                    <div class="modal-body" align="center">
                        <div class="col-md-6 col-md-offset-3" style="margin-top: 5%">
                            <div class="panel panel-default">
                            <!-- <div class="panel-heading" style="color: #0099CC" align="left">
                                <strong>Business Buying Most</strong>
                            </div> -->
                            <table id="topcate"class="table table-bordered">
                                    <tr>
                                        <th class="col-md-3">Category</th>
                                        <th class="col-md-3">Type</th> 
                                        <th class="col-md-3">Sales</th>
                                    </tr>
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
        
        <!-- Top Product Modal -->
        <div class="modal fade large" id="myModal3">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Top Product</h4>
                    </div>
                    <div class="modal-body" align="center">
                        <div class="col-md-6 col-md-offset-3" style="margin-top: 5%">
                            <div class="panel panel-default">
                            <!-- <div class="panel-heading" style="color: #0099CC" align="left">
                                <strong>Business Buying Most</strong>
                            </div> -->
                            <table id="topprod" class="table table-bordered">
                                    <tr>
                                        <th class="col-md-5">Product</th>
                                        <th class="col-md-5">Sales</th>
                                    </tr>
                                    
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
        
        
        <div class="modal fade large" id="myModal4">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal ng-pristine ng-valid" role="form" method="POST" action="addinv.php">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">New Inventory</h4>
                    </div>
                    <div class="modal-body" align="center">
                        <div class="col-sm-10 col-sm-offset-1" style="margin-top: 10%; margin-bottom:15%">
                            
                                <div class="input-group">
                                    <input type="text" class="form-control" name="invnum" placeholder="Input number" value="">
                                  <input id="pid" type="hidden" class="form-control" name="pid" value="">
                                </div>
                        </div>   
                    </div>    
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Add Inventory</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        
    </body>
</html>        