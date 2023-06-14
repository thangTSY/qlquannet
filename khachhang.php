<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$title = "Quản lý quán net";
require_once('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?></title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/styleDatatable.css">
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="//cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
  <!-- select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://hotrolaptrinh.github.io/js/tech/tech.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>  
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
	<style>
	/* .inner-page{
		background: rgba(55, 209, 142, 0.5);
	} */
	.breadcrumbs{
		background: rgba(58, 200, 100, 0.5);
	}
	.card-body{
		background: rgba(58, 200, 100, 0.5);
	}
	</style>
</head>
<div class="row">
	<?php
	$query = mysqli_query($conn, "SELECT * FROM `maytinh` WHERE 1 ORDER BY `tenmay` ASC");
	if ($query && $query->num_rows > 0) :
		while ($maytinh = mysqli_fetch_assoc($query)) :
			if ($maytinh['tinhtrang'] == 'Hỏng') :
	?>
				<div class="col-xl-2 col-md-4 col-6 mb-4"data-aos="zoom-in">
					<div class="card">
						<img src="./assets/img/settings.png" width="100px" class="card-img-top" alt="Máy đang gặp sự cố">
						<div class="card-body">
							<p class="font-weight-bold text-primary text-center"><?= $maytinh['tenmay'] ?></p>
							<p class="text-danger text-center">Máy hỏng</p>
						</div>
					</div>
				</div>
				<?php
			else :
				$querygiaodich = mysqli_query($conn, "SELECT * FROM `giaodich`, `giatien` WHERE `idmay`='" . $maytinh['idmay'] . "' AND `giatien`.`idgiatien`=`giaodich`.`idgiatien` ORDER BY `thoigianbatdau` DESC LIMIT 1");
				if ($querygiaodich && $querygiaodich->num_rows > 0) :
					$giaodich = mysqli_fetch_assoc($querygiaodich);
					if ($giaodich['thoigianketthuc'] == "0000-00-00 00:00:00") :
				?>
						<div class="col-xl-2 col-md-4 col-6 mb-4" data-aos="zoom-in">
							<!-- <a class="card" href="./ql-giao-dich.php?may=<?= $maytinh['idmay'] ?>"> -->
							<a class="card" href="">
								<img src="./assets/img/computer-used.png" width="100px" class="card-img-top" alt="máy đang sử dụng">
								<div class="card-body">
									<div class="font-weight-bold text-primary text-center"><?= $maytinh['tenmay'] ?></div>
									<div class="text-info text-center">Đang sử dụng</div>
								</div>
							</a>
						</div>
					<?php
					else :
					?>
						<div class="col-xl-2 col-md-4 col-6 mb-4" data-aos="zoom-in">
							<a class="card text-center" href="khach/login1.php?may=<?= $maytinh['idmay'] ?>">
								<img src="./assets/img/computer.svg" width="100px" class="card-img-top" alt="máy trống">
								<div class="card-body">
									<p class="font-weight-bold text-primary text-center"><?= $maytinh['tenmay'] ?></p>
									<small class="text-second text-center">Máy trống</small>
								</div>
							</a>
						</div>
					<?php
					endif;
				else :
					?>
					<div class="col-xl-2 col-md-4 col-6 mb-4" data-aos="zoom-in">
						<a class="card text-center" href="khach/login1.php?may=<?= $maytinh['idmay'] ?>">
							<img src="./assets/img/computer.svg" width="100px" class="card-img-top" alt="máy trống">
							<div class="card-body">
								<p class="font-weight-bold text-primary text-center"><?= $maytinh['tenmay'] ?></p>
								<small class="text-second text-center">Máy trống</small>
							</div>
						</a>
					</div>
	<?php
				endif;
			endif;
		endwhile;
	endif;
	?>
</div>
<?php
require_once('./footer.php');
?>