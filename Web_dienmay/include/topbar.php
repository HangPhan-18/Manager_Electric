<?php
	if(isset($_POST['dangnhap_home'])){
		$taikhoan = $_POST['email_login'];
		$matkhau = md5($_POST['password_login']);
		if($taikhoan =='' || $matkhau==''){
			echo '<script>alert("Nhập thông tin chưa đầy đủ")</script>';
		}else{
			$sql_dangnhap = mysqli_query($con, "SELECT * FROM khachhang WHERE Email = '$taikhoan' AND Password ='$matkhau' LIMIT 1");
			//Trả về số hàng trong tập kết quả
			$count = mysqli_num_rows($sql_dangnhap);
			//Tìm nạp một hàng kết quả dưới dạng một mảng số và dưới dạng một mảng kết hợp
			$row_dangnhap = mysqli_fetch_array($sql_dangnhap);
			if($count>0){	
				$_SESSION['dangnhap_home'] = $row_dangnhap['Hoten'];
				$_SESSION['idkhachhang'] = $row_dangnhap['ID_Khachhang'];
		}else{
			echo '<script>alert("Đăng nhập không thành công")</script>';
			}
		} 
	}elseif (isset($_POST['dangky'])) {
		$name = $_POST['name'];
  		$phone = $_POST['phone'];
  		$address = $_POST['address'];
  		$email = $_POST['email'];
  		$password = md5($_POST['password']);
  		// --> Thi Insert vao bang khach hang 
  		$sql_khachhang = mysqli_query($con,"INSERT INTO khachhang(Hoten, Sdt, Diachi, Email, Password) VALUES ('$name', '$phone', '$address', '$email', '$password')");
  		$sql_select_khachhang = mysqli_query($con, "SELECT * FROM khachhang ORDER BY ID_Khachhang DESC LIMIT 1");
  		$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
		$_SESSION['dangnhap_home'] = $name;
		$_SESSION['idkhachhang'] = $row_khachhang['ID_Khachhang'];

	}

	
 ?>
 

<!-- top-header -->
	<div class="agile-main-top">
		<div class="container-fluid">
			<div class="row main-top-w3l py-2">
				<div class="col-lg-4 header-most-top">
					<p class="text-white text-lg-left text-center">Ưu đãi & giảm giá hàng đầu khu vực
						<i class="fas fa-shopping-cart ml-1"></i>
					</p>
				</div>
				<div class="col-lg-8 header-right mt-lg-0 mt-2">
					<!-- header lists -->
					<ul>
						<?php
						if(isset($_SESSION['dangnhap_home'])){ 
						 ?>
						<li class="text-center border-right text-white">
							<a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['idkhachhang']?>" class="text-white">
								<i class="fas fa-truck mr-2"></i>Xem đơn hàng</a>
						</li>
						<?php
						} 
						 ?>
						<li class="text-center border-right text-white">
							<i class="fas fa-phone mr-2"></i>Hot line: 001 234 5678
						</li>
						 <?php 
							 if(isset($_SESSION['dangnhap_home'])){
						  ?>
						 <li class="text-center text-white">
							<a href ="?quanly=giohang&dangxuat=1"  class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i> Đăng xuất</a>
							</li>
							<?php
								if(isset($_GET['quanly'])&&$_GET['quanly']=='giohang'&&isset($_GET['dangxuat'])&&$_GET['dangxuat']==1){
										session_destroy();
										header("Location: index.php");							
 									}
							?>
							<?php

							}
							else{ 
							 ?>
						 	<li class="text-center border-right text-white">
							<a href ="#" data-toggle="modal" data-target="#dangnhap" class="text-white">
								<i class="fas fa-sign-in-alt mr-2"></i> Đăng nhập </a>
							</li>
							<li class="text-center text-white">
							<a href="#" data-toggle="modal" data-target="#dangky" class="text-white">
								<i class="fas fa-sign-out-alt mr-2"></i>Đăng ký </a>
						</li>
				 		<?php
				 		}
				 	
				 		 ?>
					</ul>
					<!-- //header lists -->
				</div>
			</div>
		</div>
	</div>
	
		<div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center">Đăng nhập</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="text" class="form-control" placeholder=" " name="email_login" >
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="password_login">
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" name="dangnhap_home" value="Đăng nhập">
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
	<style>
		input.form-control {
    		width: 100%;
		}
	</style>	

	<!-- register -->
	<div class="modal fade" id="dangky" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Đăng ký tài khoản</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label class="col-form-label">Tên</label>
							<input type="text" class="form-control" placeholder=" " name="name" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder=" " name="email" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Số điện thoại</label>
							<input type="text" class="form-control" placeholder=" " name="phone" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Địa chỉ</label>
							<input type="text" class="form-control" placeholder=" " name="address" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="password" required="">
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" value="Đăng ký" name="dangky">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- header-bottom-->
	<div class="header-bot">
		<div class="container">
			<div class="row header-bot_inner_wthreeinfo_header_mid">
				<!-- logo -->
				<div class="col-md-3 logo_agile">
					<h1 class="text-center">
						<a href="index.php" class="font-weight-bold font-italic">
							<img src="images/Dino Electric.png" alt=" " class="img-fluid" width="90px" height="87px">Dino Store
						</a>
					</h1>
				</div>
				<!-- //logo -->
				<!-- header-bot -->
				<div class="col-md-9 header mt-4 mb-md-0 mb-4">
					<div class="row">
						<!-- search -->
						<div class="col-10 agileits_search">
							<form class="form-inline" action="index.php?quanly=timkiem" method="POST">
								<input class="form-control mr-sm-2" type="search" name="search_sanpham" placeholder="Tìm kiếm..." aria-label="Search" >
								<button class="btn my-2 my-sm-0" name="search_button" type="submit"><img src="images/search_30px.png" name="timkiem"></button>
							</form>
						</div>
						<!-- //search -->
						<!-- cart details -->
						<div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
							<div class="wthreecartaits wthreecartaits2 cart cart box_1">
								<a href="?quanly=giohang"><img src="images/shopping_cart_48px.png" width="40px" height="40px"></a>
							</div>
						</div>
						<!-- //cart details -->
					</div>
				</div>
			</div>
		</div>
	</div>