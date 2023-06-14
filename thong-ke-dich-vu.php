<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$title = "Thống kê khách hàng";
require_once('./db_connect.php');
require_once('./include/function.php');
require_once('./header.php');


?>
<div class="row mb-5">
    <h2>Đồ uống</h2>
    <table id="datatable1" style="width:100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên dịch vụ</th>
                <th>Loại dịch vụ</th>
                <th>Giá dịch vụ</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $querydichvu = mysqli_query($conn, "SELECT * FROM `dichvu` WHERE `loaidv` ='Đồ uống'");
            if ($querydichvu && $querydichvu->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($querydichvu)) {
            ?>
                    <tr>
                        <td><?= $row['iddv'] ?></td>
                        <td><?= $row['tendv'] ?></td>
                        <td><?= $row['loaidv'] ?></td>
                        <td><?= $row['giadv'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<div class="row mb-5">
    <h2>Đồ ăn</h2>
    <table id="datatable2" style="width:100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên dịch vụ</th>
                <th>Loại dịch vụ</th>
                <th>Giá dịch vụ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $querydichvu = mysqli_query($conn, "SELECT * FROM `dichvu` WHERE `loaidv` ='Đồ ăn'");
            if ($querydichvu && $querydichvu->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($querydichvu)) {
            ?>
                    <tr>
                        <td><?= $row['iddv'] ?></td>
                        <td><?= $row['tendv'] ?></td>
                        <td><?= $row['loaidv'] ?></td>
                        <td><?= $row['giadv'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<div class="row">
    <h2>Dịch vụ khác</h2>
    <table id="datatable3" style="width:100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên dịch vụ</th>
                <th>Loại dịch vụ</th>
                <th>Giá dịch vụ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $querydichvu = mysqli_query($conn, "SELECT * FROM `dichvu` WHERE `loaidv` ='Khác'");
            if ($querydichvu && $querydichvu->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($querydichvu)) {
            ?>
                    <tr>
                        <td><?= $row['iddv'] ?></td>
                        <td><?= $row['tendv'] ?></td>
                        <td><?= $row['loaidv'] ?></td>
                        <td><?= $row['giadv'] ?></td>
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