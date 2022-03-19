<?php
	session_start();
	if(!isset($_SESSION['dangnhap'])){
		header('Location: index.php');
	}
	if(isset($_GET['login'])){
 	$dangxuat = $_GET['login'];
 }else{
 		$dangxuat='';
 }
 if($dangxuat=='dangxuat'){
 	session_destroy();
 	header('Location: index.php');
 }
 ?>
 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome to Admin</title>
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
			background: #00b8ff;
		}
		li.dangxuat {
    margin-left: 70px;
    padding-top: 15px;
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

      <li class="dangxuat">
      	Xin chào: <?php echo $_SESSION['dangnhap'] ?> |
				<a href="?login=dangxuat">Đăng xuất</a>
      </li>
    </ul>
   
  </div>
</nav>
</body>
</html>