<?php
require_once '../classes/Utility.php';
Utility::validateSession();
$fn = $_SESSION['fn'];
$ln = $_SESSION['ln'];
?>
<!DOCTYPE html>
<html lang="en">

    <head>



        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Vinyasa Yoga School Rishikesh">
        <meta name="author" content="">

        <title>Vinyasa Yoga School</title>

        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="../vinyasa/css/bootstrap.min.css" type="text/css">

        <!-- Custom Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../vinyasa/font-awesome/css/font-awesome.min.css" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

        <!-- Plugin CSS -->
        <link rel="stylesheet" href="../vinyasa/css/animate.min.css" type="text/css">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="../vinyasa/css/creative.css" type="text/css">
        <style>

            .sectionDetail{
                color: rgba(189, 138, 148,.8) !important; 
                font-weight: 400 !important; 
                font-family: "Lobster",cursive !important;
            }
            .customContainer{
                margin-right: 49% !important;
                margin-left: 0% !important;
                max-width: 100% !important;
                margin-top: 10% !important;
            }

        </style>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body id="page-top">

        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->

                <div class="navbar-header" style="background-image: url('');width:100%">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <label>Welcome <?php echo "$ln,$fn"; ?><a href="logout.php" class="btn btn-link btn-sm page-scroll">logout</a></label>
                    <img src="../vinyasa/img/vinyasa/logo.png" alt="vinyasa yoga school" style="padding-left:85%;"></a>
                </div>


                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a class="page-scroll dropdown-toggle" data-toggle="dropdown" href="#">Quiz<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="../vinyasa_admin/create_ques.php">Create Questions</a></li>
                                <li><a href="#">Create Question Category</a></li>
                            </ul>
                        </li>
                        <!--<li>
                            <a class="page-scroll" href="#services">Services</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#portfolio">Portfolio</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#contact">Contact</a>
                        </li>-->
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <header>
            <div class="header-content">
                <div class="header-content-inner customContainer">
                    <!--<h1>Vinyasa Yoga School</h1>-->
                    <!--hr-->
                    <h2 class="section-heading sectionDetail" id="abc">Course Offering - 1</h2>
                    <hr class="heavy">
                    <p class="text-faded sectionDetail">Here We will write a breifing about the course the offerings and other catchy lines.</p>
                    <a href="#about" class="btn btn-primary btn-xl page-scroll">Enroll</a>
                </div>
            </div>
        </header>

        <section class="bg-primary" id="course-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">Course Offering 2</h2>
                        <hr class="light">
                        <p class="text-faded">Here We will write a breifing about the course the offerings and other catchy lines.</p>
                        <a href="#" class="btn btn-default btn-xl">Enroll</a>
                    </div>
                </div>
            </div>
        </section>
        <aside class="bg-white">
            <div class="container text-center">
                <div class="call-to-action">

                </div>
            </div>
        </aside>
        <section class="bg-primary" id="course-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">Course Offering 3</h2>
                        <hr class="light">
                        <p class="text-faded">Here We will write a breifing about the course the offerings and other catchy lines.</p>
                        <a href="#" class="btn btn-default btn-xl">Enroll</a>
                    </div>
                </div>
            </div>
        </section>

        <!--section id="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Other Facilities</h2>
                        <hr class="primary">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="service-box">
                            <i class="fa fa-4x fa-bed wow bounceIn text-primary"></i>
                            <h3>Hostel</h3>
                            <p class="text-muted">State of the art facilities available in our hostel.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="service-box">
                            <i class="fa fa-4x fa-wifi wow bounceIn text-primary" data-wow-delay=".1s"></i>
                            <h3>Internet</h3>
                            <p class="text-muted">Round the clock 24X7 internet.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="service-box">
                            <i class="fa fa-4x  fa-delicious wow bounceIn text-primary" data-wow-delay=".2s"></i>
                            <h3>Food</h3>
                            <p class="text-muted">Fresh and delicious food prepared and served in our mess</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="service-box">
                            <i class="fa fa-4x fa-tree wow bounceIn text-primary" data-wow-delay=".3s"></i>
                            <h3>Monthly Outings</h3>
                            <p class="text-muted">Enjoy the natural outlook in our outdoor trips.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section-->

        <section class="no-padding" id="portfolio">
            <div class="container-fluid">
                <div class="row no-gutter">
                    <div class="col-lg-4 col-sm-6">
                        <a href="#" class="portfolio-box">
                            <img src="../vinyasa/img/vinyasa/vinyasa_yoga_img1.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Category
                                    </div>
                                    <div class="project-name">
                                        Project Name
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="#" class="portfolio-box">
                            <img src="../vinyasa/img/portfolio/2.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Category
                                    </div>
                                    <div class="project-name">
                                        Project Name
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="#" class="portfolio-box">
                            <img src="../vinyasa/img/portfolio/3.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Category
                                    </div>
                                    <div class="project-name">
                                        Project Name
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="#" class="portfolio-box">
                            <img src="../vinyasa/img/portfolio/4.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Category
                                    </div>
                                    <div class="project-name">
                                        Project Name
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="#" class="portfolio-box">
                            <img src="../vinyasa/img/portfolio/5.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Category
                                    </div>
                                    <div class="project-name">
                                        Project Name
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="#" class="portfolio-box">
                            <img src="../vinyasa/img/portfolio/6.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        Category
                                    </div>
                                    <div class="project-name">
                                        Project Name
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <aside class="bg-dark">
            <div class="container text-center">
                <div class="call-to-action">
                    <h2>Vinyasa Yoga School e-Magzine</h2>
                    <a href="#" class="btn btn-default btn-xl wow tada">Download Now!</a>
                </div>
            </div>
        </aside>

        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">Let's Get In Touch!</h2>
                        <hr class="primary">
                        <p>Ready to start your next project with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
                    </div>
                    <div class="col-lg-4 col-lg-offset-2 text-center">
                        <i class="fa fa-phone fa-3x wow bounceIn"></i>
                        <p>123-456-6789</p>
                    </div>
                    <div class="col-lg-4 text-center">
                        <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                        <p><a href="mailto:your-email@your-domain.com">feedback@vinyasayogaschool.com</a></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- jQuery -->
        <script src="../vinyasa/js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../vinyasa/js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="../vinyasa/js/jquery.easing.min.js"></script>
        <script src="../vinyasa/js/jquery.fittext.js"></script>
        <script src="../vinyasa/js/wow.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../vinyasa/js/creative.js"></script>

    </body>

</html>