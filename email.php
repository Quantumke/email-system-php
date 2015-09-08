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
<body>	


	<!-- Preloader -->
    <div class="loading-container">
      <div class="loading">
        <div class="l1">
          <div></div>
        </div>
        <div class="l2">
          <div></div>
        </div>
        <div class="l3">
          <div></div>
        </div>
        <div class="l4">
          <div></div>
        </div>
      </div>
    </div>
    <!-- Preloader -->
    
	<?php include 'sidebar.php'; ?>
    
    <section class="content">
    	
        <header class="top-head container-fluid">
            <button type="button" class="navbar-toggle pull-left">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
<?php  include 'hdr.php'  ; ?>
        <!-- Header Ends -->
        <form name="myform" action="" method="post" />
        
        <div class="warper container-fluid">
        	
            <div class="page-header"><h1>Inbox <small>Your custom mailing box</small></h1></div>
                             
            <div class="row">
            
            	<div class="col-sm-3">
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
                        <div class="panel-heading clean"> </div>
                        <div class="panel-body no-padd">
                        	<div class="list-group no-margn mail-nav">
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
                
                <div class="col-sm-9">
                	<div class="row">
                    	<div class="col-lg-9 col-xs-5">
                    	<div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                             All <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#">All</a></li>
                            <li><a href="#">None</a></li>
                            <li><a href="#">Read</a></li>
                            <li><a href="#">Unread</a></li>
                            <li><a href="#">Starred</a></li>
                            <li><a href="#">UnStarred</a></li>
                          </ul>
                        </div>
                        <button type="button" onclick="myFunction()" class="btn btn-default dropdown-toggle tooltip-btn" data-toggle="tooltip" data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></button>
                        <div class="btn-group visible-lg-inline-block">
  <button type="button" onClick="setArchive();" class="btn btn-default tooltip-btn" data-toggle="tooltip" data-placement="top" title="Archive"><i class="fa fa-inbox"></i></button>
                          <button type="button" class="btn btn-default tooltip-btn" data-toggle="tooltip" data-placement="top" title="Move to folder"><i class="fa fa-folder"></i></button>
                          <button type="button" onClick="setDelete();" class="btn btn-default tooltip-btn" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                        </div>
                        </div>
						 <?php
				
					//get category
					$result = mysql_query("SELECT * from mail where mail_to='$email' ");
					
					$count=mysql_num_rows($result);
					
				?>
                        <div class="col-lg-3 col-xs-7">
                        <div class="input-group">
                          <input type="search" class="form-control"  placeholder="Search mail">
                          <span class="input-group-btn">
                            <button class="btn btn-purple" type="button"><i class="fa fa-search"></i></button>
                          </span>
                        </div>
                        </div>
                    </div>
                	<hr class="clean">
								  <?php
	  /******************** ERROR MESSAGES*************************************************
	  This code is to show error messages 
	  **************************************************************************/
      if (isset($_GET['msg'])) {
	  $msg =$_GET['msg'];// mysql_real_escape_string($_GET['msg']);
	   echo "<div class='alert alert-danger alert-dismissible' role='alert'>
    <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
                 <strong>Message</strong> $msg.</div>";
	  
	  
	  }
	  /******************************* END ********************************/
			?>	
			
			 <?php
	  /******************** ERROR MESSAGES*************************************************
	  This code is to show error messages 
	  **************************************************************************/
      if (isset($_GET['msg2'])) {
	  $msg2 =$_GET['msg2'];// mysql_real_escape_string($_GET['msg2']);
  echo "<div class='alert alert-success alert-dismissible' role='alert'>
<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
  <strong>Success!</strong> $msg2.</div>";
	  }
	  /******************************* END ********************************/
			?>		
       

                	<div class="panel panel-default">
                        <div class="panel-body">
                        
                        	<table class="table table-hover mails">
							  <?php
														  echo $total;
				
				if ($count>0)
				{
					$i=0;
					$j='';
					for($i=0;$i<$count; $i++)
					{
						$j=$i+1;
						echo("<tr class='active'>
                                	<td class='mail-select'>
                                    <label class='cr-styled'>");

							echo("<td><input type='checkbox'ng-model='todo.done' class='ng-pristine ng-untouched ng-valid' name='users[]' value= '".mysql_result($result,$i,"mail_id")."'  />    <i class='fa'></i></label></td>");
							
				echo(" <td class='mail-rateing'><i class='fa fa-star'></i></td>");
 echo("<td class='sender visible-lg visible-md'><a href='email-read?id=".mysql_result($result,$i,"mail_id")."'>".mysql_result($result,$i,"mail_from")."</a></td>");
  echo("<td class='mail-content'><a href='email-read?id=".mysql_result($result,$i,"mail_id")."'>".mysql_result($result,$i,"mail_subject")."</a></td>");
	           echo("  <td class='mail-attachment visible-lg'></td>");
                echo(" <td class='text-right visible-lg visible-md visible-sm'>" .mysql_result($result,$i,"mail_sent")."</td>");

                                    							
							
						
						echo("</tr>");
					}
				}
				else
				{
							echo("<td width='20000' >Sorry You have no mails Yet</td>");
				}
				
				?>
                             

						</table>
						
                            	
                                    
                                   
                                 
                                   
                              
                            <hr>
                            
                            <div class="row">
                            	<div class="col-xs-7">
                                	Showing 1 - 20 of 141
                                </div>
                            	<div class="col-xs-5">
                                	<div class="btn-group pull-right">
                                      <button type="button" class="btn btn-default"><i class="fa fa-chevron-left"></i></button>
                                      <button type="button" class="btn btn-default"><i class="fa fa-chevron-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            
            </div>
            
            
            
        </div>
		</form>
        <!-- Warper Ends Here (working area) -->
        
<?php include 'f.php'  ; ?>        
    
    </section>
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
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
    ga('create', 'UA-56821827-1', 'auto');
    ga('send', 'pageview');
    
    </script>
</body>
</html>
