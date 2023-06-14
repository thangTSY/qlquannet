<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$title = "Thống kê khách hàng";
require_once('./db_connect.php');
require_once('./include/function.php');
require_once('./header.php');


?>
<div class="row mb-5">
    <h2>Khách hàng bình thường</h2>
    <table id="datatable1" style="width:100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Tài khoản</th>
                <th>Mật khẩu</th>
                <th>Thời gian gia nhập</th>
                <th>Loại khách hàng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $querykhachhang = mysqli_query($conn, "SELECT * FROM `thongtinkhachhang` WHERE `loaikhachhang` ='Bình thường'");
            if ($querykhachhang && $querykhachhang->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($querykhachhang)) {
            ?>
                    <tr>
                        <td><?= $row['idkh'] ?></td>
                        <td><?= $row['hoten'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['password'] ?></td>
                        <td><?= $row['thoigiandangky'] ?></td>
                        <td><?= $row['loaikhachhang'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<div class="row mb-5">
    <h2>Khách hàng thân thuộc</h2>
    <table id="datatable2" style="width:100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Tài khoản</th>
                <th>Mật khẩu</th>
                <th>Thời gian gia nhập</th>
                <th>Loại khách hàng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $querykhachhang = mysqli_query($conn, "SELECT * FROM `thongtinkhachhang` WHERE `loaikhachhang` ='Thân thuộc'");
            if ($querykhachhang && $querykhachhang->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($querykhachhang)) {
            ?>
                    <tr>
                        <td><?= $row['idkh'] ?></td>
                        <td><?= $row['hoten'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['password'] ?></td>
                        <td><?= $row['thoigiandangky'] ?></td>
                        <td><?= $row['loaikhachhang'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<div class="row">
    <h2>Khách hàng VIP</h2>
    <table id="datatable3" style="width:100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Tài khoản</th>
                <th>Mật khẩu</th>
                <th>Thời gian gia nhập</th>
                <th>Loại khách hàng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $querykhachhang = mysqli_query($conn, "SELECT * FROM `thongtinkhachhang` WHERE `loaikhachhang` ='VIP'");
            if ($querykhachhang && $querykhachhang->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($querykhachhang)) {
            ?>
                    <tr>
                        <td><?= $row['idkh'] ?></td>
                        <td><?= $row['hoten'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['password'] ?></td>
                        <td><?= $row['thoigiandangky'] ?></td>
                        <td><?= $row['loaikhachhang'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#datatable1').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "language": {
                "search": "Tìm kiếm",
                "lengthMenu": "Hiện _MENU_ dòng mỗi trang",
                "zeroRecords": "Không tìm thấy",
                "info": "Dòng (_START_ - _END_) / _TOTAL_ . Trang _PAGE_ / _PAGES_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "paginate": {
                    "first": "Trang đầu",
                    "last": "Trang cuối",
                    "next": "Sau",
                    "previous": "Trước"
                },
            }
        });
        $('#datatable2').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "language": {
                "search": "Tìm kiếm",
                "lengthMenu": "Hiện _MENU_ dòng mỗi trang",
                "zeroRecords": "Không tìm thấy",
                "info": "Dòng (_START_ - _END_) / _TOTAL_ . Trang _PAGE_ / _PAGES_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "paginate": {
                    "first": "Trang đầu",
                    "last": "Trang cuối",
                    "next": "Sau",
                    "previous": "Trước"
                },
            }
        });
        $('#datatable3').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "language": {
                "search": "Tìm kiếm",
                "lengthMenu": "Hiện _MENU_ dòng mỗi trang",
                "zeroRecords": "Không tìm thấy",
                "info": "Dòng (_START_ - _END_) / _TOTAL_ . Trang _PAGE_ / _PAGES_",
                "infoEmpty": "Không có dữ liệu",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "paginate": {
                    "first": "Trang đầu",
                    "last": "Trang cuối",
                    "next": "Sau",
                    "previous": "Trước"
                },
            }
        });
    });
</script>
<?php
require_once('./footer.php');
?>