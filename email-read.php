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
$id=$_GET["id"]; 

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
            
        <!-- Header Ends -->
        
        
        <div class="warper container-fluid">
        	
            <div class="page-header"><h1>Mail Read <small></small></h1></div>
            
            
            <div class="row">
            
            	<div class="col-md-3">
                	<a href="email-compose" class="btn btn-danger btn-block">Compose</a>
                    <hr class="clean">
                	<div class="panel panel-default">
                        <div class="panel-heading clean">Folders</div>
                        <div class="panel-body no-padd">
                        	<div class="list-group no-margn mail-nav">
                              <a href="email" class="list-group-item on"><span class="badge bg-blue text-white"></span>Inbox</a>
							   <a href="email-sent" class="list-group-item">Sent Mail </a>
                              <a href="email -arch" class="list-group-item">Archived Mail</a>
            
							  
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
                         
                        </div>
                        
                    	<div class="btn-group">
                        
                        
                          
                          <ul class="dropdown-menu" role="menu">
                           
                          </ul>
                        </div>
                        
                        
                        </div>
                        <div class="col-lg-3 col-xs-7 text-right">
                        <div class="btn-group pull-right">
                          <button class="btn btn-default" type="button"><i class="fa fa-chevron-left"></i></button>
                          <button class="btn btn-default" type="button"><i class="fa fa-chevron-right"></i></button>
                        </div>
                        </div>
                    </div>
                	<hr class="clean">
					<?php
							 $sql="select * from mail WHERE  mail_id=".$id  ; 
	    $result=mysql_query($sql) or die(mysql_error());
	    ?>
                	<div class="panel panel-default">
                        <div class="panel-body">
                        	
                            <div class="row">
                            	<div class="col-lg-11">
                        		<h4 class="no-margn">Subject: <?php echo mysql_result($result,$i,"mail_subject"); ?>. &nbsp; From: < <?php echo mysql_result($result,$i,"mail_from"); ?> >  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.<small> <?php echo mysql_result($result,$i,"mail_sent"); ?></small></h4>
                                </div>
                                <div class="col-lg-1 text-right">
                            	<a href="#" onClick="myFunction()"><i class="fa fa-print"></i></a>
                            	</div>
                            </div>
                            
                            <hr class="sm">
                            
                            <div class="row">
                            	<div class="col-lg-6">
                                <img src="assets/images/avtar/logo.png" alt="..." width="128" height="61" class="img-circle">
                                <span class="form-control-static"> LHS Mail service  <span class="text-gray"></span></span>                                </div>
                                <div class="col-lg-6 text-right">
                                	<small class="form-control-static text-gray"><?php echo mysql_result($result,$i,"mail_sent"); ?> </small>
									                                    <div class="btn-group">
                                      <button type="button" class="btn btn-default btn-sm">Acrion</button>
                                      <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <ul role="menu" class="dropdown-menu pull-right"> <?php 
echo "<li><a href='email-reply?mail_from=".mysql_result($result,$i,"mail_from")."&subject=".mysql_result($result,$i,"mail_subject")."&mail_body=".mysql_result($result,$i,"mail_body")."'>Reply</a></li>"
								  
								   ?>
                                      </ul>
                                    </div>
                            

                                    </div>
									</div>
                            
                            <hr class="sm">
                            
                           <p> <?php echo mysql_result($result,$i,"mail_body"); ?> 
                            
                            
                        
                        </div>
                    </div>
                </div>
            
            </div>
            
            
            
            
        </div>
        <!-- Warper Ends Here (working area) -->
        
<?php include 'f.php' ;?>    </section>
    <!-- Content Block Ends Here (right box)-->
    
    
<script language="javascript" src="users.js" type="text/javascript"></script>
    <!-- JQuery v1.9.1 -->
	<script src="assets/js/jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="assets/js/plugins/underscore/underscore-min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap/bootstrap.min.js"></script>
    
    <!-- Globalize -->
    <script src="assets/js/globalize/globalize.min.js"></script>
    
    <!-- NanoScroll -->
    <script src="assets/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
    
	
    
    
    <!-- Custom JQuery -->
	<script src="assets/js/app/custom.js" type="text/javascript"></script>
    

<script>
function myFunction() {
    window.print();
}
</script>	<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
    ga('create', 'UA-56821827-1', 'auto');
    ga('send', 'pageview');
    
    </script>
</body>
</html>
