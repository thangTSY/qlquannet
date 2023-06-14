<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$title = "Quản lý khách hàng";
require_once('./db_connect.php');
require_once('./include/function.php');
require_once('./header.php');

$queryinsert = 0;
if (isset($_POST['type']) && $_POST['type'] == 'insert') {
    $queryinsert = mysqli_query($conn, "INSERT INTO `danhmuc`(`ID`, `MaDanhMuc`, `TenDanhMuc`, `Loai`) VALUES ('" . $_POST['id'] . "',, '" . $_POST['madanhmuc'] . "',, '" . $_POST['tendanhmuc'] . "',, '" . $_POST['loai'] . "')");
}
$querydel = 0;
if (isset($_POST['xoasdt'])) {
    $querydel = mysqli_query($conn, "DELETE FROM `danhmuc` WHERE `ID` = '" . $_POST['id'] . "'");
}

$queryupdate = 0;
if (isset($_POST['type']) && $_POST['type'] == 'update') {
    $queryupdate = mysqli_query($conn, "UPDATE `danhmuc` SET `MaDanhMuc`= '" . $_POST['madanhmuc'] . "',`TenDanhMuc`= '" . $_POST['tendanhmuc'] . "',`Loai`= '" . $_POST['loai'] . "' WHERE `ID` = '" . $_POST['id'] . "'");
}

$querykhachhang = mysqli_query($conn, "SELECT * FROM `danhmuc` WHERE 1");

?>
<form action="" method="post" class="mb-3">
    <div class="row mb-3">
        <div class="col-12">
            <label for="sdt" class="form-label">Mã danh mục: </label>
            <input required name="MaDanhMuc" id="MaDanhMuc" class="form-control">
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-12">
            <label for="sdt" class="form-label">Tên danh mục: </label>
            <input required name="TenDanhMuc" id="TenDanhMuc" class="form-control">
        </div>
    </div>


    <div class="col-12">
            <label for="sdt" class="form-label">Loại: </label>
            <input required name="loai" id="loai" class="form-control">
        </div>
    </div>

    

        <div class="col-2">
            <input type="submit" value="Thêm khách hàng" id="submit" name="submit" class="btn btn-primary mt-4">
        </div>
    </div>
    <div class="row">
        <div class="col-10">
        </div>
    </div>
    <div class="col-12 mt-2">
        <?php
        if ($queryinsert) :
        ?>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Thành công!</strong> Đã thêm khách hàng.
            </div>
        <?php
        elseif ($queryinsert !== 0) :
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Lỗi!</strong> Không thể thêm khách hàng.
            </div>
        <?php
        endif
        ?>

        <?php
        if ($queryupdate) :
        ?>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Thành công!</strong> Đã lưu thay đổi.
            </div>
        <?php
        elseif ($queryupdate !== 0) :
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Lỗi!</strong> Không thể cập nhật.
            </div>
        <?php
        endif
        ?>

        <?php
        if ($querydel) :
        ?>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Thành công!</strong> Đã xóa khách hàng.
            </div>
        <?php
        elseif ($querydel !== 0) :
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Lỗi!</strong> Không thể xóa khách hàng.
            </div>
        <?php
        endif
        ?>

    </div>
</form>

<div class="row">
    <h2>Danh sách khách hàng</h2>
    <table id="datatable" style="width:100%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Số điện thoại</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Địa chỉ</th>
                <th>Thời gian gia nhập</th>
                <th>Loại khách hàng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($querykhachhang && $querykhachhang->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($querykhachhang)) {
            ?>
                    <tr>
                        <td><?= $row['sdt'] ?></td>
                        <td><?= $row['hoten'] ?></td>
                        <td><?= $row['ngaysinh'] ?></td>
                        <td><?= $row['gioitinh'] ?></td>
                        <td><?= $row['diachi'] ?></td>
                        <td><?= $row['thoigiandangky'] ?></td>
                        <td><?= $row['loaikhachhang'] ?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-success mb-1" title="Sửa" data-toggle="modal" data-target="#exampleModal" data-sdt="<?= $row['sdt'] ?>" data-hoten="<?= $row['hoten'] ?>" data-ngaysinh="<?= $row['ngaysinh'] ?>" data-gioitinh="<?= $row['gioitinh'] ?>" data-diachi="<?= $row['diachi'] ?>" data-thoigiandangky="<?= $row['thoigiandangky'] ?>" data-loaikhachhang="<?= $row['loaikhachhang'] ?>">
                                <i class="fa fa-pencil"></i> Sửa
                            </a>
                            <a href="#" class="btn btn-sm btn-danger mb-1" title="Xóa" data-toggle="modal" data-target="#exampleModal2" data-hoten="<?= $row['hoten'] ?>" data-sdt="<?= $row['sdt'] ?>">
                                <i class="fa fa-trash"></i> Xóa
                            </a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="">
            <input type="hidden" name="suaid" id="suaid">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="suasdt" class="form-label">Số điện thoại: </label>
                        <input required type="tel" name="suasdt" id="suasdt" class="form-control" pattern="[0-9]{10}">
                    </div>
                    <div class="form-group">
                        <label for="suahoten" class="form-label">Họ tên: </label>
                        <input required type="text" name="suahoten" id="suahoten" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="suagioitinh" class="form-label">Giới tính: </label>
                        <select class="form-control" name="suagioitinh" id="suagioitinh">
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="suangaysinh" class="form-label">Ngày sinh: </label>
                        <input required type="date" name="suangaysinh" id="suangaysinh" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="suadiachi" class="form-label">Địa chỉ: </label>
                        <input required type="text" name="suadiachi" id="suadiachi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sualoaikhachhang" class="form-label">Loại khách hàng: </label>
                        <select required class="form-control" name="sualoaikhachhang" id="sualoaikhachhang">
                            <option value="Bình thường">Bình thường</option>
                            <option value="Thân thuộc">Thân thuộc</option>
                            <option value="VIP">VIP</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" name="update" class="btn btn-primary">Cập nhật</button>
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
                    <input type="hidden" name="xoasdt" value="" id="xoasdt">
                    <button type="submit" class="btn btn-primary">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    //sua
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var hoten = button.data('hoten')
        var sdt = button.data('sdt')
        var ngaysinh = button.data('ngaysinh')
        var gioitinh = button.data('gioitinh')
        var diachi = button.data('diachi')
        var loaikhachhang = button.data('loaikhachhang')
        var thoigiandangky = button.data('thoigiandangky')
        var modal = $(this)
        modal.find('.modal-title').text('Sửa ' + hoten)
        modal.find('#suaid').val(sdt)
        modal.find('#suasdt').val(sdt)
        modal.find('#suahoten').val(hoten)
        modal.find('#suangaysinh').val(ngaysinh)
        modal.find('#suagioitinh').val(gioitinh)
        modal.find('#suadiachi').val(diachi)
        modal.find('#sualoaikhachhang').val(loaikhachhang)
        modal.find('#suathoigiandangky').val(thoigiandangky)
    })

    //xoa
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var hoten = button.data('hoten')
        var sdt = button.data('sdt')
        var modal = $(this)
        modal.find('#xoasdt').val(sdt)
        modal.find('.modal-title').text('Xóa ' + hoten)
        modal.find('#msgxoa').text("Bạn chắc muốn xóa " + hoten)
    })
</script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
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