<?php
include 'VYS_assets/mailclient.php';
include 'classes/DAO.php';
//$emailsent = 0;
//$db  link to database
$emailsent=FALSE;
if(isset($_POST['frm_txtFname'])){
        $usr_fname = $_POST['frm_txtFname'];
    }
if(isset($_POST['frm_txtLname'])){
    $usr_lname = $_POST['frm_txtLname'];
}
if(isset($_POST['frm_txtEmail'])){
        $usr_email = $_POST['frm_txtEmail'];
    }
if(isset($_POST['frm_txtcontact'])){
        $usr_contact = $_POST['frm_txtcontact']."";
    }
if(isset($_POST['frm_psswd'])){
        $usr_password = $_POST['frm_psswd'];
    }
if(isset($usr_password)){
    $hash_string= Utility::encryptString($usr_password);
    }

//$dbh link to database
if(isset($usr_fname) && isset($usr_lname) && isset($usr_email) && isset($usr_password)&& isset($usr_contact)){
    $secure_key = Utility::encryptMD5($usr_email);
    $dao = DAOFactory::getDAO();
    $isUserCreated = $dao->createNewUser($usr_fname, $usr_lname, $usr_email, $usr_contact, $hash_string,$secure_key);
    if($isUserCreated){
        $db_id=$dao->getUserID($usr_email);
        if($db_id!=NULL){
            $mailClient = MailClientFactory::getMailClient();
            $addr = $_SERVER['HTTP_HOST']."\\VYS\\";
            $mailClient->sendEmail($usr_email,"Email verification","Please click on the below link to verify your email.\n http:\\\\$addr"."classes\\verify?vc=$secure_key&x=$db_id");
            $emailsent=TRUE;
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">

    <head>


        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vinyasa Yoga School</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">



        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
        
 
    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">	
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Vinyasa</strong> Yoga School</h1>
                            <div class="description">
                                <?php
                                if($emailsent){
                                    echo 'A verification link has been sent on your email.';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                        	<div class="form-box">
	                        	<div class="form-top">
	                        		<div class="form-top-left">
                                                    <h3>Login to Vinyasa World</h3>
                                                    <p>Enter username and password to log on:</p>
	                        		</div>
	                        		<div class="form-top-right">
                                                    <i class="fa fa-lock"></i>
	                        		</div>
                                        </div>
                                        <div class="form-bottom">
                                            <form role="form" action="vinlog.php" method="post" class="login-form">
                                                    <div class="form-group">
				                    		<label class="sr-only" for="form-username">Username</label>
				                        	<input type="text" name="frm_username" placeholder="Username..." class="form-username form-control" id="frm_username" value="<?php
                                                                if(isset($_GET['se'])){
                                                                    echo $_GET['se'];
                                                                }
                                                                ?>"/>
                                                    </div>
                                                    <div class="form-group">
				                        	<label class="sr-only" for="form-password">Password</label>
				                        	<input type="password" name="frm_password" placeholder="Password..." class="form-password form-control" id="frm_password"/>
                                                    </div>
				                    <button type="submit" class="btn">Sign in!</button>
                                            </form>
                                        </div>
		                </div>
		                <div class="social-login">
	                        	<h3>...or login with:</h3>
	                        	<div class="social-login-buttons">
		                        	<a class="btn btn-link-2" href="#">
		                        		<i class="fa fa-facebook"></i> Facebook
		                        	</a>
		                        	<a class="btn btn-link-2" href="#">
		                        		<i class="fa fa-twitter"></i> Twitter
		                        	</a>
		                        	<a class="btn btn-link-2" href="#">
		                        		<i class="fa fa-google-plus"></i> Google Plus
		                        	</a>
	                        	</div>
	                        </div>
	                        
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        	
                        <div class="col-sm-5">
                        	
                        	<div class="form-box">
                        		<div class="form-top">
	                        		<div class="form-top-left">
	                        			<h3>Sign up now</h3>
                                                        <p>Fill in the form below to get instant access:</p>
	                        		</div>
	                        		<div class="form-top-right">
	                        			<i class="fa fa-pencil"></i>
	                        		</div>
                                        </div>
	                            <div class="form-bottom">
                                        <form role="form" action="" method="post" class="registration-form" id="frm_reg">
                                                                                        
                                            <div class="form-group">
				                    		<label class="sr-only" for="form-first-name">First name</label>
				                        	<input type="text" name="frm_txtFname" placeholder="First name..." class="form-first-name form-control" id="frm_txtFname"/>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-last-name">Last name</label>
				                        	<input type="text" name="frm_txtLname" placeholder="Last name..." class="form-last-name form-control" id="frm_txtLname"/>
				                        </div>
										<div class="form-group">
				                        	<label class="sr-only" for="form-password">Password</label>
				                        	<input type="password" name="frm_psswd" placeholder="Password" class="form-password form-control" id="frm_psswd"/>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-email">Email</label>
				                        	<input type="text" name="frm_txtEmail" placeholder="Email..." class="form-email form-control" id="frm_txtEmail"/>
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-contact-number">Phone Number</label>
				                        	<input type="text" name="frm_txtcontact" placeholder="Phone Number..." class="form-contact-number form-control" id="frm_txtcontact"/>
				                        </div>
                                            <button type="submit" class="btn" value="Sign Up">Sign Up</button>
				        </form>
                                        
			                    </div>
                        	</div>
                        	
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

        <!-- Footer -->
        <footer>
        	<div class="container">
        		<div class="row">
        			
        			<div class="col-sm-8 col-sm-offset-2">
        				<div class="footer-border"></div>
        				<p><i class="fa fa-smile-o"></i></p>
        			</div>
        			
        		</div>
        	</div>
        </footer>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
        <script>       
     $(document).ready(function() {
    $("#frm_reg").validate({
            rules: {
                frm_txtEmail: {
                    required: true,
                    email: true,
                    remote: {
                        url: "classes\uexist.php",
                        type: "post"
                     }
                }
            },
            messages: {
                frm_txtEmail: {
                    required: "Please Enter Email!",
                    email: "This is not a valid email!",
                    remote: "Email already in use!"
                }
            },
              submitHandler: function() { alert("Submitted!") }
  }

        });

});
</script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>