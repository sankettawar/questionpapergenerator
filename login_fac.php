<?php
/*ini_set('include_path', 'B:\Sem6\Xampp\htdocs\html\admin');
require_once "recaptchalib.php";
$secret = "6Lc0uxwTAAAAAAId2HHpRjlqOFuAX2WUdmPxJ34D";

$response = null;
 
// check secret key
$reCaptcha = new ReCaptcha($secret);



if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}*/


define('HOST','localhost');
define('USER','root');
define('PASS','root');
define('DB','Question_Paper_Generator');
session_start(); 
$con = mysqli_connect('localhost','root','','Question_Paper_Generator');

$username = $_POST['uname'];
$password =$_POST['password']; 

$sql = "select * from Teacher where '$username'=Teacher_ID and '$password'=Password";

$res = mysqli_query($con,$sql);

$check = mysqli_fetch_array($res);

if(isset($check)){
echo "<script>>console.log('done')</script>";	
}


if(isset($check)){
$date=date("Y/m/d");
$time=date("h:i:sa");
$type='Faculty';
$sql2 = "insert into Login_History values('$date','$time','$username','$type')"	;
mysqli_query($con,$sql2);


$_SESSION['username']=$username;

echo "<script>self.location='faculty/facultydash.php'</script>";
}else{
//echo "<script>alert('Failed! Check your connectivity!');</script>";
//echo "<script>self.location='login_fac.html'</script>";

}
 
mysqli_close($con);
?>
 