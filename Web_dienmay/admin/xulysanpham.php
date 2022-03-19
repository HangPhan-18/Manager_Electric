<?php
  include '../db/connect.php' ;
 ?>
 <?php
    if(isset($_POST['themsanpham'])){
      $tensanpham = $_POST['tensanpham'];
      //Tên thực sự của file đã upload.
      $hinhanh = $_FILES['hinhanh']['name'];
     
      $giasanpham = $_POST['giasanpham'];
      $giakhuyenmai = $_POST['giakhuyenmai'];
      $soluong = $_POST['soluong'];
      $mota = $_POST['mota'];
      $chitiet = $_POST['chitiet'];
      $danhmuc = $_POST['danhmuc'];
      $path ='../upload/';
      //File đã upload trong thư mục tạm thời trên Web Server.
      $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];

      $sql_insert_sanpham =mysqli_query($con, "INSERT INTO sanpham(Ten_Sanpham, Chitiet_Sanpham, Mota_Sanpham, Gia_Sanpham, Giakhuyenmai_Sanpham, Soluong_Sanpham, Hinhanh_Sanpham, ID_Danhmuc) VALUES('$tensanpham', '$chitiet', '$mota', '$giasanpham', '$giakhuyenmai', '$soluong', '$hinhanh', '$danhmuc')");
     move_uploaded_file($hinhanh_tmp, $path.$hinhanh);
    }


    elseif(isset($_POST['suasanpham'])){
      $id = $_POST['idsanpham'];
      $tensanpham = $_POST['tensanpham'];
      $hinhanh = $_FILES['hinhanh']['name'];
      $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
      $giasanpham = $_POST['giasanpham'];
      $giakhuyenmai = $_POST['giakhuyenmai'];
      $soluong = $_POST['soluong'];
      $mota = $_POST['mota'];
      $chitiet = $_POST['chitiet'];
      $danhmuc = $_POST['danhmuc'];
      $path ='../upload/';
      //Nếu người dùng không chọn sửa ảnh
      if($hinhanh==''){
          $sql_update = "UPDATE sanpham SET Ten_Sanpham='$tensanpham', Chitiet_Sanpham='$chitiet', Mota_Sanpham='$mota', Gia_Sanpham='$giasanpham', Giakhuyenmai_Sanpham='$giakhuyenmai', Soluong_Sanpham='$soluong', ID_Danhmuc='$danhmuc' WHERE ID_Sanpham='$id'";
      }else{
      move_uploaded_file($hinhanh_tmp, $path.$hinhanh);
      $sql_update=  "UPDATE sanpham SET Ten_Sanpham='$tensanpham', Chitiet_Sanpham='$chitiet', Mota_Sanpham='$mota', Gia_Sanpham='$giasanpham', Giakhuyenmai_Sanpham='$giakhuyenmai', Soluong_Sanpham='$soluong',Hinhanh_Sanpham='$hinhanh',  ID_Danhmuc='$danhmuc'WHERE ID_Sanpham='$id'";
     
     // header("Location: xulydanhmuc.php");
    }
     mysqli_query($con, $sql_update);
   }

    if(isset($_GET['xoa'])){
      $id = $_GET['xoa'];
      $sql_xoa = mysqli_query($con, "DELETE FROM sanpham WHERE ID_Sanpham = '$id'");
      $path_delete ='../upload/';
      
    }
 ?> 
 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sản phẩm</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  <style>
     .logo_agile h1 a {
    color: red;
    font-size: 38px;
    text-decoration: none;
    letter-spacing: 1px;
    position: relative;
}
/*img {
    width: 150px;
    height: 115px;
}*/
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
          $id_sua = $_GET['idsua'];
          $sql_sua = mysqli_query($con, "SELECT * FROM sanpham WHERE ID_Sanpham = '$id_sua'");
          $row_sua =mysqli_fetch_array($sql_sua);
          $id_danhmuc = $row_sua['ID_Danhmuc'];
          ?>
          <div class="col-md-4">
         <h4 style="font-weight: bold;">Sửa thông tin chi tiết sản phẩm</h4>
          
            <form action="" method="POST" enctype="multipart/form-data">
              <!-- Chia nhỏ hình ảnh gửi lên server -->
              <label >Tên sản phẩm</label>
              <input type="text" name="tensanpham" class="form-control" value="<?php echo $row_sua['Ten_Sanpham']?>" ><br> 
              <input type="hidden" name="idsanpham" class="form-control"  value="<?php echo $row_sua['ID_Sanpham']?> ">
              
              <label>Hình ảnh</label>
               <input type="file" name="hinhanh" class="form-control" ><br>
               <img src="../upload/<?php echo $row_sua['Hinhanh_Sanpham']?>" alt="" height="90px">
               <br>
               <label>Giá sản phẩm</label>
               <input type="text" name="giasanpham" class="form-control" value="<?php echo $row_sua['Gia_Sanpham']?>" ><br> 

               <label>Giá khuyến mãi</label>
               <input type="text" name="giakhuyenmai" class="form-control" value="<?php echo $row_sua['Giakhuyenmai_Sanpham']?>" ><br>

                <label>Số lượng</label>
               <input type="text" name="soluong" class="form-control" value="<?php echo $row_sua['Soluong_Sanpham']?>" ><br>

               <label>Mô tả sản phẩm</label>
               <textarea name="mota" class="form-control" ><?php echo $row_sua['Mota_Sanpham']?></textarea> 

               <label>Chi tiết sản phẩm</label>
               <textarea name="chitiet" class="form-control" ><?php echo $row_sua['Chitiet_Sanpham']?></textarea><br>

               <label>Danh mục sản phẩm</label>
               <?php
                $sql_danhmuc = mysqli_query($con, "SELECT * FROM danhmucsp ORDER BY ID_Danhmuc DESC"); 
                ?>
               <select name="danhmuc">
                 <option value="">--Chọn danh mục---</option>
                 <?php
                 while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){ 
                  if($id_danhmuc == $row_danhmuc['ID_Danhmuc']){
                  ?>
                 <option selected value="<?php echo $row_danhmuc['ID_Danhmuc'] ?>"><?php echo $row_danhmuc['Ten_Danhmuc'] ?></option>
                  <?php
                  }
                  else{

                   ?>
                    <option  value="<?php echo $row_danhmuc['ID_Danhmuc'] ?>"><?php echo $row_danhmuc['Ten_Danhmuc'] ?></option>
                   <?php 
                   }
                 }
                    ?>
               </select>
               <input type="submit" name="suasanpham" value="Sửa sản phẩm" class="btn btn-default">
             </form>
        </div>

         <?php
      }else{

          ?> 
        <div class="col-md-4" >
         <h4 style="font-weight: bold; margin-left: -415px;">Thêm sản phẩm mới</h4>
          
            <form action="" method="POST" enctype="multipart/form-data" style="width: 320px; margin-left: -170px;"><!-- Chia nhỏ hình ảnh gửi lên server -->
              <label >Tên sản phẩm</label>
              <input type="text" name="tensanpham" class="form-control" placeholder="Nhập vào tên sản phẩm..." ><br> 

              <label>Hình ảnh</label>
               <input type="file" name="hinhanh" class="form-control" ><br>

               <label>Giá sản phẩm</label>
               <input type="text" name="giasanpham" class="form-control" placeholder="Nhập vào giá sản phẩm..." ><br> 
               <label>Giá khuyến mãi</label>
               <input type="text" name="giakhuyenmai" class="form-control" placeholder="Nhập giá khuyến mãi..." ><br>
                <label>Số lượng</label>
               <input type="text" name="soluong" class="form-control" placeholder="Nhập giá khuyến mãi..." ><br>
               <label>Mô tả sản phẩm</label>
               <textarea name="mota" class="form-control"></textarea> 
               <label>Chi tiết sản phẩm</label>
               <textarea name="chitiet" class="form-control"></textarea><br>

               <label>Danh mục sản phẩm</label>
               <?php
                $sql_danhmuc = mysqli_query($con, "SELECT * FROM danhmucsp ORDER BY ID_Danhmuc DESC"); 
                ?>
               <select name="danhmuc">
                 <option value="">--Chọn danh mục---</option>
                 <?php
                 while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){ 
                  ?>
                 <option value="<?php echo $row_danhmuc['ID_Danhmuc'] ?>"><?php echo $row_danhmuc['Ten_Danhmuc'] ?></option>
                  <?php
                   }
               
                ?>
               </select>

              
              <br>
               <input type="submit" name="themsanpham" value="Thêm sản phẩm" class="btn btn-default">
             </form>
        </div>
          <?php

          } 
           ?>    
      <div class="col-md-8">
        <h4 style="font-weight: bold;">Thông tin chi tiết sản phẩm</h4>
        <?php 
        $sql_select_sanpham = mysqli_query($con, "SELECT * FROM sanpham, danhmucsp WHERE sanpham.ID_Danhmuc = danhmucsp.ID_Danhmuc ORDER BY sanpham.ID_Sanpham DESC");
         ?>
        <table class="table table-bordered">
          <tr>
             <td>Thứ tự</td>
            <td>Tên sản phẩm</td>
            <td>Hình ảnh</td>
            <td>Giá sản phẩm</td>
            <td>Giá khuyến mãi</td>
            <td>Số lượng</td>
            <td>Danh mục</td>

            <td>Hoạt động</td>
           
          </tr>
           <?php
          $i=0;
          while($row_sanpham = mysqli_fetch_array($sql_select_sanpham)){ 
            $i++;
           ?> 
          <tr>
            <td><?php echo $i ?></td> 
            <td><?php echo $row_sanpham['Ten_Sanpham'] ?></td>
            <td><img src="../upload/<?php echo $row_sanpham['Hinhanh_Sanpham'] ?>"></td>
            <td><?php echo number_format($row_sanpham['Gia_Sanpham']).'đ' ?></td>
            <td><?php echo number_format($row_sanpham['Giakhuyenmai_Sanpham']).'đ' ?></td>
            <td><?php echo $row_sanpham['Soluong_Sanpham'] ?></td>
            <td><?php echo $row_sanpham['Ten_Danhmuc'] ?></td>

            <td><a href="xulysanpham.php?quanly=sua&idsua=<?php echo $row_sanpham['ID_Sanpham']?>">Sửa</a>  <a href="?xoa=<?php echo $row_sanpham['ID_Sanpham']?>">Xóa</a></td>
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