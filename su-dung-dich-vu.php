<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$title = "Sử dụng dịch vụ";
require_once('./db_connect.php');
require_once('./include/function.php');
require_once('./header.php');

$queryinsert = 0;
if (isset($_POST['type']) && $_POST['type'] == 'insert') {
    $queryinsert = mysqli_query($conn, "INSERT INTO `sudungdichvu`(`idsd`, `idmay`, `iddv`, `gia`) VALUES (NULL, '" . $_POST['idmay'] . "', '" . $_POST['iddv'] . "', '" . $_POST['gia'] . "')");
}

$querysddv = mysqli_query($conn, "SELECT * FROM `sudungdichvu` WHERE 1");


?>

<div class="row">
    <button id="submit" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal" data-title="Thêm thông tin dịch vụ" data-type="insert"><i class="fa fa-plus"></i> Thêm dịch vụ</button>
    <table id="datatable" style="width:100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Máy</th>
                <th>ID Dịch vụ</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($querysddv && $querysddv->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($querysddv)) {
            ?>
                    <tr>
 
                        <td><?= $row['idsd'] ?></td>
                        <td><?= $row['idmay'] ?></td>
                        <td><?= $row['iddv'] ?></td>
                        <td><?= $row['gia'] ?></td>
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
        $('#datatable').DataTable({
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