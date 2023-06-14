<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$title = "Quản lý dịch vụ";
require_once('./db_connect.php');
require_once('./include/function.php');
require_once('./header.php');

$queryinsert = 0;
if (isset($_POST['type']) && $_POST['type'] == 'insert') {
    $queryinsert = mysqli_query($conn, "INSERT INTO `dichvu`(`iddv`, `tendv`, `loaidv`, `giadv`) VALUES (NULL, '" . $_POST['tendv'] . "', '" . $_POST['loaidv'] . "', '" . $_POST['giadv'] . "')");
}
$querydel = 0;
if (isset($_POST['xoaiddv'])) {
    $querydel = mysqli_query($conn, "DELETE FROM `dichvu` WHERE `iddv` = '" . $_POST['xoaiddv'] . "'");
}

$queryupdate = 0;
if (isset($_POST['type']) && $_POST['type'] == 'update') {
    $queryupdate = mysqli_query($conn, "UPDATE `dichvu` SET `tendv`='" . $_POST['tendv'] . "',`loaidv`='" . $_POST['loaidv'] . "',`giadv`='" . $_POST['giadv'] . "' WHERE `iddv`='" . $_POST['iddv'] . "'");

}

$querydichvu = mysqli_query($conn, "SELECT * FROM `dichvu` WHERE 1");

if ($queryinsert) {
    echo "<script>Swal.fire('Thành công!','Đã thêm thông tin dịch vụ!','success');</script>";
}
elseif ($queryinsert !== 0) {
    echo "<script>Swal.fire('Thất bại!','Không thể thêm thông tin dịch vụ!','error');</script>";
}

if ($queryupdate){
    echo "<script>Swal.fire('Thành công!','Đã cập nhật thông tin dịch vụ!','success');</script>";

}
elseif ($queryupdate !== 0) {
    echo "<script>Swal.fire('Thất bại!','Không thể cập nhật thông tin dịch vụ!','error');</script>";
}
if ($querydel) {
    echo "<script>Swal.fire('Thành công!','Đã xóa thông tin dịch vụ!','success');</script>";
}
elseif ($querydel !== 0) {
    echo "<script>Swal.fire('Thất bại!','Không thể xóa thông tin dịch vụ!','error');</script>";
}
?>

<div class="row">
    <button id="submit" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal" data-title="Thêm thông tin dịch vụ" data-type="insert"><i class="fa fa-plus"></i> Thêm dịch vụ</button>
    <table id="datatable" style="width:100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Thao tác</th>
                <th>ID</th>
                <th>Tên dv</th>
                <th>loạidv</th>
                <th>Giá dv</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($querydichvu && $querydichvu->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($querydichvu)) {
            ?>
                    <tr>
                    <td>
                            <a href="#" class="btn btn-sm btn-success mb-1" title="Sửa" data-toggle="modal" data-target="#exampleModal" data-title="Cập nhật thông tin dịch vụ" data-type="update" data-id="<?= $row['iddv'] ?>" data-tendv="<?= $row['tendv'] ?>" data-loaidv="<?= $row['loaidv'] ?>" data-giadv="<?= $row['giadv'] ?>">
                                <i class="fa fa-pencil"></i> 
                            </a>
                            <a href="#" class="btn btn-sm btn-danger mb-1" title="Xóa" data-toggle="modal" data-target="#exampleModal2" data-tendv="<?= $row['tendv'] ?>" data-id="<?= $row['iddv'] ?>">
                                <i class="fa fa-trash"></i> 
                            </a>
                        </td>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" action="">
            <input type="hidden" name="type" id="type">
            <input type="hidden" name="iddv" id="iddv">
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
                            <label for="tendv" class="form-label">Tên dv: </label>
                            <input required type="text" name="tendv" id="tendv" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="form-group col-6">
                            <label for="id" class="form-label">Số điện thoại: </label>
                            <input required type="tel" name="id" id="id" class="form-control" pattern="[0-9]{10}">
                        </div> -->
                        <div class="form-group col-6">
                            <label for="loaidv" class="form-label">Loại dịch vụ: </label>
                            <select required class="form-control" name="loaidv" id="loaidv" style="width: 100%">
                                <option value="Đồ uống">Đồ uống</option>
                                <option value="Đồ ăn">Đồ ăn</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="giadv" class="form-label">Giá  dịch vụ: </label>
                            <textarea required name="giadv" id="giadv" class="form-control" rows="3"></textarea>
                        </div>
                        <!-- <div class="form-group col-12">
                            <label for="ghichu" class="form-label">Ghi chú: </label>
                            <textarea required name="ghichu" id="ghichu" class="form-control"></textarea>
                        </div> -->
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
                <h5 class="modal-title" id="exampleModalLabel">Xóa thông tin dịch vụ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="msgxoa"></p>
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    <input type="hidden" name="xoaiddv" value="" id="xoaiddv">
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
        modal.find('#id').val(button.data('iddv'))
        modal.find('#iddv').val(button.data('iddv'))
        modal.find('#tendv').val(button.data('tendv'))
        modal.find('#loaidv').val(button.data('loaidv'))
        modal.find('#giadv').val(button.data('giadv'))
        modal.find('#ghichu').val(button.data('ghichu'))
    })

    //xoa
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var tendv = button.data('tendv')
        var id = button.data('iddv')
        var modal = $(this)
        modal.find('#xoaiddv').val(id)
        modal.find('#msgxoa').html("Bạn chắc muốn xóa <b>" + tendv+"</b>? Sau khi xóa bạn sẽ không thể khôi phục lại được.<br/> - Nếu <b>đồng ý</b> xóa, hãy nhấn <b>chấp nhận</b>.<br/> - Nếu <b>không đồng ý</b> xóa, hãy nhấn <b>đóng</b>.")
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