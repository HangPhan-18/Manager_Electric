<?php
  include '../db/connect.php' ;
 ?>
 <?php
    if(isset($_POST['thembaiviet'])){
      $tenbaiviet = $_POST['tenbaiviet'];
      $hinhanh = $_FILES['hinhanh']['name'];
      $tomtat = $_POST['tomtat'];
      $chitiet = $_POST['chitiet'];
      $danhmuc = $_POST['danhmuc'];
      $path ='../upload/';

      $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];

      $sql_insert_baiviet =mysqli_query($con, "INSERT INTO baiviet(Ten_Baiviet, Tomtat_Baiviet, Noidung_Baiviet, ID_Tintuc, Hinhanh_Baiviet) VALUES('$tenbaiviet', '$tomtat', '$chitiet', '$danhmuc', '$hinhanh')");
     move_uploaded_file($hinhanh_tmp, $path.$hinhanh);
    }


    elseif(isset($_POST['suabaiviet'])){
      $id = $_POST['idbaiviet'];
      $tenbaiviet = $_POST['tenbaiviet'];
      $hinhanh = $_FILES['hinhanh']['name'];
      $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
      
      $tomtat = $_POST['tomtat'];
      $chitiet = $_POST['chitiet'];
      $danhmuc = $_POST['danhmuc'];
      $path ='../upload/';
      //Nếu người dùng không chọn sửa ảnh
      if($hinhanh==''){
          $sql_update = "UPDATE baiviet SET Ten_Baiviet='$tenbaiviet', Tomtat_Baiviet='$tomtat', Noidung_Baiviet='$chitiet', ID_Tintuc='$danhmuc' WHERE ID_Baiviet='$id'";
      }else{
      move_uploaded_file($hinhanh_tmp, $path.$hinhanh);
      $sql_update= "UPDATE baiviet SET Ten_Baiviet='$tenbaiviet', Hinhanh_Baiviet='$hinhanh', Tomtat_Baiviet='$tomtat', Noidung_Baiviet='$chitiet', ID_Tintuc='$danhmuc' WHERE ID_Baiviet='$id'";
     
     // header("Location: xulydanhmuc.php");
    }
     mysqli_query($con, $sql_update);
   }

    if(isset($_GET['xoa'])){
      $id = $_GET['xoa'];
      $sql_xoa = mysqli_query($con, "DELETE FROM baiviet WHERE ID_Baiviet= '$id'");
      $path_delete ='../upload/';
      
    }
 ?> 
 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bài viết</title>
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
img.hinhanhbv {
    width: 125px;
    height: 74px;
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
        <a class="nav-link" href="xulytintuc.php">Danh mục bài viết</a>
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
          $id_sua = $_GET['idsua'];
          $sql_sua = mysqli_query($con, "SELECT * FROM baiviet WHERE ID_Baiviet = '$id_sua'");
          $row_sua =mysqli_fetch_array($sql_sua);
          $id_danhmuc = $row_sua['ID_Tintuc'];
          ?>
          <div class="col-md-4" >
            <h4 style="font-weight: bold;margin-left: -415px;" >Sửa bài viết</h4>
          
            <form action="" method="POST" enctype="multipart/form-data" style="width: 320px; margin-left: -170px;"><!-- Chia nhỏ hình ảnh gửi lên server -->
              <label >Tên bài viết</label>
              <input type="text" name="tenbaiviet" class="form-control" value="<?php echo $row_sua['Ten_Baiviet']?>" ><br> 
              <input type="hidden" name="idbaiviet" class="form-control"  value="<?php echo $row_sua['ID_Baiviet']?> ">
              <label>Hình ảnh</label>
               <input type="file" name="hinhanh" class="form-control" ><br>
               <img src="../upload/<?php echo $row_sua['Hinhanh_Baiviet']?>" alt="" height="70px">
               <br>
             
                <label>Tóm tắt bài viết</label>
               <textarea type="text" name="tomtat" class="form-control" style="height: 100px;" ><?php echo $row_sua['Tomtat_Baiviet']?></textarea><br>

               <label>Nội dung bài viết</label>
              <textarea type="text" name="chitiet" class="form-control"style="height: 100px;" ><?php echo $row_sua['Noidung_Baiviet']?></textarea><br>

               <label>Danh mục bài viết</label>
               <?php
                $sql_danhmuc = mysqli_query($con, "SELECT * FROM tintuc ORDER BY ID_Tintuc DESC"); 
                ?>
               <select name="danhmuc" class="form-control">
                 <option value="">--Chọn danh mục---</option>
                 <?php
                 while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){ 
                  if($id_danhmuc == $row_danhmuc['ID_Tintuc']){
                  ?>
                 <option selected value="<?php echo $row_danhmuc['ID_Tintuc'] ?>"><?php echo $row_danhmuc['Ten_Tintuc'] ?></option>
                  <?php
                  }
                  else{

                   ?>
                    <option  value="<?php echo $row_danhmuc['ID_Tintuc'] ?>"><?php echo $row_danhmuc['Ten_Tintuc'] ?></option>
                   <?php 
                   }
                 }
                    ?>
               </select>
               <br>
               <input type="submit" name="suabaiviet" value="Sửa bài viết" class="btn btn-default">
             </form>
        </div>

         <?php
      }else{

          ?> 
        <div class="col-md-4" >
         <h4 style="font-weight: bold; margin-left: -415px;">Thêm bài viết mới</h4>
          
            <form action="" method="POST" enctype="multipart/form-data" style="width: 320px; margin-left: -170px;"><!-- Chia nhỏ hình ảnh gửi lên server -->
              <label >Tên bài viết</label>
              <input type="text" name="tenbaiviet" class="form-control" placeholder="Nhập vào tên bài viết..." ><br> 

              <label>Hình ảnh</label>
               <input type="file" name="hinhanh" class="form-control" ><br>
               <label>Tóm tắt chi tiết</label>
               <textarea name="tomtat" class="form-control"style="height: 170px;"></textarea> 
               <label>Nội dung chi tiết</label>
               <textarea name="chitiet" class="form-control"style="height: 170px;"></textarea><br>

               <label>Danh mục tin tức</label>
               <?php
                $sql_danhmuc = mysqli_query($con, "SELECT * FROM tintuc ORDER BY ID_Tintuc DESC"); 
                ?>
               <select name="danhmuc">
                 <option value="0">--Chọn danh mục---</option>
                 <?php
                 while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){ 
                  ?>
                 <option value="<?php echo $row_danhmuc['ID_Tintuc'] ?>"><?php echo $row_danhmuc['Ten_Tintuc'] ?></option>
                  <?php
                   }
               
                ?>
               </select>
               <input type="submit" name="thembaiviet" value="Thêm bài viết" class="btn btn-default">
             </form>
        </div>
          <?php

          } 
           ?> 
           <p>  
      <div class="thongtin" style="margin-left: 25%;margin-top: -63%;">
        <h4 style="font-weight: bold;">Thông tin chi tiết bài viết</h4>
        <?php 
        $sql_select_baiviet = mysqli_query($con, "SELECT * FROM tintuc, baiviet WHERE tintuc.ID_Tintuc = baiviet.ID_Tintuc ORDER BY baiviet.ID_Baiviet DESC");
         ?>
        <table class="table table-bordered">
          <tr>
            <td>Thứ tự</td>
            <td>Tên bài viết</td>
            <td>Hình ảnh</td>
            <td>Tóm tắt</td>
           
            <td>Danh mục</td>

            <td>Hoạt động</td>
           
          </tr>
           <?php
          $i=0;
          while($row_baiviet = mysqli_fetch_array($sql_select_baiviet)){ 
            $i++;
           ?> 
          <tr>
            <td><?php echo $i ?></td> 
            <td><?php echo $row_baiviet['Ten_Baiviet'] ?></td>
            <td><img src="../upload/<?php echo $row_baiviet['Hinhanh_Baiviet'] ?>" class="hinhanhbv"></td>
        
            <td><?php echo $row_baiviet['Tomtat_Baiviet'] ?></td>
           
            <td><?php echo $row_baiviet['Ten_Tintuc'] ?></td>

            <td><a href="xulybaiviet.php?quanly=sua&idsua=<?php echo $row_baiviet['ID_Baiviet']?>">Sửa</a> | <a href="?xoa=<?php echo $row_baiviet['ID_Baiviet']?>">Xóa</a></td>
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