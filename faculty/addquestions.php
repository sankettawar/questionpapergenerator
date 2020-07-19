<?php 
error_reporting(E_ALL);
ini_set("display_errors",'1');
    require 'aes.class.php';     // AES PHP implementation
    require 'aesctr.class.php';  // AES Counter Mode implementation
include("connect.php");
session_start();
	session_cache_expire( 20 );
$inactive = 1200;
if(isset($_SESSION['start']) ) {
	$session_life = time() - $_SESSION['start'];
	if($session_life > $inactive){
    session_destroy();
		echo "<script>alert('Session Timeout! Please Login Again!');</script>";
		echo "<script>self.location='../welcome.php'</script>";
	}
}
$_SESSION['start'] = time();
	
 if(isset($_REQUEST['save']))
{
      
    $SID=$_SESSION['username'];
    $QID=uniqid();
    $marks=$_REQUEST['marks'];
    $CO=$_REQUEST['CO'];
    $pw="password";
    $Question= AesCtr::encrypt($_REQUEST['Question'], $pw, 256);
   
    $description=$_REQUEST['description'];
    $LOD=$_REQUEST['LOD'];
    $U_NO=$_REQUEST['U_NO'];
	$CID=$_SESSION['subject'];
    echo "<script>alert($CID)</script>";
    $query="insert into  Questions(`Teacher_ID`,`Ques_ID`,`Marks`,`CO`,`Description`,`Remarks`,`LOD`,`Unit_No`,`Course_Id`)  
    VALUES('$SID','$QID','$marks','$CO','$Question','$description','$LOD','$U_NO','$CID')";   
    $res=mysqli_query($con,$query);

   if($res){
    echo "<script>alert('Successful')</script>";
    echo "<script>self.location='addquestions.php'</script>";
	}
 else  die('Invalid query: ' . mysql_error());
}
?>


<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Add Questions</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
        <link rel="stylesheet" href="style.css">
    
  </head>

  <body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand">Automatic QP Generator &nbsp   |  </a>
    
	
    </div>
	
	  <a class="navbar-brand" href='facultydash.php'>Add Questions To Database</a>
	
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="facultydash.php">Logged in As     <?php echo $_SESSION["name"]; ?></a></li>
       
     
      </ul>
    </div>
  </div>
</nav>


<script src="https://code.jquery.com/jquery-1.11.3.js" type="text/javascript" charset="utf-8"></script>
		<script language="javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.22/jquery-ui.min.js"></script>
		<script src="questions.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>

	
    <div class="wrapper">
	<div class="container">
		<br>
		<h2>Enter the question and details to add it to question bank</h2>
		<br>
		<form method="POST">
		
			<input id="marks" name="marks" type="number" placeholder="Marks" required>
			<input id="co" name="CO" type="number" placeholder="CO(ex:1 is equivalent to CO1)" required>
			<input id="quest" name="Question" type="text" placeholder="Your Question" required>
			<input id="desc" name="description" type="text" placeholder="Brief Description" required>
			<input id="lod" name="LOD" type="number" placeholder="Level Of Difficulty" required>
			<input id="uno" name="U_NO" type="number" placeholder="Unit Number" required>
			
     		<button id="sub" type="submit" name="save" id="login-button">Proceed</button><br><br>
			<button id="sub" type="button" name="back" id="done-button" onClick="location.href='facultydash.php'">Go to Dashboard</button>
			<button id="csv" type="button" name="csv"  id="csv-redirect" onClick="location.href='addfile.php'">Upload using a .csv file</button>
		</form>
	</div>
	
	
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


    
    
    
  </body>
</html>
