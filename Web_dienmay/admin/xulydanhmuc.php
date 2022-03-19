<?php
  include '../db/connect.php' ;
 ?>
<?php
    if(isset($_POST['themdanhmuc'])){
      $tendanhmuc = $_POST['danhmuc'];
      $sql_insert =mysqli_query($con, "INSERT INTO danhmucsp(Ten_Danhmuc) VALUES('$tendanhmuc')");
    }
    elseif(isset($_POST['suadanhmuc'])){
      $id_sua_danhmuc = $_POST['id_danhmuc'];
      $tendanhmuc = $_POST['danhmuc'];
      $sql_update= mysqli_query($con, "UPDATE danhmucsp SET Ten_Danhmuc = '$tendanhmuc' WHERE ID_Danhmuc ='$id_sua_danhmuc'");
      header("Location: xulydanhmuc.php");
    }
    if(isset($_GET['xoa'])){
      $id = $_GET['xoa'];
      $sql_xoa = mysqli_query($con, "DELETE FROM danhmucsp WHERE ID_Danhmuc = '$id'");
    }
 ?>
 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Danh mục sản phẩm</title>
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
        <?php
        if(isset($_GET['quanly'])=='sua'){
          $id_sua = $_GET['id'];
          $sql_sua = mysqli_query($con, "SELECT * FROM danhmucsp WHERE ID_Danhmuc = '$id_sua'");
          $row_sua =mysqli_fetch_array($sql_sua);

          ?>
        <div class="col-md-4">
        <h4>Cập nhật danh mục</h4>
        <label >Tên danh mục</label>
        <form action="" method="POST">
        <input type="text" name="danhmuc" class="form-control" value="<?php echo $row_sua['Ten_Danhmuc']?>"  ><br> 
        <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_sua['ID_Danhmuc']?>">
        <input type="submit" name="suadanhmuc" value="Sửa danh mục" class="btn btn-default">
         </form>
      </div>

         <?php
      }else{

          ?>

        <div class="col-md-4">
         <h4 style="font-weight: bold;">Thêm danh mục</h4>
          <label >Tên danh mục</label>
            <form action="" method="POST">
              <input type="text" name="danhmuc" class="form-control" placeholder="Nhập vào tên danh mục muốn thêm..." ><br> 
               <input type="submit" name="themdanhmuc" value="Thêm danh mục" class="btn btn-default">
             </form>
        </div>
          <?php

          } 
           ?>
        
     
     
      <div class="col-md-8">
        <h4 style="font-weight: bold;">Danh sách danh mục</h4>
        <?php 
        $sql_select = mysqli_query($con, "SELECT * FROM danhmucsp ORDER BY ID_Danhmuc DESC");
         ?>
        <table class="table table-bordered">
          <tr>
             <td>Thứ tự</td>
            <td>Tên danh mục</td>
            <td>Hoạt động</td>
           
          </tr>
          <?php
          $i=0;
          while($row_danhmuc = mysqli_fetch_array($sql_select)){ 
            $i++;
           ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row_danhmuc['Ten_Danhmuc'] ?></td>
            <td><a href="?quanly=sua&id=<?php echo $row_danhmuc['ID_Danhmuc']?>">Sửa</a> | <a href="?xoa=<?php echo $row_danhmuc['ID_Danhmuc']?>">Xóa</a></td>
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