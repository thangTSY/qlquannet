<?php
session_start();
require_once('config.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  $sql = "SELECT * FROM taikhoan WHERE taikhoan = '$username' and matkhau = '$password'";
  $result = mysqli_query($conn,$sql);
  $count = mysqli_num_rows($result);
  
  if($count == 1) {
    $_SESSION['username'] = $username;
    header("location: ../index.php");
  }else {
    $error = "Tên đăng nhập hoặc mật khẩu không đúng";
  }
}
?>