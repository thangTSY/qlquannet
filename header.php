<?php
if (!isset($_SESSION['taikhoan']) || $_SESSION['taikhoan'] == "")
  header("Location: ./dang-nhap.php");
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
  

</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container-fluid">

      <div class="row justify-content-center">
        <div class="col-xl-9 d-flex align-items-center">
          <h1 class="logo mr-auto"><a href="index.php">VINH.NET</a></h1>

          <nav class="nav-menu d-none d-lg-block">
            <ul id="menuHeader">
              <li><a href="./index.php" data="index">Trang chủ</a></li>
              <li><a href="./ql-may-tinh.php" data="ql-may-tinh">QL máy tính</a></li>
              <li><a href="./ql-khach-hang.php" data="ql-khach-hang">QL khách hàng</a></li>
              <li><a href="./ql-gia-tien.php" data="ql-gia-tien">QL giá tiền</a></li>
              <li><a href="./ql-tai-khoan.php" data="ql-tai-khoan">QL tài khoản</a></li>
              <li class="drop-down"><a href="javascript:void(0);" data="thong-ke-doanh-thu thong-ke-khach-hang">Dịch vụ</a>
                <ul>
                <li><a href="./ql-dich-vu.php" data="ql-dich-vu">QL dịch vụ</a></li>
                <li><a href="./su-dung-dich-vu.php" data="su-dung-dich-vu.php">Dịch vụ khách sử dụng</a></li>

                </ul>
              </li>
               
              </li>
              <li class="drop-down"><a href="javascript:void(0);" data="thong-ke-doanh-thu thong-ke-khach-hang">Thống kê</a>
                <ul>
                  <li><a href="./thong-ke-doanh-thu.php">Thống kê doanh thu</a></li>
                  <li><a href="./thong-ke-khach-hang.php">Thống kê khách hàng</a></li>
                  <li><a href="./thong-ke-dich-vu.php">Thống kê dịch vụ</a></li>
                </ul>
              </li>
            </ul>
          </nav><!-- .nav-menu -->
          <a href="dang-xuat.php" class="get-started-btn scrollto">Đăng xuất</a>
        </div>
      </div>

    </div>
  </header>
  <!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">

    </section>
    <!-- End Breadcrumbs -->
    <section class="inner-page">
      <div class="container">