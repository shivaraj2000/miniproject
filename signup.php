<?php 

$Username = $_POST['name'];
$Address = $_POST['address'];
$Phno = $_POST['phone'];
$Password =$_POST['password'];
if (!empty($Username) || !empty($Address) || !empty($Phno) || !empty($Password)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "dairy management";
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
     if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
    } else {
      $SELECT = "SELECT Username From users Where Username= ?";
      $INSERT = "INSERT Into users (Username, Address, Phno, Password) values(?, ?, ?, ?)";
      $stmt = $conn->prepare($SELECT);
      $stmt->bind_param("s", $Username);
      $stmt->execute();
      $stmt->bind_result($Username);
      $stmt->store_result();
      $stmt->fetch();
      $rnum = $stmt->num_rows;
      if ($rnum==0) {
           $stmt->close();
          $stmt = $conn->prepare($INSERT);
          $stmt->bind_param("ssis", $Username, $Address,  $Phno, $Password);
        $stmt->execute();
         header("Location:http://localhost/miniproject/admin.html") ;

      } else {
          echo "Someone already register using this Username";
      }
      $stmt->close();
      $conn->close();
     }
  } else {
 echo "All field are required";
 die();
}
?>