<!DOCTYPE html>
<?php 
session_start();
error_reporting(E_ALL);
ini_set("display_errors",'1');
ini_set('include_path', 'jpgraph');
	session_cache_expire( 20 );
$inactive = 1200;
if(isset($_SESSION['start']) ) {
	$session_life = time() - $_SESSION['start'];
	if($session_life > $inactive){
		echo "<script>alert('Session Timeout! Please Login Again!');</script>";
		echo "<script>self.location='../welcome.php'</script>";
	}
}

function mysqli_result($search, $row, $field)
{
  $result='';
$i=0; 
while($results=mysqli_fetch_array($search)){
  // return $results;
  if ($i==$row){
    $result=$results[$field];
  }
  $i++;
}
return $result;
}

$_SESSION['start'] = time();
	
include("connect.php");

if(isset($_REQUEST['go2'])){

$subject = $_REQUEST['subject'];
$eval= $_REQUEST['eval'];
$_SESSION['subject']=$subject;

$_SESSION['eval']=$eval;

$result = mysqli_query($con,"SELECT * FROM Question_Paper where Course_ID = '$subject' and Eval_ID='$eval'");

if(!$result or $result==null){
	echo "<script>alert('Error : No Question Papers Found');</script>";
	
}

echo "";
echo "<div class = 'wrapper'>
		<div class = 'container'>";
echo "<h2>Generated Question Papers for Evaluation :$eval</h2><br><br>";
echo "<center><table>
<tr>
<th>Generated By</th>
<th>ID</th>
<th>L1 Questions</th>
<th>L2 Questions</th>
<th>L3 Questions</th>

</tr>";
$options='';
$width = 600; $height = 200;
while($row = mysqli_fetch_array($result))
{
$f=$row['QP_ID'];
$l1=$row['L1'];
$l2=$row['L2'];
$l3=$row['L3'];
echo "<tr>";
echo "<td>" . $row['S_ID'] . "</td>";
echo "<td>" . $row['QP_ID'] . "</td>";
echo "<td>" . $row['L1'] . "</td>";
echo "<td>" . $row['L2'] . "</td>";
echo "<td>" . $row['L3'] . "</td>";
echo "</tr>";
$options.="<OPTION VALUE=\"$f\">".$f."</OPTION>"; 
}
echo "</table></center>";
mysqli_close($con);


}

if(isset($_REQUEST['display'])){
  
  $_SESSION['qps']=$_REQUEST['qps'];
		echo "<script>self.location='renderqp.php'</script>";
  
  
}


?>
<head>
	 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel='stylesheet' href='style.css'>
</head>
<br><br>
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
	
	  <a class="navbar-brand" href='admindash.php'>Update Syllabus</a>
	
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#lo">Logged in As     <?php echo $_SESSION["username"]; ?></a></li>
       
     
      </ul>
    </div>
  </div>
</nav>
<h2>Choose the Question Paper ID to view</h2>
 
<form method="post">
<SELECT name="qps">
<?php echo($options);?>		
</SELECT>
<button type="submit" name="display">Display</button>
</form>
