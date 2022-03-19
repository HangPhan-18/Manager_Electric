<?php
  include '../db/connect.php' ;
 ?>
<?php
  if(isset($_POST['capnhat'])){
    $xuly = $_POST['xuly'];
    $mahang = $_POST['mahang_xuly'];
    $sql_donhang_capnhat = mysqli_query($con, "UPDATE donhang SET Tinhtrang = '$xuly' WHERE Madonhang = '$mahang'");
    $sql_giaodich_capnhat = mysqli_query($con, "UPDATE giaodich SET Tinhtrang = '$xuly' WHERE Ma_giaodich = '$mahang'");
  } 
 ?>
 <?php
  if(isset($_GET['xoadonhang'])){
    $mahang = $_GET['xoadonhang'];
    $sql_xoa_donhang = mysqli_query($con, "DELETE FROM donhang WHERE Madonhang='$mahang'");
    header("Location: xulydonhang.php");
  } 

  if(isset($_GET['xacnhanhuy'])&& isset($_GET['mahang'])){
    $huydon = $_GET['xacnhanhuy'];
    $mahang = $_GET['mahang'];
  } 
  else{
    $huydon='';
    $mahang='';
  }
   $sql_donhang_huydon = mysqli_query($con, "UPDATE donhang SET Huydon = '$huydon' WHERE Madonhang = '$mahang'");
   $sql_giaodich_huydon = mysqli_query($con, "UPDATE giaodich SET Huydon = '$huydon' WHERE Ma_Giaodich = '$mahang'");

  ?>
 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Đơn hàng</title>
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
      
      <div >

        <h4 style="font-weight: bold;">Đơn hàng</h4>
        <?php 
        $sql_select = mysqli_query($con, "SELECT * FROM sanpham, khachhang, donhang WHERE donhang.ID_Sanpham = sanpham.ID_Sanpham AND donhang.ID_Khachhang = khachhang.ID_Khachhang GROUP BY Madonhang");
         ?>
        <table class="table table-bordered">
          <tr>
             <td>Thứ tự</td>
            <td>Mã đơn hàng</td>
            <td>Tên khách hàng</td>
            <td>Ngày đặt hàng</td>
            <td>Tình trạng</td>
            <td>Ghi chú</td> 
            <td>Hủy đơn</td>
            <td>Hoạt động</td>
          </tr>
          <?php
          $i=0;
          while($row_donhang = mysqli_fetch_array($sql_select)){ 
            $i++;
           ?>
          <tr>
            <td><?php echo $i ?></td>
          
            <td><?php echo $row_donhang['Madonhang'] ?></td>   
            <td><?php echo $row_donhang['Hoten'] ?></td> 
            <td><?php echo $row_donhang['Ngaythang_Donhang'] ?></td>
            <td>
              <?php
                if($row_donhang['Tinhtrang']==0){
                  echo 'Chưa xử lý';

                } 
                else{
                  echo 'Đã xử lý';
                }
               ?>
            </td>
             <td><?php echo $row_donhang['Ghichu'] ?></td>
             <td>
              <?php
              if($row_donhang['Huydon']==0){
                echo ' ';
              }elseif($row_donhang['Huydon']==1){
                echo '<a href="xulydonhang.php?quanly=xemdonhang&mahang='.$row_donhang['Madonhang'].'&xacnhanhuy=2">Xác nhận hủy đơn</a>';
              }
              else{
                echo 'Đã hủy';
              }


               ?>
               </td>
            <td><a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['Madonhang']?>">Xem đơn hàng</a> | <a href="?xoadonhang=<?php echo $row_donhang['Madonhang']?>">Xóa</a></td>
          </tr>
          <?php
          } 
           ?>
        </table>
          <?php
        if(isset($_GET['quanly'])=='xemdonhang'){
              $mahang = $_GET['mahang'];
             $sql_xemdonhang = mysqli_query($con, "SELECT * FROM donhang, sanpham WHERE donhang.ID_Sanpham=sanpham.ID_Sanpham AND donhang.Madonhang = '$mahang'  ");
             
          ?> 
           <div>
          <h4 style="font-weight: bold;">Chi tiết đơn hàng</h4>
          <form action=""method="POST" >
           <table class="table table-bordered">
          <tr>
            <td>Thứ tự</td>
            <td>Mã đơn hàng</td>
            <td>Tên sản phẩm</td>
            <td>Số lượng</td>
            <td>Tổng tiền</td>
            <td>Ngày đặt hàng</td>
            
          </tr>
          <?php
          $i=0;
          while($row_donhang = mysqli_fetch_array($sql_xemdonhang)){ 
            $i++;
           ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row_donhang['Madonhang'] ?></td>   
            <td><?php echo $row_donhang['Ten_Sanpham'] ?></td> 
            <td><?php echo $row_donhang['Soluong'] ?></td>
            <td><?php echo number_format($row_donhang['Giakhuyenmai_Sanpham']*$row_donhang['Soluong']).'đ'?></td>
            <td><?php echo $row_donhang['Ngaythang_Donhang'] ?></td>
            <input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['Madonhang']?>">
           
          <!--   <td><a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['Madonhang']?>">Xem đơn hàng</a> | <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['Madonhang']?>">Xóa</a></td> -->
          </tr>
          <?php
          } 
           ?>

        </table>

        <select name="xuly" class="form-control">
          <option value="1">Đã xử lý</option>
          <option value="0">Chưa xử lý</option>
        </select>
        <br>
        <input type="submit" name="capnhat" value="Cập nhật đơn hàng" class="btn btn-success" >
        </form>
      </div>

         <?php
      }else{

          ?> 

       <div >
         <h4 style="font-weight: bold;">Không có đơn hàng nào được chọn</h4>
         
        </div>  
          <?php

          } 
           ?> 
      </div>
    </div>
  </div>
</body>
</html>