<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="css/customize.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
        <script src="JS/bootstrap.min.js"></script>
        <script src="JS/validateChecker.js"></script>
        <script src="JS/jquery.js"></script>
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
                            <li><a href="login.php"><i class="fa fa-btn "></i><span class="glyphicon glyphicon-user"></span>&nbsp Sign in</a></li>    
                        </ul>
                    </div>
                    <form class="navbar-form navbar-right" role="search" action="search.php" method="get">
                        <div class="col-sm-12">
                            <div class="input-group">
                              <input type="text" class="form-control">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Search</button>
                              </span>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                    </form>                 
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row row-main">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="panel panel-default" >
                        <div class="panel-heading">Login</div>
                        <div class="panel-body">


                            <form class="form-horizontal ng-pristine ng-valid" role="form" method="POST" action="log.php">
                                <div class="form-group" style="margin-top: 5% !important">
                                    <label for="username" class="col-sm-offset-1  col-sm-4 control-label">Employee ID</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="email" name="username" class="form-control" placeholder="Username" autocapitalize="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-offset-1 col-sm-4 control-label">Password</label>
                                    <div class="col-sm-6">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-3 col-sm-offset-5">
                                        <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i>&nbsp;Sign In</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="sigup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Sign Up</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal ng-pristine ng-valid" role="form" method="POST" action="RegServlet">
                            <div class="form-group">
                                <label for="email" class="col-sm-offset-1 col-sm-3 control-label">Name</label>
                                <div class="col-sm-6">
                                    <input type="name" id="name" name="username" class="form-control" placeholder="Name" autocapitalize="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-offset-1 col-sm-3 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" autocapitalize="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-offset-1 col-sm-3 control-label">Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="re_password" class="col-sm-offset-1 col-sm-3 control-label">Confirm Password</label>
                                <div class="col-sm-6">
                                    <input type="re_password" id="email" name="re_password" class="form-control" placeholder="Password" autocapitalize="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> I agree to the Terms of Service.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-8 col-sm-3">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i>Sign Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
