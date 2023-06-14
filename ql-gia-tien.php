<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$title = "Quản lý giá tiền";
require_once('./db_connect.php');
require_once('./include/function.php');
require_once('./header.php');
if (isset($_POST['gia'])) {
    $query = mysqli_query($conn, "INSERT INTO `giatien`(`gia`) VALUES ('".$_POST['gia']."')");
    if ($query){
        echo "<script>Swal.fire('Thành công!','Giá tiền đã được cập nhật!','success');</script>";
    }
}
$query = mysqli_query($conn, "SELECT DATE_FORMAT(idgiatien, '%d/%l/%Y') AS 'label', gia AS 'data' FROM `giatien` WHERE 1  ORDER By idgiatien ASC LIMIT 15;");
if ($query){
    $emparray = array();
    while($row =mysqli_fetch_assoc($query))
    {
        $emparray[] = $row;
    }
    echo "<script> var data2 = ".json_encode($emparray)."; </script>";
}
?>
<div class="row">
    <div class="col-xl-6 mx-auto">
    
        <form method="post" action="">
            <div class="form-group">
                <label for="gia">Nhập giá mỗi giờ (đơn vị ngàn đồng):</label>
                <input type="number" class="form-control" id="gia" name="gia" placeholder="5" min="1">
            </div>
            <button type="submit" class="btn btn-primary px-5">Lưu lại</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
    <canvas id="myChart" width="300" height="100"></canvas>
<script>
var xvalue =[];
var yvalue =[];
for (var i = 0; i < data2.length; i++) {
    xvalue.push(data2[i].label);
    yvalue.push(data2[i].data);
}
const ctx = document.getElementById('myChart').getContext('2d');
const config = {
  type: 'line',
  data: {
    labels: xvalue,
    datasets: [{
        label: 'Giá tiền',
        pointRadius: 4,
        pointBackgroundColor: "rgba(0,0,255,1)",
        data: yvalue
    }]
  },
  options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: (ctx) => 'Giá tiền theo ngày',
      }
    }
  }
};
const myChart = new Chart(ctx, config);
</script>
    </div>
</div>
<?php
require_once('./footer.php');
?>
