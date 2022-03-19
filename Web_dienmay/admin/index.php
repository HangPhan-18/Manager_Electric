<?php
	session_start();
	include ('../db/connect.php'); 
 ?>

<?php 
	if(isset($_POST['dangnhap'])){
		$taikhoan = $_POST['taikhoan'];
		$matkhau = md5($_POST['matkhau']);
		if($taikhoan =='' || $matkhau==''){
			echo '<p>Đăng nhập không thành công</p>';
		}else
			$sql_admin = mysqli_query($con, "SELECT * FROM admin WHERE Email = '$taikhoan' AND Password ='$matkhau' LIMIT 1");
			//Trả về số hàng trong tập kết quả
			$count = mysqli_num_rows($sql_admin);
			//Tìm nạp một hàng kết quả dưới dạng một mảng số và dưới dạng một mảng kết hợp
			$row_dangnhap = mysqli_fetch_array($sql_admin);
			if($count>0){
				$_SESSION['dangnhap'] = $row_dangnhap['Ten_Admin'];
				$_SESSION['idadmin'] = $row_dangnhap['ID_Admin'];
			header("Location: dashboard.php");
		}else{
			echo '<p>Đăng nhập không thành công</p>';
		}
	}
 ?>
 <style>
 	p {
    margin-top: 0;
    margin-bottom: 1rem;
    color: red;

}
.tieude {
    background: red;
    border-top-left-radius: 27px;
    border-top-right-radius:27px ;
    width: 116%;
    padding-bottom: 5%;
    padding-top: 3%;
    margin-left: -75px;
    color: white;
    font-size: 25px;
    text-align: center;
}
form.login {
    width: 542px;
    border: 1px solid;
    margin-left: 125px;
   border-radius: 27px;
    padding-left: 75px;
   background: white;
    margin-top: 100px;
    padding-top: 0px;
    font-size: 17px;
    font-weight: bold;
    padding-bottom: 30px;
}
/*h2.tieude {
    margin: 0px 15%;
    padding-top: 50px;
}*/
input.btn.btn-success {
    width: 85%;
 }
 </style>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Đăng nhập Admin</title>
		<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	</head>
	<body>
		
		<div class="login">
		<div class="form-group">

			<form action="" method="post" class="login">
			<div class="tieude">Đăng nhập hệ thống</div><br>
			<label>Tài khoản</label>
			<input type="text" name="taikhoan" placeholder="Nhập email..." class="form-control">
			<br>
			<label>Mật khẩu</label>
			<input type="password" name="matkhau" placeholder="Nhập mật khẩu người dùng..." class="form-control"><br>
			<br>
			<input type="submit" name="dangnhap" class="btn btn-success" value="Đăng nhập">
			</form>
		</div>
		</div>
	</body>
	
</html>
