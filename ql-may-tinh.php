<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$title = "Quản lý máy tính";
require_once('./db_connect.php');
require_once('./include/function.php');
require_once('./header.php');
$queryinsert = 0;
if (isset($_POST['submit']) && $_POST['submit'] == 'Thêm máy tính') {
    $queryinsert = mysqli_query($conn, "INSERT INTO `maytinh` (`idmay`, `tenmay`, `tinhtrang`) VALUES (NULL, '" . $_POST['tenmay'] . "', '" . $_POST['tinhtrang'] . "')");
}

$querydel = 0;
if (isset($_POST['xoaidmay'])) {
    $querydel = mysqli_query($conn, "DELETE FROM `maytinh` WHERE `maytinh`.`idmay` = " . $_POST['xoaidmay']);
}

$queryupdate = 0;
if (isset($_POST['update'])) {
    // echo $_POST['suaidmay'];
    // echo $_POST['suatinhtrang'];
    $queryupdate = mysqli_query($conn, "UPDATE `maytinh` SET `tenmay` = '" . $_POST['suatenmay'] . "', `tinhtrang` = '" . $_POST['suatinhtrang'] . "' WHERE `maytinh`.`idmay` = " . $_POST['suaidmay']);
}

$querymay = mysqli_query($conn, "SELECT * FROM `maytinh` WHERE 1 ORDER BY `tenmay` ASC");

?>
<?php
if ($queryinsert) :
    echo "<script>Swal.fire('Thành công!', 'Thêm máy tính thành công!', 'success')</script>";
elseif ($queryinsert !== 0) :
    echo "<script>Swal.fire('Thất bại!', 'Thêm máy tính thất bại!', 'error')</script>";
endif;

if ($queryupdate) :
    echo "<script>Swal.fire('Thành công!', 'Sửa máy tính thành công!', 'success')</script>";
elseif ($queryupdate !== 0) :
    echo "<script>Swal.fire('Thất bại!', 'Sửa máy tính thất bại!', 'error')</script>";
endif;

if ($querydel) :
    echo "<script>Swal.fire('Thành công!', 'Xóa máy tính thành công!', 'success')</script>";
elseif ($querydel !== 0) :
    echo "<script>Swal.fire('Thất bại!', 'Xóa máy tính thất bại!', 'error')</script>";
endif;
?>


<form action="" method="post" class="row mb-3">
    <div class="col-5">
        <label for="tenmay" class="form-label">Tên máy: </label>
        <input required type="text" name="tenmay" id="tenmay" class="form-control">
    </div>
    <div class="col-5">
        <label for="tinhtrang" class="form-label">Tình trạng máy: </label>
        <select required class="form-control" name="tinhtrang" id="tinhtrang">
            <option value="Bình thường">Bình thường</option>
            <option value="Hỏng">Hỏng</option>
        </select>
    </div>
    <div class="col-2">
        <input type="submit" value="Thêm máy tính" id="submit" name="submit" class="btn btn-primary mt-4">
    </div>
</form>

<div class="row">
    <?php while ($maytinh = mysqli_fetch_assoc($querymay)) {
        if ($maytinh['tinhtrang'] == "Hỏng") {
    ?>
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card text-center">
                    <img src="./assets/img/settings.svg" width="100px" class="card-img-top" alt="máy hỏng">
                    <div class="card-body font-weight-bold text-primary text-center">
                        <div><?= $maytinh['tenmay'] ?></div>
                        <div>
                        <a href="#" class="btn btn-success" title="Sửa" data-toggle="modal" data-target="#exampleModal" data-tenmay="<?= $maytinh['tenmay'] ?>" data-tinhtrang="<?= $maytinh['tenmay'] ?>" data-idmay="<?= $maytinh['idmay'] ?>"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="btn btn-danger" title="Xóa" data-toggle="modal" data-target="#exampleModal2" data-tenmay="<?= $maytinh['tenmay'] ?>" data-idmay="<?= $maytinh['idmay'] ?>"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="col-xl-2 col-md-6 mb-4">
                <div class="card text-center">
                    <img src="./assets/img/computer.svg" width="100px" class="card-img-top" alt="máy bình thường">
                    <div class="card-body font-weight-bold text-primary text-center">
                        <div><?= $maytinh['tenmay'] ?></div>
                        <div>
                            <a href="#" class="btn btn-success" title="Sửa" data-toggle="modal" data-target="#exampleModal" data-tenmay="<?= $maytinh['tenmay'] ?>" data-tinhtrang="<?= $maytinh['tenmay'] ?>" data-idmay="<?= $maytinh['idmay'] ?>"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="btn btn-danger" title="Xóa" data-toggle="modal" data-target="#exampleModal2" data-tenmay="<?= $maytinh['tenmay'] ?>" data-idmay="<?= $maytinh['idmay'] ?>"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    } 
    
    ?>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="suatenmay" class="form-label">Tên máy: </label>
                        <input type="hidden" name="suaidmay" id="suaidmay">
                        <input type="text" name="suatenmay" id="suatenmay" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="suatinhtrang" class="form-label">Tình trạng máy: </label>
                        <select class="form-control" name="suatinhtrang" id="suatinhtrang">
                            <option value="Bình thường">Bình thường</option>
                            <option value="Hỏng">Hỏng</option>
                        </select>
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
                    <input type="hidden" name="xoaidmay" value="" id="xoaidmay">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Đóng</button>
                    <button class="btn btn-primary"><i class="fa fa-trash"></i> Chấp nhận</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var tenmay = button.data('tenmay')
        var tinhtrang = button.data('tinhtrang')
        var id = button.data('idmay')
        var modal = $(this)
        modal.find('.modal-title').text('Sửa ' + tenmay)
        modal.find('#suatenmay').val(tenmay)
        modal.find('#suaidmay').val(id)
    })
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var tenmay = button.data('tenmay')
        var modal = $(this)
        var id = button.data('idmay')
        modal.find('#xoaidmay').val(id)
        modal.find('.modal-title').text('Xóa ' + tenmay)
        modal.find('#msgxoa').html("Bạn chắc muốn xóa <b>" + tenmay +"</b>? Sau khi xóa bạn sẽ không thể khôi phục lại được.<br/> - Nếu <b>đồng ý</b> xóa, hãy nhấn <b>chấp nhận</b>.<br/> - Nếu <b>không đồng ý</b> xóa, hãy nhấn <b>đóng</b>.")
    })
</script>
<?php
require_once('./footer.php');
?>