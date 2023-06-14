<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$title = "Quản lý khách hàng";
require_once('./db_connect.php');
require_once('./include/function.php');
require_once('./header.php');

$queryinsert = 0;
if (isset($_POST['type']) && $_POST['type'] == 'insert') {
    $queryinsert = mysqli_query($conn, "INSERT INTO `thongtinkhachhang`(`idkh`, `hoten`, `username`, `password`, `thoigiandangky`, `loaikhachhang`) VALUES (NULL, '" . $_POST['hoten'] . "', '" . $_POST['taikhoan'] . "', '" . $_POST['matkhau'] . "', CURRENT_TIMESTAMP, '" . $_POST['loaikhachhang'] . "')");
}
$querydel = 0;
if (isset($_POST['xoaidkh'])) {
    $querydel = mysqli_query($conn, "DELETE FROM `thongtinkhachhang` WHERE `idkh` = '" . $_POST['xoaidkh'] . "'");
}

$queryupdate = 0;
if (isset($_POST['type']) && $_POST['type'] == 'update') {
    $queryupdate = mysqli_query($conn, "UPDATE `thongtinkhachhang` SET `hoten`='" . $_POST['hoten'] . "', `username`='" . $_POST['username'] . "',`password`='" . $_POST['password'] . "', `loaikhachhang`='" . $_POST['loaikhachhang'] . "' WHERE `idkh`='" . $_POST['id'] . "'");
}

$querykhachhang = mysqli_query($conn, "SELECT * FROM `thongtinkhachhang` WHERE 1");

if ($queryinsert) {
    echo "<script>Swal.fire('Thành công!','Đã thêm thông tin khách hàng!','success');</script>";
}
elseif ($queryinsert !== 0) {
    echo "<script>Swal.fire('Thất bại!','Không thể thêm thông tin khách hàng!','error');</script>";
}

if ($queryupdate){
    echo "<script>Swal.fire('Thành công!','Đã cập nhật thông tin khách hàng!','success');</script>";

}
elseif ($queryupdate !== 0) {
    echo "<script>Swal.fire('Thất bại!','Không thể cập nhật thông tin khách hàng!','error');</script>";
}
if ($querydel) {
    echo "<script>Swal.fire('Thành công!','Đã xóa thông tin khách hàng!','success');</script>";
}
elseif ($querydel !== 0) {
    echo "<script>Swal.fire('Thất bại!','Không thể xóa thông tin khách hàng!','error');</script>";
}
?>


<div class="row">
    <button id="submit" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal" data-title="Thêm thông tin khách hàng" data-type="insert"><i class="fa fa-plus"></i> Thêm khách hàng</button>
    <table id="datatable" style="width:100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Thao tác</th>
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
            if ($querykhachhang && $querykhachhang->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($querykhachhang)) {
            ?>
                    <tr>
                    <td>
                            <a href="#" class="btn btn-sm btn-success mb-1" title="Sửa" data-toggle="modal" data-target="#exampleModal" data-title="Cập nhật thông tin khách hàng" data-type="update" data-idkh="<?= $row['idkh'] ?>" data-hoten="<?= $row['hoten'] ?>" data-username="<?= $row['username'] ?>" data-password="<?= $row['password'] ?>" data-thoigiandangky="<?= $row['thoigiandangky'] ?>" data-loaikhachhang="<?= $row['loaikhachhang'] ?>">
                                <i class="fa fa-pencil"></i> 
                            </a>
                            <a href="#" class="btn btn-sm btn-danger mb-1" title="Xóa" data-toggle="modal" data-target="#exampleModal2" data-hoten="<?= $row['hoten'] ?>" data-idkh="<?= $row['idkh'] ?>">
                                <i class="fa fa-trash"></i> 
                            </a>
                        </td>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" action="">
            <input type="hidden" name="type" id="type">
            <input type="hidden" name="id" id="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="hoten" class="form-label">Họ tên: </label>
                            <input required type="text" name="hoten" id="hoten" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="form-group col-6">
                            <label for="idkh" class="form-label">Số điện thoại: </label>
                            <input required type="tel" name="idkh" id="idkh" class="form-control" pattern="[0-9]{10}">
                        </div> -->
                        <div class="form-group col-6">
                            <label for="loaikhachhang" class="form-label">Loại khách hàng: </label>
                            <select required class="form-control" name="loaikhachhang" id="loaikhachhang" style="width: 100%">
                                <option value="Bình thường">Bình thường</option>
                                <option value="Thân thuộc">Thân thuộc</option>
                                <option value="VIP">VIP</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="taikhoan" class="form-label">Tài khoản: </label>
                            <textarea required name="taikhoan" id="taikhoan" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <label for="matkhau" class="form-label">Mật khẩu: </label>
                            <textarea required name="matkhau" id="matkhau" class="form-control" rows="3"></textarea>
                        </div>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa thông tin khách hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="msgxoa"></p>
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    <input type="hidden" name="xoaidkh" value="" id="xoaidkh">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Đóng</button>
                    <button class="btn btn-primary"><i class="fa fa-trash"></i> Chấp nhận</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    //sua
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        modal.find('.modal-title').text(button.data('title'))
        modal.find('#type').val(button.data('type'))
        modal.find('#id').val(button.data('idkh'))
        modal.find('#idkh').val(button.data('idkh'))
        modal.find('#hoten').val(button.data('hoten'))
        modal.find('#taikhoan').val(button.data('taikhoan'))
        modal.find('#matkhau').val(button.data('matkhau'))
        modal.find('#loaikhachhang').val(button.data('loaikhachhang'))
        modal.find('#thoigiandangky').val(button.data('thoigiandangky'))
    })

    //xoa
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var hoten = button.data('hoten')
        var idkh = button.data('idkh')
        var modal = $(this)
        modal.find('#xoaidkh').val(idkh)
        modal.find('#msgxoa').html("Bạn chắc muốn xóa <b>" + hoten+"</b>? Sau khi xóa bạn sẽ không thể khôi phục lại được.<br/> - Nếu <b>đồng ý</b> xóa, hãy nhấn <b>chấp nhận</b>.<br/> - Nếu <b>không đồng ý</b> xóa, hãy nhấn <b>đóng</b>.")
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