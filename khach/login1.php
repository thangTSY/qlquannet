<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../assets/css/css.css" rel="stylesheet">
    <title>LOGIN-KHACH-HANG</title>
</head>
<body>
	
<div class="a">
	<div class="container">	
		<h1>KHÁCH HÀNG ĐĂNG NHẬP</h1>
		<form action="login.php" method="post">
			<div>
				<div>
					<label for="username">Tên đăng nhập:</label>
				</div>
				<div>
					<input type="text" id="username" name="username" required>
					<?php if (isset($_GET['may'])) { ?>
					<input type="text" id="idmay" name="idmay" value="<?php echo $_GET['may']; ?>" required style="display: none;">
				<?php } ?>
				</div>
			</div>

		<!--  -->
			<div>
				<div>
					<label for="password">Mật khẩu:</label>
				</div>
				<div>
					<input type="password" id="password" name="password" required>
				</div>
			</div>
			<input type="submit" value="Đăng nhập">
		</form>
	</div>
</div>
</body>
</html>
