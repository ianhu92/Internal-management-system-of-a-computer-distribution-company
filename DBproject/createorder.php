<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create Order Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/customize.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">    
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/findeverything.js"></script>
        <script src="js/addProduct.js"></script>
        <script src="js/createOrder.js"></script>
        <script>
        // 显示模态框
        function showModal1(){
            
           $('#myModal1').modal('show');
        }
        function showModal2(){
           $('#myModal2').modal('show');
        }
        
        function selectCustomer(Btn){
            
            var customerId = Btn.parentNode.parentNode.firstChild.innerHTML;
            document.getElementById("customer").value = customerId;
        }
        
        function selectProduct(Btn){
            
            var productId = Btn.parentNode.parentNode.firstChild.innerHTML;
            document.getElementById("product").value = productId;
        }
       
        </script>
        <script>
            var newdate = new Date();
            var day = newdate.getDate();
            var month = newdate.getMonth()+1;
            var year = newdate.getFullYear();
            $( document ).ready(function() {
                $("#date").text(year+'/'+month+'/'+day);
            })
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
                        <a class="navbar-brand" href="index.php">Dell</a>
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
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">For Home<span class="caret"></span></a>
                              <ul class="dropdown-menu" style="color: #0099CC !important;" role="menu">
                                  <li><a href="search.php?type=home&cate=laptop&keyword=" style="color: #000000 !important;">Laptops</a></li>
                                <li class="divider"></li>
                                <li><a href="search.php?type=home&cate=PC&keyword=" style="color: #000000 !important;">PC</a></li>
                                <li class="divider"></li>
                                <li><a href="search.php?type=home&cate=accessory&keyword=" style="color: #000000 !important;">Accessories</a></li>
                              </ul>
                            </li>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">For Work<span class="caret"></span></a>
                              <ul class="dropdown-menu" style="color: #0099CC;" role="menu">
                                <li><a href="search.php?type=work&cate=laptop&keyword=" style="color: #000000 !important;">Laptops</a></li>
                                <li class="divider"></li>
                                <li><a href="search.php?type=work&cate=PC&keyword=" style="color: #000000 !important;">PC</a></li>
                                <li class="divider"></li>
                                <li><a href="search.php?type=work&cate=accessory&keyword=" style="color: #000000 !important;">Accessories</a></li>
                              </ul>
                            </li>
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
                                        echo "<li><a href=\"#\" id='employeeID'>".$_SESSION['username']."</a></li>";
                                    }
                            ?>
                            <li><a href="logout.php"><i class="fa fa-btn "></i>Logout</a></li>    
                        </ul>
                    
                </div>
            </div>
        </nav>
        <div class="col-sm-8 col-sm-offset-2" style="margin-top: 3%; padding-top:2%; padding-bottom:2%;">
                <div class="panel panel-default">
                        <div class="panel-heading">Order</div>
                        <div class="panel-body">
                            <div class="col-sm-2 order" >Order Date: </div>
                            <div class="col-sm-2 order" id="date"></div>
                            <div class="col-sm-3 order">Salesman: 
                            <?php
                                include 'conn.php';
                                $sql = "SELECT * FROM employee NATURAL JOIN storeEmployee WHERE employeeID='". $_SESSION['username']."'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result);
                                $storeID = $row['assignedStoreID'];
                                echo $row['firstName']." ".$row['lastName'];
                            ?>
                            </div>
                                   
                            <div class="col-sm-6 order" style="margin-top: 5%">
                                <form class="form-horizontal" id="form1" role="form1">
                                    <div  class="form-group">
                                        <label for="customer" class="col-md-3 control-label">Customer:</label>
                                        <div class="col-md-5">
                                            <input class="form-control input-sm" name="product" id="customer" placeholder="Choose Customer" type="text"  onfocus="showModal1()" value="">
                                        </div>
                                    </div>
                                    <div id="productDiv">

                                        <!-- <div class="form-group" id="addedText">
                                            <label for="product" class="col-md-3 control-label">Product:</label>
                                            <div class="col-md-5">
                                                <input class="form-control input-sm" name="" id="product" placeholder="Choose Product" type="text"  onfocus="showModal()" value="">
                                            </div>
                                        </div>     -->
                                        
                                        <div  class="form-group">
                                            <label for="product" class="col-md-3 control-label">Product:</label>
                                            <div class="col-md-5">
                                                <input class="form-control input-sm" name="" id="product" placeholder="Choose Product" type="text"  onfocus="showModal2()" value="">
                                            </div>
                                            <div class="col-sm-3">
                                                
                                                <button class="btn btn-small btn-primary" type="button" onclick="addProduct(<?php echo $storeID;?>)">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div> 
                            <div class="col-sm-12">
                                <table class="table table-bordered" id="orderproduct">
                                    <tr>
                                        <th class="col-sm-2">Product Id</th>
                                        <th class="col-sm-4">Product Name</th>
                                        <th class="col-sm-2">Unit Price</th>
                                        <th class="col-sm-1">Inventory</th>
                                        <th class="col-sm-1">Quantity</th>
                                        <th class="col-sm-1">Price</th>
                                        <th class="col-sm-1"></th>
                                    </tr>               
                                    
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-2 col-sm-offset-8" align="right"><strong>Total price:</strong></div>
                                <div class="col-sm-1" id="totalprice">0</div>
                                    
                            </div>  
                            <div class="col-sm-12">
                                <div class="submit col-sm-3 col-sm-offset-8">    
                                    <button type="submit" class="btn btn-block btn-primary" id="placeorder" ><strong>Place Order</strong></button>
                                </div>
                            </div>      

                <!-- 模态框 -->
                        <div class="modal fade large" id="myModal1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Customer List</h4>
                                    </div>
                                    <div class="modal-body" align="center">
                                        <div>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <form>
                                                <div class="input-group">
                                                  <input type="text" class="form-control" placeholder="Input Customer Name" onBlur="showCustomer(this.value)">
                                                  
                                                </div>
                                            </form>
                                        </div>    


                                        <div class="col-sm-10 col-sm-offset-1" style="margin-top: 5%">
                                            <table class="table table-bordered" id="customerList" style="margin-top: 5%">
                                                
                                                
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
                    
                    

                    <div class="modal fade large" id="myModal2">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Product List</h4>
                                    </div>
                                    <div class="modal-body" align="center">
                                        <div>
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <form>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="Input Product Name"  onkeyup="showProduct(this.value)">
                                                      <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button">Search Product</button>
                                                      </span>
                                                    </div>
                                                </form>
                                            </div>    

                                            <div class="col-sm-10 col-sm-offset-1" style="margin-top: 5%">
                                                <table class="table table-bordered" id="productList" style="margin-top: 5%">

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
                </div>    
            </div>        
        </div>    
    </body>
</html>          