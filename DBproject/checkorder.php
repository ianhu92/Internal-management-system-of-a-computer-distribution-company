<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <title>CheckOrder Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/customize.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">    
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>

            function chngodst(oid,st) {
                var newdate = new Date();
                var day = newdate.getDate();
                var month = newdate.getMonth()+1;
                var year = newdate.getFullYear();

                var xmlHttp = new XMLHttpRequest();
                if (xmlHttp==null)
                 {
                     alert("Browser does not support HTTP Request");
                     return;
                 }
                var url="changeorderstuts.php";
                url=url+"?oid="+oid+"&st="+st+"&y="+year+"&m="+month+"&d="+day;
                xmlHttp.onreadystatechange=function()
                {
                    stateChange(xmlHttp,"os"+oid);
                    $("#"+st+oid).remove();
                };
                xmlHttp.open("GET",url,true);
                xmlHttp.send(null);
                
                //if
                alert("Change Success!");
                location.reload();
            }
            
            function stateChange(xmlhttp, div)
            { 
                if (xmlhttp.readyState==4 || xmlhttp.readyState=="complete")
                { 
                    $("#"+div).empty();
                    $("#"+div).append(xmlhttp.responseText);
                } 
            }
            
        </script>
        
    </head>
    <body>
        <?php
            include 'conn.php';
            $username = $_SESSION['username'];

            $Page_size=8;
            $result1=mysqli_query($conn,"SELECT * FROM orders  WHERE salesmanID=$username ");
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
     
        ?>
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
        <div class="col-sm-6 col-sm-offset-2">
            <form>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Input Order Number">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Search Order</button>
                  </span>
                </div><!-- /input-group -->
            </form>
        </div>

        <?php
            $sql="SELECT * FROM orders  WHERE salesmanID=$username ORDER BY orderID DESC LIMIT $offset,$Page_size";
            $result=mysqli_query($conn,$sql);
            while ($row=mysqli_fetch_array($result)) {
                $totalprice=0;             
        ?>
        <script>
            function butclickchange(oid,st){
                $("#bt"+oid).removeAttr("onclick");
                $("#bt"+oid).attr("onclick","chngodst("+oid+",'"+st+"')");
            }
        </script>
        <div class="col-sm-8 col-sm-offset-2" style="margin-top: 3%; padding-top:2%; padding-bottom:2%; background-color: #E8E8E8;">
                <div class="col-sm-3 order">Date:<?php echo $row['date']?></div>
                <div class="col-sm-3 order">Order ID:<?php echo $row['orderID']?></div>
                <div class="col-sm-3 order">Customer ID:<?php echo $row['customerID']?></div>        
                <div class="col-sm-3 order" id="os<?php echo $row['orderID']?>">Order Status:<?php echo $row['status']?></div> 
                
                <div class="col-sm-2  col-sm-offset-8 order control-group" style="margin-top: 1%;">
                    
                    <select name="orderStatus" >
                        <?php
                            if ($row['status'] == "unfinished") {
                        ?>
                        <option>Change Status...</option>
                        <option id='pr<?php echo $row['orderID']?>' onclick="butclickchange(<?php echo $row['orderID']?>,'pr')">Payment Recieved</option>
                        <option id='ship<?php echo $row['orderID']?>' onclick="butclickchange(<?php echo $row['orderID']?>,'cancel')">Cancel</option>
                        <?php                             
                        }
                        elseif ($row['status'] == "shipping") {
                        ?>  
                        <option>Your order is complete</option>
                        <?php
                        }elseif ($row['status'] == "cancel") {
                        ?>  
                        <option>Your order is cancelled</option>
                        <?php
                        }
                        else {
                        ?>
                        <option>Change Status...</option>
                        <option id='ship<?php echo $row['orderID']?>' onclick="butclickchange(<?php echo $row['orderID']?>,'ship')">Shipping</option>
                        <?php }?>
                    </select>
                </div>
                <div class="col-sm-1 order control-group"><button id="bt<?php echo $row['orderID']?>" type="button" class="btn btn-sm btn-default" style="margin-top: 6%;">Change</button></div>
                
                <div style="margin-top: 7%; background-color:#ffffff">    
                    <table class="table table-bordered">
                        <tr style="font-weight: bold !important;">
                            <th class="col-sm-4">Product Name</th>
                            <th class="col-sm-1">Unit Price</th>
                            <th class="col-sm-1">Quantity</th>
                            <th class="col-sm-1">Price</th>        
                        </tr>
                        <?php 
                            $oid = $row['orderID'] ;
                            $subsql="SELECT * FROM orderDetail WHERE orderID=$oid";
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
                <div class="col-sm-2 col-sm-offset-8 order" style="margin-left: 68.5%;">Total price</div> 
                <div class="col-sm-1 order" ><?php echo $totalprice;?></div>   
        </div>
        <?php
            }
            
            $page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数
            $pageoffset = ($page_len-1)/2;//页码个数左右偏移量

            $key='<div class="col-sm-offset-5" style=""><nav><ul class="pagination">';
//            $key.="<span>$page/$pages "; //第几页,共几页
            if($page!=1){
//            $key.="<a href=\"".$_SERVER['PHP_SELF']."?page=1\">First</a> "; //第一页
            $key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\"><span aria-hidden=\"true\">&laquo;</span><span class=\"sr-only\">Previous</span></a></li>"; //上一页
            }else {
//            $key.="First ";//第一页
//            $key.="Previous"; //上一页
            $key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\"><span aria-hidden=\"true\">&laquo;</span><span class=\"sr-only\">Previous</span></a></li>";
            
            }
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
            if($i==$page){
//            $key.=' <span>'.$i.'';
                $key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a></li>";
            } else {
            $key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a></li>";
            }
            }
            if($page!=$pages){
            $key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\"><span aria-hidden=\"true\">&raquo;</span><span class=\"sr-only\">Next</span></a></li> ";//下一页
//            $key.="<a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">Last</a>"; //最后一页
            }else {
             
            $key.="<li><a href=\"#\"><span aria-hidden=\"true\">&raquo;</span><span class=\"sr-only\">Next</span></a></li> ";//下一页
//              $key.="Next ";//下一页
//            $key.="Last"; //最后一页
            }
            $key.='</ul></nav></div>';
            ?>      
        </div>
        <div class="col-sm-10 col-sm-offset-1">
            <?php echo $key?>
        </div>

   </body>
</html>           