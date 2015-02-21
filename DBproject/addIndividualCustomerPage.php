<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <title>customerList Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/customize.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">    
        <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
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

        <div class="container">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    Individual Customer Information
                    </div>
                    <div class="panel-body" style="padding-bottom: 5%;">
                        <form class="post" role="form" method="post" action="addIC.php">    
                            <div class="control-group">
                                <label class="control-label col-sm-11 col-sm-offset-1" for="Title">Name</label>                      
                                <div class="col-sm-10 col-sm-offset-1">
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label col-sm-11 col-sm-offset-1 input" for="gender">Gender</label>
                                <div class="col-sm-10 col-sm-offset-1">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="1" checked>Male 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="2">Female   
                                    </label>    
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label col-sm-11 col-sm-offset-1 input" for="gender">Marriage Status</label>
                                <div class="col-sm-10 col-sm-offset-1">
                                    <label class="radio-inline">
                                        <input type="radio" name="marriagest" value="1" checked>Single 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="marriagest" value="2">Common-Law   
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="marriagest" value="3">Married
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="marriagest" value="4">Divorced   
                                    </label>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label col-sm-11 col-sm-offset-1" for="Title">Age</label>                      
                                <div class="col-sm-10 col-sm-offset-1">
                                    <input type="text" class="form-control" name="age">
                                </div>
                            </div>
                                
                            <div class="control-group">
                                <label class="control-label col-sm-11 col-sm-offset-1" for="Title">Street</label>                      
                                <div class="col-sm-10 col-sm-offset-1">
                                    <input type="text" class="form-control" name="street">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label col-sm-11 col-sm-offset-1" for="Title">City</label>                      
                                <div class="col-sm-10 col-sm-offset-1">
                                    <input type="text" class="form-control" name="city">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label col-sm-11 col-sm-offset-1" for="Title">State</label>                      
                                <div class="col-sm-10 col-sm-offset-1">
                                    <input type="text" class="form-control" name="state">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label col-sm-11 col-sm-offset-1 input" for="Price">Zipcode</label>
                                <div class="col-sm-10 col-sm-offset-1">
                                    <input type="text" class="form-control" name="zipcode">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label col-sm-11 col-sm-offset-1 input" for="Price">Annual Income</label>
                                <div class="col-sm-10 col-sm-offset-1">
                                    <input type="text" class="form-control" name="annualincome">
                                </div>
                            </div>
                            
                            <div class="submit col-sm-4 col-sm-offset-1">    
                                <button type="submit" class="btn btn-block btn-primary"><strong>Submit</strong></button>
                            </div>                   
                        </form>            
                    </div>        
                </div>
            </div> 
        </div>


    </body>
</html>        