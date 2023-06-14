<?php
session_start();
$title = "Thống kê doanh thu";
require_once('./header.php');
require_once('./db_connect.php');

$thongke = array();
$style = ['danger', 'success', 'warning', 'info', 'primary'];

$query = mysqli_query($conn, "SELECT `giaodich`.`idkhachhang`, `giaodich`.`idmay`, `giaodich`.`thoigianbatdau`, `giaodich`.`thoigianketthuc`, `giaodich`.`giamgia`, `giatien`.`gia` FROM `giaodich`, `giatien` WHERE  `giaodich`.`idgiatien` = `giatien`.`idgiatien` AND DATE_FORMAT(`giaodich`.`thoigianketthuc`, '%Y-%m-%d') = CURDATE()");
$thongke['homnay'] = 0;
$thongke['tuannay'] = 0;
$thongke['thangnay'] = 0;
$thongke['namnay'] = 0;
if ($query && $query->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $thongke['homnay'] += ceil(((strtotime($row['thoigianketthuc']) - strtotime($row['thoigianbatdau'])) / 3600) * $row['gia'] * ((100 - $row['giamgia']) / 100));
    }
}

$query = mysqli_query($conn, "SELECT `giaodich`.`idkhachhang`, `giaodich`.`idmay`, `giaodich`.`thoigianbatdau`, `giaodich`.`thoigianketthuc`, `giaodich`.`giamgia`, `giatien`.`gia` FROM `giaodich`, `giatien` WHERE  `giaodich`.`idgiatien` = `giatien`.`idgiatien` AND DATE_FORMAT(`giaodich`.`thoigianketthuc`, '%Y%m%d') > CURDATE()-DAYOFWEEK(CURDATE())");
if ($query && $query->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $thongke['tuannay'] += ceil(((strtotime($row['thoigianketthuc']) - strtotime($row['thoigianbatdau'])) / 3600) * $row['gia'] * ((100 - $row['giamgia']) / 100));
    }
}


$query = mysqli_query($conn, "SELECT `giaodich`.`idkhachhang`, `giaodich`.`idmay`, `giaodich`.`thoigianbatdau`, `giaodich`.`thoigianketthuc`, `giaodich`.`giamgia`, `giatien`.`gia` FROM `giaodich`, `giatien` WHERE   `giaodich`.`idgiatien` = `giatien`.`idgiatien` AND DATE_FORMAT(`giaodich`.`thoigianketthuc`, '%Y%m%d') > CURDATE()-DAYOFMONTH(CURDATE())");
if ($query && $query->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $thongke['thangnay'] += ceil(((strtotime($row['thoigianketthuc']) - strtotime($row['thoigianbatdau'])) / 3600) * $row['gia'] * ((100 - $row['giamgia']) / 100));
    }
}

$query = mysqli_query($conn, "SELECT `giaodich`.`idkhachhang`, `giaodich`.`idmay`, `giaodich`.`thoigianbatdau`, `giaodich`.`thoigianketthuc`, `giaodich`.`giamgia`, `giatien`.`gia` FROM `giaodich`, `giatien` WHERE  `giaodich`.`idgiatien` = `giatien`.`idgiatien` AND DATE_FORMAT(`giaodich`.`thoigianketthuc`, '%Y%m%d') > CURDATE()-DAYOFYEAR(CURDATE())");
if ($query && $query->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $thongke['namnay'] += ceil(((strtotime($row['thoigianketthuc']) - strtotime($row['thoigianbatdau'])) / 3600) * $row['gia'] * ((100 - $row['giamgia']) / 100));
    }
}

$sql_thongke_theo_tuan = "SELECT DATE_FORMAT(`giaodich`.`thoigianketthuc`, '%d/%m/%Y') AS Label, SUM(TIMESTAMPDIFF(HOUR, thoigianbatdau, thoigianketthuc)* gia * ((100 - giamgia) / 100)) AS Value FROM `giaodich`, `giatien` WHERE  `giaodich`.`idgiatien` = `giatien`.`idgiatien` GROUP BY DATE_FORMAT(`giaodich`.`thoigianketthuc`, '%Y%m%d') LIMIT 30;";
$query = mysqli_query($conn, $sql_thongke_theo_tuan);
$thongke_theo_tuan = array();
if ($query && $query->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $thongke_theo_tuan[] = $row;
    }
}
$thongke_theo_tuan = json_encode($thongke_theo_tuan);


$sql_thongke_theo_thang = "SELECT DATE_FORMAT(`giaodich`.`thoigianketthuc`, '%m') AS Label, SUM(TIMESTAMPDIFF(HOUR, thoigianbatdau, thoigianketthuc)* gia * ((100 - giamgia) / 100)) AS Value FROM `giaodich`, `giatien` WHERE  `giaodich`.`idgiatien` = `giatien`.`idgiatien` GROUP BY DATE_FORMAT(`giaodich`.`thoigianketthuc`, '%Y%m') LIMIT 12;";
$query = mysqli_query($conn, $sql_thongke_theo_thang);
$thongke_theo_thang = array();
if ($query && $query->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $thongke_theo_thang[] = $row;
    }
}
$thongke_theo_thang = json_encode($thongke_theo_thang);

$sql_thongke_theo_nam = "SELECT DATE_FORMAT(`giaodich`.`thoigianketthuc`, '%Y') AS Label, SUM(TIMESTAMPDIFF(HOUR, thoigianbatdau, thoigianketthuc)* gia * ((100 - giamgia) / 100)) AS Value FROM `giaodich`, `giatien` WHERE  `giaodich`.`idgiatien` = `giatien`.`idgiatien` GROUP BY DATE_FORMAT(`giaodich`.`thoigianketthuc`, '%Y');";
$query = mysqli_query($conn, $sql_thongke_theo_nam);
$thongke_theo_nam = array();
if ($query && $query->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $thongke_theo_nam[] = $row;
    }
}
$thongke_theo_nam = json_encode($thongke_theo_nam);
?>
<head>
    <style>
        .table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 1rem;
                color: #212529;
                font-size: 0.9rem;
                }

                .table th, .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
                }

                .table th {
                font-weight: bold;
                text-align: left;
                background-color: #f8f9fa;
                }

                .table tbody tr:nth-of-type(even) {
                background-color: #f8f9fa;
                }

                .table tbody tr:hover {
                background-color: #e9ecef;
                }
    </style>
</head>

<script>
    var thongke_theo_tuan = <?php echo $thongke_theo_tuan; ?>;
    var thongke_theo_thang = <?php echo $thongke_theo_thang; ?>;
    var thongke_theo_nam = <?php echo $thongke_theo_nam; ?>;
</script>
<!-- Thống kê chung -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4" data-aos="flip-up" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Hôm nay</div>
                        <div class="div mb-0 font-weight-bold text-gray-800"><?= $thongke['homnay'] ?>.000 đ</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-refresh fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!--  (Theo Tuần)  -->
    <div class="col-xl-3 col-md-6 mb-4" data-aos="flip-up" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-success text-uppercase mb-1">Tuần này</div>
                        <div class="div mb-0 font-weight-bold text-gray-800"><?= $thongke['tuannay'] ?>.000 đ</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-refresh fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  (Theo tháng)  -->
    <div class="col-xl-3 col-md-6 mb-4" data-aos="flip-up" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-info text-uppercase mb-1">Tháng này</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="div mb-0 mr-3 font-weight-bold text-gray-800"><?= $thongke['thangnay'] ?>.000 đ</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-refresh fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
 

    <!-- (Theo năm)  -->
    <div class="col-xl-3 col-md-6 mb-4" data-aos="flip-up" data-aos-easing="ease-out-cubic" data-aos-duration="1000">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">Năm nay</div>
                        <div class="div mb-0 font-weight-bold text-gray-800"><?= $thongke['namnay'] ?>.000 đ</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-refresh fa-2x text-gray-500"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-danger">Biểu đồ</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-2 text-right">
                        <label for="thang" class="mt-2">Thống kê theo:</label>
                    </div>
                    <div class="col-md-2">
                        <select name="thongke" id="thongke" class="form-control" style="width: 100px">
                            <option value="ngày">Ngày</option>
                            <option value="tháng">Tháng</option>
                            <option value="năm">Năm</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------- THONG KE THEO NGAY--------------------------------------------->
<h1>Thống kê theo ngày</h1>
<div class="row">

        <table class="table">
        <thead>
            <tr>
            <th>Máy</th>
            <th>Ngày</th>
            <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT idmay, DATE(thoigianketthuc) as ngay, SUM(tien) - SUM(tiendv) as tien FROM giaodich GROUP BY idmay, DATE(thoigianketthuc)");
            while($row=mysqli_fetch_array($query)){
            ?>
            <tr>
            <td>Máy <?php echo $row['idmay']?></td>
            <td><?php echo $row['ngay']?></td>
            <td><?php echo $row['tien']?> đ</td>
            </tr>
            <?php
            }
            ?>
        </tbody>
        </table>
</div>

<!------------------------------------------- THONG KÊ THEO THÁNG------------------------------------------------------------------------>
<h1>Thống kê theo Tháng</h1>

<div class="row">

    <table class="table">
    <thead>
        <tr>
        <th>Máy</th>
        <th>Tháng</th>
        <th>Tổng tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = mysqli_query($conn, "SELECT idmay, DATE_FORMAT(thoigianketthuc, '%Y-%m') as thang, SUM(tien) - SUM(tiendv) as tien FROM giaodich GROUP BY idmay, DATE_FORMAT(thoigianketthuc, '%Y-%m')");
        while($row=mysqli_fetch_array($query)){
        ?>
        <tr>
        <td>Máy <?php echo $row['idmay']?></td>
        <td><?php echo $row['thang']?></td>
        <td><?php echo $row['tien']?> đ</td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    </table>
</div>

<!---------------------------------- THONG KÊ THEO THÁNG------------------------------------------------------------------------>
<h1>Thống kê theo Năm</h1>
<div class="row">
    <table class="table">
    <thead>
        <tr>
        <th>Máy</th>
        <th>Năm</th>
        <th>Tổng tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = mysqli_query($conn, "SELECT idmay, YEAR(thoigianketthuc) as nam, SUM(tien) as tien FROM giaodich GROUP BY idmay, YEAR(thoigianketthuc)");
        while($row=mysqli_fetch_array($query)){
        ?>
        <tr>
        <td>Máy <?php echo $row['idmay']?></td>
        <td><?php echo $row['nam']?></td>
        <td><?php echo $row['tien']?> đ</td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    </table>
</div>
   

<script>
    var xvalue =[];
    var yvalue =[];
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart;
    function VeBieuDo(data) {
        xvalue =[];
        yvalue =[];
        for (var i = 0; i < data.length; i++) {
            xvalue.push(data[i].Label);
            yvalue.push(data[i].Value);
        }

        if (myChart != undefined)
            myChart.destroy();

        myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: xvalue,
                datasets: [{
                    label: 'Doanh thu',
                    data: yvalue,
                    backgroundColor: [
                        'rgba(99, 132, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(99, 132, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: (ctx) => 'Biểu đồ doanh thu theo '+ $('#thongke').val(),
                    }
                }
            }
        });
    }
    $('#thongke').change(function () {
        switch ($(this).val()) {
            case 'ngày':
                VeBieuDo(thongke_theo_tuan);
                break;
            case 'tháng':
                VeBieuDo(thongke_theo_thang);
                break;
            case 'năm':
                VeBieuDo(thongke_theo_nam);
                break;
        }
    });
    VeBieuDo(thongke_theo_tuan);
</script>
<?php
require_once('./footer.php');
?>