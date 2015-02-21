<!DOCTYPE html>
<html>
    <head>
        <title>Index Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/customize.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/jasny-bootstrap.css">
        <link href="select2.css" rel="stylesheet"/>
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </head>
    <body>
        <?php
            include 'conn.php';
            session_start();

            $Page_size=8;
            $result1=mysqli_query($conn,'select * from product');
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
            $sql="select * from product limit $offset,$Page_size";
            $result=mysqli_query($conn,$sql);
     
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
        <div class="col-sm-10 col-sm-offset-1">
            <?php
                while ($row=mysqli_fetch_array($result)) {
            ?>   
            <div class="col-sm-3 col-sm-offset-.5" style="margin-top: 3%;">         
                <div class="row result-group" id="search_result" style="margin-top: 2%; margin-left: 4%" >
                    <div class='result' >
                        <div class="row text-center" style="color: #0099CC">
                            <div class="col-sm-8 col-sm-offset-2">
                                <?php
                                echo "<img class='img-thumbnail' style='margin-top:5%; margin-bottom:3%' width='200px' height='200px' src='". $row['imageFileName'] ."'/>";
                                ?>
                            </div>
                            <div class="col-sm-12">
                                <p class="name"><strong><?php echo  $row['name'];?></strong></p>
                                <p class="price"><strong><?php echo $row['referenceUnitPrice'];?></strong></p>
                            </div>
                            
                        </div> 
                    </div>
                </div>
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