<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$title = "Quản lý tài khoản";
require_once('./db_connect.php');
require_once('./include/function.php');
require_once('./header.php');

$queryinsert = 0;
if (isset($_POST['type']) && $_POST['type'] == 'insert') {
    $queryinsert = mysqli_query($conn, "INSERT INTO `taikhoan`(`taikhoan`, `matkhau`, `loaitaikhoan`, `ghichu`) VALUES ('" . $_POST['taikhoan'] . "', '" . md5($_POST['matkhau']) . "', '" . $_POST['loaitaikhoan'] . "', '" . $_POST['ghichu'] . "')");
}
$querydel = 0;
if (isset($_POST['xoataikhoan'])) {
    $querydel = mysqli_query($conn, "DELETE FROM `taikhoan` WHERE `taikhoan` = '" . $_POST['xoataikhoan'] . "'");
}

$queryupdate = 0;
if (isset($_POST['type']) && $_POST['type'] == 'update') {
    $queryupdate = mysqli_query($conn, "UPDATE `taikhoan` SET `taikhoan`='" . $_POST['taikhoan'] . "',`matkhau`='" . md5($_POST['matkhau']) . "',`loaitaikhoan`='" . $_POST['loaitaikhoan'] . "',`ghichu`='" . $_POST['ghichu'] . "' WHERE `taikhoan`='" . $_POST['id'] . "'");
}

$querytaikhoan = mysqli_query($conn, "SELECT * FROM `taikhoan` WHERE 1 ORDER BY `taikhoan`.`taikhoan` ASC");

if ($queryinsert) {
    echo "<script>Swal.fire('Thành công!','Đã thêm thông tin tài khoản!','success');</script>";
}
elseif ($queryinsert !== 0) {
    echo "<script>Swal.fire('Thất bại!','Không thể thêm thông tin tài khoản!','error');</script>";
}

if ($queryupdate){
    echo "<script>Swal.fire('Thành công!','Đã cập nhật thông tin tài khoản!','success');</script>";

}
elseif ($queryupdate !== 0) {
    echo "<script>Swal.fire('Thất bại!','Không thể cập nhật thông tin tài khoản!','error');</script>";
}
if ($querydel) {
    echo "<script>Swal.fire('Thành công!','Đã xóa thông tin tài khoản!','success');</script>";
}
elseif ($querydel !== 0) {
    echo "<script>Swal.fire('Thất bại!','Không thể xóa thông tin tài khoản!','error');</script>";
}
?>

<div class="row">
    <button id="submit" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal" data-title="Thêm thông tin khách hàng" data-type="insert"><i class="fa fa-plus"></i> Thêm tài khoản</button>
    <table id="datatable" style="width:100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Thao tác</th>
                <th>Tài khoản</th>
                <th>Mật khẩu</th>
                <th>Loại tài khoản</th>
                <th>Ghi chú</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($querytaikhoan && $querytaikhoan->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($querytaikhoan)) {
            ?>
                    <tr>
                        <td>
                            <a href="#" class="btn btn-sm btn-success mb-1" title="Sửa" data-toggle="modal" data-target="#exampleModal" data-taikhoan="<?= $row['taikhoan'] ?>" data-loaitaikhoan="<?= $row['loaitaikhoan'] ?>" data-ghichu="<?= $row['ghichu'] ?>" data-title="Cập nhật thông tin khách hàng" data-type="update">
                                <i class="fa fa-pencil"></i> Sửa
                            </a>
                            <a href="#" class="btn btn-sm btn-danger mb-1" title="Xóa" data-toggle="modal" data-target="#exampleModal2" data-taikhoan="<?= $row['taikhoan'] ?>">
                                <i class="fa fa-trash"></i> Xóa
                            </a>
                        </td>
                        <td><?= $row['taikhoan'] ?></td>
                        <td>******</td>
                        </td>
                        <td><?= $row['loaitaikhoan'] ?></td>
                        <td><?= $row['ghichu'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" action="">
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="type" id="type">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="taikhoan" class="form-label">Tài khoản: </label>
                        <input type="text" name="taikhoan" id="taikhoan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="matkhau" class="form-label">Mật khẩu: </label>
                        <input type="password" name="matkhau" id="matkhau" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="loaitaikhoan" class="form-label">Loại tài khoản: </label>
                        <select class="form-control" name="loaitaikhoan" id="loaitaikhoan" required>
                            <option value="Quản trị">Quản trị</option>
                            <option value="Bình thường">Bình thường</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="loaitaikhoan" class="form-label">Ghi chú: </label>
                        <textarea class="form-control" name="ghichu" id="ghichu" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Đóng</button>
                    <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-save"></i> Lưu và đóng</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="msgxoa"></p>
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <input type="hidden" name="xoataikhoan" value="" id="xoataikhoan">
                    <button type="submit" class="btn btn-primary">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    //
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        modal.find('#type').val(button.data('type'))
        modal.find('.modal-title').text(button.data('title'))
        modal.find('#taikhoan').val(button.data('taikhoan'))
        modal.find('#id').val(button.data('taikhoan'))
        modal.find('#loaitaikhoan').val(button.data('loaitaikhoan')).change()
        modal.find('#ghichu').val(button.data('ghichu'))
    })

    //xoa
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var taikhoan = button.data('taikhoan')
        var modal = $(this)
        modal.find('#xoataikhoan').val(taikhoan)
        modal.find('.modal-title').text('Xóa ' + taikhoan)
        modal.find('#msgxoa').text("Bạn chắc muốn xóa " + taikhoan)
    })

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