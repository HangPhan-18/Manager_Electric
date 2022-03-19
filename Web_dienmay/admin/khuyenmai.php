<?php
  include '../db/connect.php' ;
 ?>
 <?php
    if(isset($_POST['themkhuyenmai'])){
      $tieude = $_POST['tieude'];
      $active = $_POST['active'];
      $sql_insert_slider = mysqli_query($con, "INSERT INTO Khuyenmai(Khuyenmai, Trangthai) VALUES('$tieude', '$active')");
    
    }
    elseif(isset($_POST['suakhuyenmai'])){
      $act = $_POST['trangthai'];
      $idtieude = $_POST['idtieude'];
      $tieude = $_POST['tieude'];
      $active = $_POST['active'];
    
      
      $sql_update = "UPDATE Khuyenmai SET Khuyenmai = '$tieude', Trangthai = '$active' WHERE ID_Khuyenmai = '$idtieude' AND Trangthai = '$act'";
     
     mysqli_query($con, $sql_update);
   }

    if(isset($_GET['xoa'])){
      $id = $_GET['xoa'];
      $sql_xoa = mysqli_query($con, "DELETE FROM Khuyenmai WHERE ID_Khuyenmai = '$id'");
      $path_delete ='../upload/';
      
    }
 ?> 
 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Khuyến mãi</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  <style>
     .logo_agile h1 a {
    color: red;
    font-size: 38px;
    text-decoration: none;
    letter-spacing: 1px;
    position: relative;
}
img.hinhanh {
    width: 125px;
    height: 74px;
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
        <a class="nav-link" href="khuyenmai.php">Khuyến mãi</a>
      </li>
    </ul>
  </div>
</nav>
<br><br>
  <div class="container">

      <div class="row">
          <?php
        if(isset($_GET['quanly'])=='sua'){
          $id_sua = $_GET['idsua'];
          $sql_sua = mysqli_query($con, "SELECT * FROM Khuyenmai WHERE ID_Khuyenmai = '$id_sua'");
          $row_sua =mysqli_fetch_array($sql_sua);

          ?>
        <div class="col-md-4" style="margin-left: -185px;" >
        <h4>Cập nhật khuyến mãi</h4>
       
        <form action="" method="POST" enctype="multipart/form-data" >
              <label>Tiêu đề khuyến mãi</label>
              <input type="text" name="tieude" class="form-control" value="<?php echo $row_sua['Khuyenmai']?>" style="width: 100%;"><br> 
              <input type="hidden" name="idtieude" class="form-control"  value="<?php echo $row_sua['ID_Khuyenmai']?> " >
             
              
              <label>Ẩn/hiện khuyễn mãi</label>
              &emsp; 
              <input type="hidden" name="trangthai" value="<?php echo $row_sua['Trangthai']?>">
              <select name="active" style="width: 52%;text-align: center;">
                <?php
                if($row_sua['Trangthai']==1){
                  echo ' <option selected value="1">Hiện khuyến mãi</option>';
                  echo '<option value="0">Ẩn khuyến mãi</option>';
                } 
                else{
                  echo ' <option selected value="0">Ẩn khuyến mãi</option>';
                  echo '<option value="1">HIện khuyến mãi</option>';
                }
                 ?>
                
                 
              </select>
              <br>
              <input type="submit" name="suakhuyenmai" value="Sửa khuyến mãi" class="btn btn-default">
           
         </form>
      </div>
            <?php
           }else{ 
           ?>
        <div class="col-md-4" style="margin-left: -185px;">
         <h4 style="font-weight: bold;">Thêm khuyến mãi mới</h4>
          
            <form action="" method="POST" enctype="multipart/form-data" >
              <label>Tiêu đề khuyến mãi</label>
              <input type="text" name="tieude" class="form-control" placeholder="Nhập tiêu đề khuyến mãi" style="width: 100%;"><br> 
             
              <label>Ẩn/hiện slider</label>


              <select name="active">

                 <option value="0">Ẩn khuyến mãi</option>
                 <option value="1">Hiện khuyến mãi</option>
              </select>
              <input type="submit" name="themkhuyenmai" value="Thêm khuyến mãi" class="btn btn-default">
            </form>
        </div>
           <?php
          } 
           ?>
           <p>  
      <div class="col-md-8" style="margin-left: 480px;">
        <h4 style="font-weight: bold;">Thông tin khuyến mãi</h4>
         <?php 
        $sql_select_khuyenmai = mysqli_query($con, "SELECT * FROM Khuyenmai ORDER BY ID_Khuyenmai DESC");
         ?> 
        <table class="table table-bordered">
          <tr>
            <td>Thứ tự</td>
            <td>Tiêu đề khuyến mãi</td>
          
            <td>Quản lý khuyến mãi</td>
            <td>Hoạt động</td>
           
          </tr>
           <?php
          $i=0;
          while($row_khuyenmai = mysqli_fetch_array($sql_select_khuyenmai)){ 
            $i++;
           ?> 
          <tr>
            <td><?php echo $i ?></td> 
            <td><?php echo $row_khuyenmai['Khuyenmai'] ?></td>
            
            <td>
              <?php
              if($row_khuyenmai['Trangthai']==1){
                echo 'Hiện';
              } 
              else{
                echo 'Ẩn';
              }
               ?> 
            </td>

            <td><a href="?quanly=sua&idsua=<?php echo $row_khuyenmai['ID_Khuyenmai']?>">Sửa</a> | <a href="?xoa=<?php echo $row_khuyenmai['ID_Khuyenmai']?>">Xóa</a></td>
          </tr>
          <?php
          } 
           ?> 
        </table>
      </div>
      </p> 
    </div>
  </div>
</body>
</html>