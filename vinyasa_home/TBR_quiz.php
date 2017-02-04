<?php
require('../VYS_assets/session.class.php');
require '../classes/DAO.php';
$session=new session();
$session->start_session('s_', false);
//echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
$uid=$_SESSION['s_k'];
$fn=$_SESSION['fn'];
$ln=$_SESSION['ln'];
if(empty($uid)){
header("Location: http://chalkuchkartehai.in/?v=0&err=1");
exit();
}
?>
<html lang="en"><head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Portfolio Item - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/portfolio-item.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


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
                <h1 class="page-header">Portfolio Item
                    <small>Item Subheading</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <form class="form-horizontal" method="post" action="q_crt" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>Create Question</legend>

<!-- Select Basic -->


<!-- Textarea -->
<div class="form-group">
  <label for="textarea" class="col-md-2 control-label">Question Title</label>
  <div class="col-md-8">  
    <div class="col-md-8">
    <textarea class="form-control" id="q_title" name="q_title" placeholder="Please enter you question here...."></textarea>
    </div>
    <div class="col-md-2">
    <label class="btn btn-default btn-file">
    Image<input class="hidden" id="q_title_img_h" name="q_title_img_h" type="file">
</label>
</div>
<div class="col-md-2">
<label class="btn btn-default btn-file">
<img id="q_title_img"  name="q_title_img" width="50px" height="50px">
</label>
</div>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label for="textarea" class="col-md-2 control-label">Option-1</label>
  <div class="col-md-8">  
    <div class="col-md-8">
    <textarea class="form-control" id="option_1" name="option_1" placeholder="Please enter you option here...."></textarea>
    </div>
    <div class="col-md-2">
    <label class="btn btn-default btn-file">
    Image<input class="hidden" id="files2" type="file">
</label>
</div>
<div class="col-md-2">
<label class="btn btn-default btn-file">
<img id="image2"  width="50px" height="50px">
</label>
</div>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label for="textarea" class="col-md-2 control-label">Option-2</label>
  <div class="col-md-8">  
    <div class="col-md-8">
    <textarea class="form-control" id="option_2" name="option_2" placeholder="Please enter you option here...."></textarea>
    </div>
    <div class="col-md-2">
    <label class="btn btn-default btn-file">
    Image<input class="hidden" id="files3" type="file">
</label>
</div>
<div class="col-md-2">
<label class="btn btn-default btn-file">
<img id="image3"  width="50px" height="50px">
</label>
</div>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label for="textarea" class="col-md-2 control-label">Option-3</label>
  <div class="col-md-8">  
    <div class="col-md-8">
    <textarea class="form-control" id="option_3" name="option_3" placeholder="Please enter you option here...."></textarea>
    </div>
    <div class="col-md-2">
    <label class="btn btn-default btn-file">
    Image<input class="hidden" id="files4" type="file">
</label>
</div>
<div class="col-md-2">
<label class="btn btn-default btn-file">
<img id="image4"  width="50px" height="50px">
</label>
</div>
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label for="textarea" class="col-md-2 control-label">Option-4</label>
  <div class="col-md-8">  
    <div class="col-md-8">
    <textarea class="form-control" id="option_4" name="option_4" placeholder="Please enter you option here...."></textarea>
    </div>
    <div class="col-md-2">
    <label class="btn btn-default btn-file">
    Image<input class="hidden" id="files5" type="file">
</label>
</div>
<div class="col-md-2">
<label class="btn btn-default btn-file">
<img id="image5"  width="50px" height="50px">
</label>
</div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label" for="selectbasic">Weightage</label>
  <div class="col-md-8" style="padding-left:2.5%;">
    <select id="weightage" name="weightage" class="selectpicker form-control" style="width:40%;">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
  </div>
  <div class="col-md-2"></div>
</div>
<div class="form-group">
  <label class="col-md-2 control-label" for="selectbasic">Category</label>
  <div class="col-md-8" style="padding-left:2.5%;">
    <select id="category" name="category" class="selectpicker form-control" style="width:40%;">
      <?php
      $dao= DAOFactory::getDAO();
      $dao->getAllCategories();
      ?>
    </select>
  </div>
  <div class="col-md-2"></div>
</div>
</fieldset>
<div class="col-md-12" style="padding:5% 0 0 7%;">
<button type="submit" class="btn btn-success">Create Question</button>
</div>
</form>

        </div>
        <!-- /.row -->

        <!-- /.row -->

        <hr>

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

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    document.getElementById("q_title_img_h").onchange = function () {
var reader = new FileReader();reader.onload = function (e) {document.getElementById('q_title_img').src = e.target.result;};reader.readAsDataURL(this.files[0]);
};
    document.getElementById("files2").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("image2").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
    document.getElementById("files3").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("image3").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
    document.getElementById("files4").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("image4").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
    document.getElementById("files5").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("image5").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
    </script>



</body></html>