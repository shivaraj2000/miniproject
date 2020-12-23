<?php
$Username = $_POST['name'];
$Password =$_POST['password'];
if (!empty($Username) || !empty($Password)) {
	 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "dairy management";
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
     if (mysqli_connect_error()) {
     	die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
     }else{
     	$SELECT="SELECT Username,Password from users where Username=? and Password=?";
     	$stmt = $conn->prepare($SELECT);
     	$stmt->bind_param("ss", $Username,$Password);
     	$SA=$stmt->execute();
     	$stmt->bind_result($a,$b);
         if($stmt->fetch())
         echo"successfull";
     		//header("Location:http://localhost/miniproject/inventory.html") ;
     	else{
             echo "Invalid Username or Password";
     	}
     	$stmt->close();
        $conn->close();
     }
}else{
	echo "All field are required";
 die();
}
	
 ?>