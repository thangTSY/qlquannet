<?php
require_once('config.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  $sql = "INSERT INTO taikhoan (taikhoan, matkhau) VALUES ( '$username', '$password')";
  if(mysqli_query($conn, $sql)) {
    header("location: login.html");
  } else {
    $error = "Đăng ký không thành công";
  }
}
?>