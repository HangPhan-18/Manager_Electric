<?php
  include '../db/connect.php' ;
 ?>
 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Thông tin khách hàng</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<style>
  .logo_agile h1 a {
    color: red;
    font-size: 38px;
    text-decoration: none;
    letter-spacing: 1px;
    position: relative;
    
}
body{
      background: #fff;
    }
  
  </style>
</head>
<body>
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="col-md-3 logo_agile">
    <h1 class="text-center">
      <a href="dashboard.php" class="font-weight-bold font-italic">
        <img src="../images/Dino Electric.png" alt=" " class="img-fluid" width="90px" height="87px"> Dino Store
      </a>
    </h1>
  </div>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="xulydonhang.php">Đơn hàng </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="xulytintuc.php">Danh mục bài viết </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="xulybaiviet.php">Bài viết </a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="khuyenmai.php">Khuyến mãi </a>
      </li>
    </ul>
  </div>
</nav>
<br><br>
  <div class="container">

      <div class="row">

      <div class="col-md-12">
        <h4 style="font-weight: bold;">Thông tin khách hàng</h4>
        <?php 
        $sql_select_khachhang = mysqli_query($con, "SELECT * FROM khachhang, giaodich WHERE khachhang.ID_Khachhang = giaodich.ID_Khachhang ORDER BY giaodich.ID_Khachhang DESC");
         ?>
        <table class="table table-bordered">
          <tr>
             <td>Thứ tự</td>
            <td>Tên khách hàng</td>
            <td>Số điện thoại</td>
            <td>Địa chỉ</td>
            <td>Email</td>
            <td>Ngày đặt hàng</td> 
            <td>Hoạt động</td>
          </tr>
          <?php
          $i=0;
          while($row_khachhang = mysqli_fetch_array($sql_select_khachhang)){ 
            $i++;
           ?>
          <tr>
            <td><?php echo $i ?></td>  
            <td><?php echo $row_khachhang['Hoten'] ?></td> 
            <td><?php echo $row_khachhang['Sdt'] ?></td>
            <td><?php echo $row_khachhang['Diachi'] ?></td>
            <td><?php echo $row_khachhang['Email'] ?></td>
            <td><?php echo $row_khachhang['Ngaythang'] ?></td>
            <td><a href="?quanly=xemgiaodich&khachhang=<?php echo $row_khachhang['Ma_Giaodich']?>">Xem giao dịch</a></td>
          </tr>
          <?php
          } 
           ?>
        </table>
      </div>

      <div class="col-md-12">
        <h4 style="font-weight: bold;">Thông tin lịch sử đơn hàng</h4>
        <?php 
        if(isset($_GET['khachhang'])){
          $magiaodich = $_GET['khachhang'];

        }
        else{
          $magiaodich='';
        }
        $sql_select = mysqli_query($con, "SELECT * FROM khachhang, giaodich, sanpham WHERE giaodich.ID_Sanpham = sanpham.ID_Sanpham AND giaodich.ID_Khachhang = khachhang.ID_Khachhang AND giaodich.Ma_Giaodich = '$magiaodich' GROUP BY giaodich.Ma_Giaodich ORDER BY giaodich.ID_Giaodich DESC");
         ?>
        <table class="table table-bordered">
          <tr>
            <td>Thứ tự</td>
            <td>Mã giao dịch</td>
            <td>Tên sản phẩm</td>
            <td>Ngày đặt hàng</td>
            
          </tr>
          <?php
          $i=0;
          while($row_donhang = mysqli_fetch_array($sql_select)){ 
            $i++;
           ?>
          <tr>
            <td><?php echo $i ?></td>
          
            <td><?php echo $row_donhang['Ma_Giaodich'] ?></td>   
            <td><?php echo $row_donhang['Ten_Sanpham'] ?></td> 
            <td><?php echo $row_donhang['Ngaythang'] ?></td>
          </tr>
          <?php
          } 
           ?>
        </table>
      </div>
    </div>
  </div>
</body>
</html>