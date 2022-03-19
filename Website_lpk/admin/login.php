<?php
	include '../classes/adminlogin.php';	
?>
<?php
	$class = new adminlogin();//goi class trong file adminlogin
	//su dung phuong thuc gui tap tin, du lieu bang phuong thuc get hay post
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$adminUser = $_POST['adminuser'];
		$adminPass = md5($_POST['adminpass']);

		$login_check = $class->login_admin($adminUser, $adminPass) ;
	} 

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$adminUser = $_POST['adminuser'];
		$adminPass = md5($_POST['adminpass']);

		$check_admin = $class->check_admin($adminUser, $adminPass) ;
	} 
 ?>
<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Đăng nhập hệ thống</h1>
			<span><?php
				if(isset($login_check)){
					echo $login_check;
				} 
			 ?></span>
			<div>
				<input type="text" placeholder="Username" required="" name="adminuser"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="adminpass"/>
			</div>
			<div>
				<input type="submit" value="Đăng nhập" />
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>