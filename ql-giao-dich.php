<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$title = "Quản lý giao dịch";
require_once('./db_connect.php');
require_once('./include/function.php');
require_once('./header.php');

$querygiaodich = mysqli_query($conn, "SELECT * FROM `giaodich`, `giatien` WHERE `idmay`='" . ($_GET['may']) . "' AND `giatien`.`idgiatien`=`giaodich`.`idgiatien` ORDER BY `thoigianbatdau` DESC LIMIT 1");
if ($querygiaodich && $querygiaodich->num_rows > 0)
    $giaodich = mysqli_fetch_assoc($querygiaodich);
else
    header("Location: ./them-giao-dich.php?may=" . $_GET['may']);
$querykhachhang = mysqli_query($conn, "SELECT * FROM `thongtinkhachhang` WHERE `idkh`='" . $giaodich['idkhachhang'] . "'");
$khachhang = mysqli_fetch_assoc($querykhachhang);

$querydichvu = mysqli_query($conn, "SELECT * FROM `dichvu`");
$dichvu = mysqli_fetch_assoc($querydichvu);
$querysddv = mysqli_query($conn, "SELECT * FROM `sudungdichvu` join dichvu on sudungdichvu.iddv = dichvu.iddv where idmay =" . $_GET['may']);
$querygia = mysqli_query($conn, "SELECT * FROM `giatien`");
$querymay = mysqli_query($conn, "SELECT `tenmay`, idmay as idmay FROM `maytinh` WHERE `idmay`=" . $_GET['may']);
$maytinh = mysqli_fetch_assoc($querymay);
if (isset($_POST['submit1'])) {
    $iddv = $_POST['dichvu'];
    $giadv = $_POST['giadv'];
    $querysddv = mysqli_query($conn, "INSERT INTO `sudungdichvu`  (`idmay`,`idkhachhang`,`iddv`, `gia`) VALUES ('" . $_POST['idmay'] . "', '" . $_POST['khachhang'] . "', '$iddv', '$giadv')");
    if ($querysddv){
        echo "<script>Swal.fire('Thành công!','Đã lưu thanh toán!','success').then(function(){window.location = './index.php';});</script>";
    }
    else {
        echo "<script>Swal.fire('Thất bại!','Đã có lỗi xảy ra!','error');</script>";
    }
    // echo $query;

}

if (isset($_POST['submit'])) {
    $query = "SELECT SUM(gia) AS tongtien FROM sudungdichvu WHERE idmay = '" . $_POST['idmay'] . "'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $tongtiendv = $row['tongtien'];
    $tien = $_POST['thanhtien'] + $tongtiendv;
    $query = mysqli_query($conn, "UPDATE giaodich SET thoigianketthuc = '" . $_POST['thoigianketthuc'] . "', tiendv = '$tongtiendv',tien ='$tien', giamgia = '" . $_POST['giamgia'] . "', idgiatien = '" . $_POST['giatien'] . "' WHERE giaodich.`idmay` = '" . $_POST['idmay'] . "' AND giaodich.`thoigianbatdau` = '" . $_POST['thoigianbatdau'] . "'");
    $query1 = "DELETE FROM sudungdichvu WHERE idmay = '" . $_POST['idmay'] . "'";
    $result = mysqli_query($conn, $query1);
    if ($query){
        echo "<script>Swal.fire('Thành công!','Đã lưu thanh toán!','success').then(function(){window.location = './index.php';});</script>";
    }
    else {
        echo "<script>Swal.fire('Thất bại!','Đã có lỗi xảy ra!','error');</script>";
    }
}
?>
<head>
    <style>
        .btn-group {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-group .btn {
            margin: 0 10px;
        }
    </style>
</head>

<div class="row">
    <div class="col-xl-12 mx-auto">

        <form method="post" action="">

            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="idmay">ID máy:</label>
                        <input readonly type="number" class="form-control" id="idmay" name="idmay" value="<?= $_GET['may'] ?>">
                    </div>
                </div>
                <div class="col-xl-8 col-md-8">
                    <div class="form-group">
                        <label for="tenmay">Tên máy:</label>
                        <input readonly type="text" class="form-control" id="tenmay" name="tenmay" value="<?= $maytinh['tenmay'] ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8 col-md-4">
                    <div class="form-group">
                        <label for="khachhang">Khách hàng:</label>
                        <select readonly class="form-control" name="khachhang" id="khachhang" placeholder="Chọn khách hàng..">
                            <?php echo '<option value="' . $khachhang['idkh'] . '">' . $khachhang['hoten'] . '</option>';
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4">
                    <div class="form-group">
                        <label for="loaikh">Loại khách hàng:</label>
                        <input readonly type="text" class="form-control" id="loaikh" name="loaikh" value="<?= $khachhang['loaikhachhang'] ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-md-4">
                    <div class="form-group">
                        <label for="dichvu">Dịch vụ:</label>
                        <select class="form-control" name="dichvu" id="dichvu" onchange="updatePrice()">
                        <?php
                        // Lấy danh sách dịch vụ từ cơ sở dữ liệu
                        $query = "SELECT * FROM dichvu";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['iddv'] . '" data-giadv="' . $row['giadv'] . '">' . $row['tendv'] . '</option>';
                        }
                        ?>
                        </select>
                    </div>
                </div>

                <div class="col-xl-4 col-md-4" style="  display: flex;">
                        <div class="form-group">
                                <div style="margin-top: 25px">
                                    <label for="loaikh">Dịch vụ đã dùng:</label>
                                    <a style="margin: 10px;background-color: #00ff36;border-color: #00ff45" href="#" class="btn btn-primary px-5" title="Sửa" data-toggle="modal" data-target="#exampleModal" data-title="Cập nhật thông tin khách hàng" data-type="update" data-idkh="<?= $row['idkh'] ?>" data-hoten="<?= $row['hoten'] ?>" data-thoigiandangky="<?= $row['thoigiandangky'] ?>" data-loaikhachhang="<?= $row['loaikhachhang'] ?>">
                                    <i   class="fa fa-pencil"></i> 
                                    </a>
                                </div>
                        </div>
                </div>
            </div>


            <div class="form-group">
                <label for="giadv">Giá dịch vụ:</label>
                <input type="text" class="form-control" name="giadv" id="giadv">
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="form-group">
                        <label for="thoigianbatdau">Thời gian bắt đầu:</label>
                        <input readonly type="text" class="form-control" id="thoigianbatdau" name="thoigianbatdau" value="<?= $giaodich['thoigianbatdau'] ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="form-group">
                        <label for="thoigianketthuc">Thời gian kết thúc:</label>
                        <input type="text" class="form-control" id="thoigianketthuc" name="thoigianketthuc" value="<?= date("Y-m-d H:i:s", time()) ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="form-group">
                        <label for="sogio">Số phút:</label>
                        <input readonly type="text" class="form-control" id="sogio" name="sogio" value="<?= ceil((time() - strtotime($giaodich['thoigianbatdau'])) / 60) ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="form-group">
                        <label for="giatien">Giá tiền:</label>
                        <select class="form-control" name="giatien" id="giatien" placeholder="Chọn giá tiền..">
                            <?php
                            if ($querygia && $querygia->num_rows > 0) {
                                while ($giatien = mysqli_fetch_assoc($querygia)) {
                                    echo '<option value="' . $giatien['idgiatien'] . '" data-gia="' . $giatien['gia'] . '">' . $giatien['gia'] . '.000đ</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-6">
                    <div class="form-group">
                        <label for="giamgia">Giảm giá:</label>
                        <input type="text" class="form-control" id="giamgia" name="giamgia" value="<?= $giaodich['giamgia'] ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="form-group">
                        <label for="thanhtien">Thành tiền:</label>
                        <input type="text" class="form-control" id="thanhtien" name="thanhtien" value="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="ghichu">Ghi chú:</label>
                        <textarea class="form-control" name="ghichu" id="ghichu" cols="30" rows="5"><?= $giaodich['ghichu'] ?></textarea>
                    </div>
                </div>
            </div>

<div class="btn-group">
    <button name="submit" type="submit" class="btn btn-primary px-5"><i class="fa fa-money"></i> Thanh toán</button>
    <a href="./index.php" class="btn btn-danger px-5"><i class="fa fa-reply"></i> Trở về</a>
    <button id="updateBtn" name="submit1" type="submit" class="btn btn-primary px-5 d-none"><i class="fa fa-money"></i> Cập nhật</button>
</div>                     
        </form>

    </div>

<!-- gxsghuvsahhgas -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="">
                <input type="hidden" name="type" id="type">
                <input type="hidden" name="idsd" id="idsd">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm thông tin dịch vụ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                        <table id="datatable" style="width:100%" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>ID may</th>
                                        <th>ID kh</th>
                                        <th>ID Dịch vụ</th>
                                        <th>Giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while ($row = mysqli_fetch_assoc($querysddv)) {
                                    ?>
                                            <tr>
                                                <!-- <td><?php echo $row['idsd']; ?></td> -->
                                                <td><?php echo $row['idmay']; ?></td>
                                                <td><?php echo $row['idkhachhang']; ?></td>
                                                <td><?php echo $row['iddv']; ?></td>
                                                <td><?php echo $row['gia']; ?></td>
                                            </tr>
                                    <?php
                                        }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    
                </div>
            </form>
        </div>
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
</div>


<script>
    function tinhtien() {
        $('#thanhtien').val(Math.ceil($('#sogio').val() / 60 * $('#giatien option:selected').data('gia') * (100 - $('#giamgia').val()) / 100) * 1000);
    }
    $(document).ready(function() {
        $('#giatien').val("<?= $giaodich['idgiatien'] ?>");

        tinhtien();
    });
    $('input').change(function() {
        $('#sogio').val(Math.ceil((Date.parse($('#thoigianketthuc').val()) - Date.parse($('#thoigianbatdau').val())) / 60000));
        tinhtien();
    });
    $('select').change(function() {
        tinhtien();
    });
    function updatePrice() {
        var select = document.getElementById("dichvu");
        var giadv = select.options[select.selectedIndex].getAttribute("data-giadv");
        document.getElementById("giadv").value = giadv;
        var dvSelect = document.getElementById("dichvu");
        var price = dvSelect.options[dvSelect.selectedIndex].getAttribute("data-giadv");
        var updateBtn = document.getElementById("updateBtn");
        if (price !== null) {
            updateBtn.classList.remove("d-none");
            updateBtn.classList.add("d-block");
        } else {
            updateBtn.classList.remove("d-block");
            updateBtn.classList.add("d-none");
        }
    }


    // kjdchsjlkfrbkjsfd
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
</script>
<?php
require_once('./footer.php');
?>