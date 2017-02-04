<?php
//require('../VYS_assets/session.class.php');
//require '../VYS_assets/DAO.php';
//$session=new session();
//$session->start_session('s_', false);
////echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
//$uid=$_SESSION['s_k'];
//$fn=$_SESSION['fn'];
//$ln=$_SESSION['ln'];
//if(empty($uid)){
//header("Location: http://chalkuchkartehai.in/?v=0&err=1");
//exit();
//}
?>
<html lang="en"><head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Portfolio Item - Start Bootstrap Template</title>

        <!-- Bootstrap Core CSS -->
        <link href="../vinyasa/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <!--link href="vinyasa/css/portfolio-item.css" rel="stylesheet"-->
        <!-- Plugin CSS -->
        <link rel="stylesheet" href="../vinyasa/css/animate.min.css" type="text/css">
        <link rel="stylesheet" href="../vinyasa/font-awesome/css/font-awesome.min.css" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

        <!-- Custom CSS -->
        <link rel="stylesheet" href="../vinyasa/css/creative.css" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="../vinyasa/js/jqgrid/jquery-1.11.0.min.js"></script>
        <!-- jQuery -->
        <!--script src="vinyasa/js/jquery.js"></script-->

        <!-- Bootstrap Core JavaScript -->
        <script src="../vinyasa/js/bootstrap.min.js"></script>
        <script src="../vinyasa/js/creative.js"></script>
        <!-- Plugin JavaScript -->
        <script src="vinyasa/js/jquery.easing.min.js"></script>
        <script src="vinyasa/js/jquery.fittext.js"></script>
        <script src="vinyasa/js/wow.min.js"></script>
        <script>
            $(document).ready(function () {
                $('label.options').click(function (e) {
                    var id = $(this).attr('id');
                    if (id == "r1o1" || id == "r1o2" || id == "r2o1" || id == "r2o2")
                        release();
                    var elem = document.getElementById(id);
                    $(this).removeClass("btn-danger");
                    $(this).addClass("btn-success");
                    return id;
                });
                $(".next").click(function () {
                    $(".question").hide({direction: "left"}, 1000);
                    $(".loading").show({direction: "up"},5000);
                    //load next questions
                    var qno=$("#qno").attr("qno");
                    qno++;
                    $("#qno").attr("qno",qno);
                    $("#qno").html("Question No "+qno);
                    $(".loading").hide({direction: "down"},5000);
                    $(".question").show({direction: "right"}, 1000);
                });

            });
            function release() {
                $(".options").addClass("btn-danger");
            }

        </script>
    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Start Bootstrap</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#">About</a>
                        </li>
                        <li>
                            <a href="#">Services</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">
            
            
                <!-- Portfolio Item Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header " style="padding-top: 5%;">Test Name

                        </h1>
                    </div>
                </div>
                <div class="row loading" style="display:none;">
                    <div class="col-lg-12" style="width: 100%;">
                    <label style="width:100%;align-items: center;margin-left: 40%;margin-top: 20%;">assa<i class="fa fa-spinner fa-spin fa-5x fa-align-center wow bounceIn" data-wow-delay=".3s"></i></label>
                </div>
            </div>
                <div class="question">
                <!-- /.row -->

                <!-- Portfolio Item Row -->
                <div class="row">
                    <div class="form-group">
                        <div class="col-lg-12">
                            <h1><small style="align-self: center;" id="qno" qno="1">Question Number: 1</small></h1>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->
                <div class="row">
                    <div class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label type="submit" class="btn btn-danger" style="width:100%;height:150%;line-height:250%">Question</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label id="r1o1" type="submit" class="btn btn-danger options" style="width:100%;height:150%">Question</label>
                                </div>
                                <div class="col-lg-6">
                                    <label id="r1o2" type="submit" class="btn btn-danger options" style="width:100%;height:150%">Question</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="form-horizontal">
                        <fieldset>
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label id="r2o1" type="submit" class="btn btn-danger options" style="width:100%;height:150%">Question</label>
                                </div>
                                <div class="col-lg-6">
                                    <label id="r2o2" type="submit" class="btn btn-danger options" style="width:100%;height:150%">Question</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-lg-6">
                                <button id="r2o1" type="button" class="btn btn-info btn-xs prev" style="margin-top: 10%;margin-left: 40%;height:150%">
                                    <i class="fa fa-arrow-left fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                                </button>
                            </div>
                            <div class="col-lg-6">
                                <button id="r2o2" type="button" class="btn btn-xs next" style="background-color: #c0deed;margin-top: 10%;margin-left:40%;height:150%">
                                    <i class="fa fa-arrow-right fa-3x wow bounceIn" data-wow-delay=".3s"></i>
                                </button>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">

                        <p>Copyright © Vinyasa Yoga School , Rishikesh 2015</p>
                    </div>
                </div>
                <!-- /.row -->
            </footer>

        </div>
        <!-- /.container -->
    </body>
</html>