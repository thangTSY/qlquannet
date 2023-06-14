<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$title = "Quản lý giao dịch";
require_once('./db_connect.php');
require_once('./include/function.php');
$querykhachhang = "SELECT * FROM thongtinkhachhang WHERE username = '" . $_SESSION["username"] . "'";
$result = mysqli_query($conn, $querykhachhang);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $idkh = $row["idkh"];
  $hoten = $row["hoten"];
  $query = mysqli_query($conn, "INSERT INTO `giaodich` (`idkhachhang`, `idmay`, `idgiatien`, `thoigianbatdau`, `giamgia`, `ghichu`) VALUES ('$idkh', '" . $_SESSION["idmay"] . "', '3', NOW(), '0', '');");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-image: url("./assets/img/nen.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="nen"></div>
</body>
</html>
