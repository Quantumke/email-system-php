<?php include '../db_drive.php' ;

session_start();
if(!isset($_SESSION['coname']) || trim($_SESSION['coname'])=='')
{
	header("location:index.php");
}else
{
	$email=$_SESSION['email'];
	$pname=$_SESSION['pname'];
	$coname=$_SESSION['coname'];
	$jobs_by=$_SESSION['userid'];
	$url=$_SESSION['url'];

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  
<?php include 'meta.php' ; ?>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css" /> 

	<!-- Email Styling  -->
    <link rel="stylesheet" href="assets/css/app/email.css" />
    
    <!-- Fonts  -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,300' rel='stylesheet' type='text/css'>
    
    <!-- Base Styling  -->
    <link rel="stylesheet" href="assets/css/app/app.v1.css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body ng-app>	
    
	<?php include 'sidebar.php';?>
    
    <section class="content">
    	
        <header class="top-head container-fluid">
            <button type="button" class="navbar-toggle pull-left">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
<?php include 'header.php' ; ?>        <!-- Header Ends -->
        
        
        <div class="warper container-fluid">
        	
            <div class="page-header"><h1>Mail Compose <small>Let's get a quick overview...</small></h1></div>
            
            				<?php
$sql="select * from mail where mail_to='$jobs_by' "  ; 
$count=mysql_num_rows($sql);	    ?>
            <div class="row">
            
            	<div class="col-md-3">
                	<a href="#" class="btn btn-danger btn-block">Compose</a>
                    <hr class="clean">
                	<div class="panel panel-default">
                        <div class="panel-heading clean">Folders</div>
                        <div class="panel-body no-padd">
                        	<div class="list-group no-margn mail-nav">
                              <a href="email" class="list-group-item on"><span class="badge bg-blue text-white"><?php echo $count ?></span>Inbox</a>
                            </div>
                        </div>
                        <hr class="xs">
                        <div class="panel-heading clean">Custom Folders</div>
                        <div class="panel-body no-padd">
                        	<div class="list-group no-margn mail-nav">
                              <a href="#" class="list-group-item">Work</a>
                              <a href="#" class="list-group-item">Personal</a>
                              <a href="#" class="list-group-item">Other</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading clean">8gb Left</div>
                        <div class="panel-body no-padd">
                        	<div class="col-lg-12">
                        	<div class="progress progress-xs progress-striped active">
                              <div style="width: 60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-info">
                                <span class="sr-only">60% Complete (success)</span>
                              </div>
                            </div>
                        	</div>
                        </div>
                        
                    </div>
                    
                    
                </div>
                
                <div class="col-md-9">
                	<div class="row">
                    	<div class="col-lg-9 col-xs-5">
                        
                        
                        <div class="btn-group visible-lg-inline-block">
                          <button type="button" class="btn btn-default tooltip-btn" data-toggle="tooltip" data-placement="top" title="Save"><i class="fa fa-save"></i></button>
                          <button type="button" class="btn btn-default tooltip-btn" data-toggle="tooltip" data-placement="top" title="Discard"><i class="fa fa-trash"></i></button>
                        </div>
                        
                    		<?php 
		//This code runs if the form has been submitted
		if (isset($_POST['submit'])) 
		{
error_reporting(E_ERROR | E_PARSE);
$database_hostname = "localhost";
$database_username = "root";
$database_password = "";


$main_database = "laikiana_db";
mysql_connect($database_hostname,$database_username,$database_password);
mysql_select_db("laikiana_db");

			
			//This makes sure they did not leave any fields blank
			if ($_POST['mail_to'] == "" || $_POST['mail_body'] == "" || $_POST['mail_subject'] == "") 
			{
				$message = 'You did not complete all of the required fields';
			}

			// checks if the username is in use
			if (!get_magic_quotes_gpc()) {
				$_POST['mail_to'] = addslashes($_POST['mail_to']);
			}
			
			$usercheck = $_POST['mail_to'];
			$check = mysql_query("SELECT email FROM um_laikiana WHERE coname = '$usercheck' OR  email = '$usercheck' OR  pname = '$usercheck'") or die(mysql_error());
			$check2 = mysql_num_rows($check);

			//if the name exists it gives an error
			if ($check2) {
				$message = 'Sorry, the Person '.$_POST['mail_to'].' Does Not exist.';
			}

			// this makes sure both passwords entered match
			

			// here we encrypt the password and add slashes if needed
			if (!get_magic_quotes_gpc()) {
				$_POST['mail_to'] = addslashes($_POST['mail_to']);
				$_POST['mail_subject'] = addslashes($_POST['mail_subject']);
				$_POST['mail_body'] = addslashes($_POST['mail_body']);
			}

			
			// now we insert it into the database
			$query_upload = "INSERT INTO mail (mail_from, mail_to, mail_subject,mail_body,mail_sent) VALUES ('$email', '".$_POST['mail_to']."', '".$_POST['mail_subject']."','".$_POST['mail_body']."', '".date("Y-m-d H:i:s")."')";
			
				mysql_query($query_upload) or die("error in $query_upload == ----> ".mysql_error());
				if($result) { ?>
			<script> alert('Sent') </script><?php 
			}
}
	
?>       
                        
                        </div>
						                            	<form role="form" action="" method="post">

                        <div class="col-lg-3 col-xs-7 text-right">
                        <div class="btn-group pull-right">
                          <button type="submit" class="btn btn-success btn-block"  name="submit"  type="button"><i class="fa fa-send"></i> Send</button>
                        </div>
                        </div>
                    </div>
                	<hr class="clean">
                	<!--<div class="panel panel-default">
                        <div class="panel-body">-->
                        	
                            
                                  <div class="form-group">
                                      <input type="email" class="form-control" name="mail_to" placeholder="To">
                                  </div>
                                  <div class="form-group">
                                      <input type="text" class="form-control" name="mail_subject" placeholder="Subject">
                                  </div>
                                  <div class="form-group">
                                      <textarea class="wysihtml form-control" name="mail_body" placeholder="Message body" style="height: 200px"></textarea>
                                  </div>
                                </form>
                            
                        
                        <!--</div>
                    </div>-->
                </div>
            
            </div>
            
            
            
            
        </div>
        <!-- Warper Ends Here (working area) -->
        
        
<?php include 'f.php'; ?>        
    
    </section>
    <!-- Content Block Ends Here (right box)-->
    
    
    
    <!-- JQuery v1.9.1 -->
	<script src="assets/js/jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="assets/js/plugins/underscore/underscore-min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    
    <!-- Globalize -->
    <script src="assets/js/globalize/globalize.min.js"></script>
    
    <!-- NanoScroll -->
    <script src="assets/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
    
	<!-- Wysihtml5 -->
    <script src="assets/js/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.min.js"></script>
    <script src="assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.js"></script>
    
    
    <!-- Custom JQuery -->
	<script src="assets/js/app/custom.js" type="text/javascript"></script>
    

    
	<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
    ga('create', 'UA-56821827-1', 'auto');
    ga('send', 'pageview');
    
    </script>
</body>
</html>
