<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <title>customerList Page</title>
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
                    </ul>
                    <div  style="margin-left: 24% !important;">
                        <ul class="nav navbar-nav navbar-default navbar-center">
                            <li><a href="storeManagerPage.php"><i class="fa fa-btn "></i>Homepage</a></li>
                            
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

        <!-- 选择客户类型 -->
        <div class="col-md-10 col-md-offset-1" style="margin-top: 3%;">
            <div class="dropdown col-md-3">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                    Customer Category
                <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Individual Customer</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="businessCustomerListPage.php">Business Customer</a></li>
                  </ul>    
            </div>    
            
            <!-- 加客户 -->
            <div class="col-md-2 col-md-offset-7">    
                <a href="addIndividualCustomerPage.php" class="btn btn-block btn-primary">Add Customer</a> 
            </div>
        </div>
        
        <!-- 客户列表 -->
        <div class="col-md-10 col-md-offset-1" style="margin-top: 1%; padding-top:2%; padding-bottom:2%;">
            <div class="panel panel-default">
                <div class="panel-heading" style="color: #0099CC"><strong>Individual Customer List</strong></div>
                <table class="table table-bordered" align="center">
                        <tr style="font-weight: bold !important;">
                            <th class="col-sm-1">ID</th>
                            <th class="col-sm-2">Full Name</th>
                            <th class="col-sm-2">Street</th>
                            <th class="col-sm-2">City</th> 
                            <th class="col-sm-1">State</th>
                            <th class="col-sm-1">Zipcode</th>
                            <th class="col-sm-2">Order History</th>       
                        </tr>
                        <?php
                            include 'conn.php';
                            $Page_size=100;
                            $result1=mysqli_query($conn,"SELECT * FROM customer WHERE customerType='individual'");
                            $count = mysqli_num_rows($result1);
                            $page_count = ceil($count/$Page_size);

                            $init=1;
                            $page_len=7;
                            $max_p=$page_count;
                            $pages=$page_count;

                            //判断当前页码
                            if(empty($_GET['page'])||$_GET['page']<0){
                            $page=1;
                            }else {
                            $page=$_GET['page'];
                            }

                            $offset=$Page_size*($page-1);
                            $sql="SELECT * FROM customer WHERE customerType='individual'  LIMIT $offset,$Page_size";
                            $result=mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['customerID']?></td>
                            <td><?php echo $row['name']?></td>
                            <td><?php echo $row['street']?></td>
                            <td><?php echo $row['city']?></td>
                            <td><?php echo $row['state']?></td>
                            <td><?php echo $row['zipcode']?></td>
                            <td align="center"><a class="btn btn-small btn-default" <?php echo "href=\"customerOrderList.php?customerID=".$row['customerID']."\"" ?> style="color: #000000">View Orders</a></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
            </div>
        </div>
        <?php            
            
            $page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数
            $pageoffset = ($page_len-1)/2;//页码个数左右偏移量

            $key='<div class="col-sm-offset-5" style=""><nav><ul class="pagination">';
            $key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=1\"><span aria-hidden=\"true\">&laquo;</span><span class=\"sr-only\">Previous</span></a></li>";
            if($pages>$page_len){
            //如果当前页小于等于左偏移
                if($page<=$pageoffset){
                    $init=1;
                    $max_p = $page_len;
                }else{//如果当前页大于左偏移
                //如果当前页码右偏移超出最大分页数
                    if($page+$pageoffset>=$pages+1){
                        $init = $pages-$page_len+1;
                    }else{
                    //左右偏移都存在时的计算
                    $init = $page-$pageoffset;
                    $max_p = $page+$pageoffset;
                    }
                }
            }
            for($i=$init;$i<=$max_p;$i++){
                $key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a></li>";
            }
            $key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=$page_count\"><span aria-hidden=\"true\">&raquo;</span><span class=\"sr-only\">Next</span></a></li> ";//下一页
            $key.='</ul></nav></div>';

            ?>
        <div class="col-sm-10 col-sm-offset-1">
            <?php echo $key?>
        </div>
    </body>
</html>        