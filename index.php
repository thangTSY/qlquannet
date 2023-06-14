<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$title = "Quản lý quán net";
require_once('./header.php');
require_once('./db_connect.php');
?>
<head>
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
							<a class="card" href="./ql-giao-dich.php?may=<?= $maytinh['idmay'] ?>">
								<img src="./assets/img/computer-used.png" width="100px" class="card-img-top" alt="máy đang sử dụng">
								<div class="card-body">
									<div class="font-weight-bold text-primary text-center"><?= $maytinh['tenmay'] ?></div>
									<div class="text-info text-center"><?= date("H:i:m", strtotime($giaodich['thoigianbatdau'])); ?></div>
									<div class="text-second text-center"><?php echo ceil(((time() - strtotime($giaodich['thoigianbatdau'])) / 3600) * $giaodich['gia'] * ((100 - $giaodich['giamgia']) / 100)); ?>.000 đ</div>
								</div>
							</a>
						</div>
					<?php
					else :
					?>
						<div class="col-xl-2 col-md-4 col-6 mb-4" data-aos="zoom-in">
							<a class="card text-center" href="them-giao-dich.php?may=<?= $maytinh['idmay'] ?>">
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
						<a class="card text-center" href="./them-giao-dich.php?may=<?= $maytinh['idmay'] ?>">
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