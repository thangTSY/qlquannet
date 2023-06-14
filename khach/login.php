<?php
	session_start(); // Khởi động phiên làm việc

	// Kết nối đến cơ sở dữ liệu
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'qlquannet';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	// Kiểm tra xem người dùng đã gửi thông tin đăng nhập hay chưa
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Lấy thông tin đăng nhập từ form
		$username = $_POST["username"];
		$password = $_POST["password"];

		// Kiểm tra thông tin đăng nhập
		$query = "SELECT * FROM thongtinkhachhang WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $query);
		$count = mysqli_num_rows($result);
		// echo $count;
		if ($count > 0) {
			// Lưu thông tin đăng nhập vào phiên làm việc
			$_SESSION["username"] = $username;
			$_SESSION["idmay"] = $_POST['idmay'];
			// Chuyển hướng đến trang chủ
			header("Location:../xulydangnhap.php");
			exit();
		} else {
			// Hiển thị thông báo lỗi
			$error_message = "Tên đăng nhập hoặc mật khẩu không đúng.";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	hihi
</body>
</html>