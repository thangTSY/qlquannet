<?php
function dangNhap()
{
	if (isset($_POST['username']) && isset($_POST['password'])) {
		require_once('././db_connect.php');
		$username = $conn->real_escape_string($_POST['username']);
		$password = $conn->real_escape_string($_POST['password']);
		$query = $conn->query("SELECT * FROM `taikhoan` WHERE `taikhoan` = '$username'");
		if ($query->num_rows > 0) {
			$row = $query->fetch_assoc();
			if ($row['matkhau'] == ($password)) {
				$_SESSION['taikhoan'] = $row['taikhoan'];
				$_SESSION['hoten'] = $row['hoten'];
				$_SESSION['loaitaikhoan'] = $row['loaitaikhoan'];
				return true;
			}
		}
	}
	return false;
}


function dangKy()
{
	if (isset($_POST['username']) && isset($_POST['password'])) {
		require_once('././db_connect.php');
		$username = $conn->real_escape_string($_POST['username']);
		$password = ($_POST['password']);
		$query = $conn->query("SELECT * FROM `taikhoan` WHERE `taikhoan` = '$username'");
		if ($query && $query->num_rows > 0) {
			return false;
		} else {
			$query = $conn->query("INSERT INTO `taikhoan` (`taikhoan`, `matkhau`,`loaitaikhoan`) VALUES ('$username', '$password','Bình thường')");
			if ($query) {
				return true;
			}
		}
	}
	return false;
}

function checkOldPass()
{
	$matkhaucu = ($_POST['matkhaucu']);
	if ($matkhaucu == $_SESSION['matkhau']) {
		return true;
	}
	return false;
}
function checkSamePass()
{
	$matkhaumoi = ($_POST['matkhaumoi']);
	if ($matkhaumoi != $_SESSION['matkhau']) {
		return true;
	}
	return false;
}
function checkValidPass()
{
	$matkhaumoi = ($_POST['matkhaumoi']);
	$matkhauxacnhan = ($_POST['matkhauxacnhan']);
	if ($matkhaumoi == $matkhauxacnhan) {
		return true;
	}
	return false;
}
