<?php 
    include 'lib/session.php';
    session::init();//Tạo session mới khi nhấn vào danh mục
 ?>
 <?php 
 		include_once 'lib/database.php';
		include_once 'helpers/format.php'; 
		spl_autoload_register(function($className){
		
				include_once "classes/".$className.".php";
		});
		$db = new database();
		$danhmuc = new danhmuc();
		$format = new format();
		$cart = new giohang();
		$user = new user();
		$sanpham = new sanpham();
		$danhmuc = new danhmuc();
		$thuonghieu = new thuonghieu();
		$khachhang = new khachhang();

  ?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Linh kiện | Phụ kiện máy tính Dino</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<p style="margin-left: 148px; margin-bottom: -45px; font-weight: bold; font-size: 30px;color: #005aff;">Linh kiện | Phụ kiện máy tính
				</p>
				<a href="index.php"><img src="images/animelab_48px.png" width="80px" height="80px" style="margin-top: -30px;"></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
			    	 <?php
			    	if(isset($_GET['search'])){
			    			$tukhoa = $_GET['search'];
			    			$timkiem_sanpham = $sanpham->timkiemsp($tukhoa);
			    	} 
			    	 ?> 
				    <form method="POST" action="timkiem.php">
				    	<input type="text" placeholder="Tìm kiếm sản phẩm..." name="tukhoa">
				    	<input type="submit" value="Tìm kiếm" name="search">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="giohang.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Giỏ hàng</span>
								<span class="no_product">
									<?php
										$check = $cart->check_cart();
										if($check){
										$sl = session::get("soluong");
										echo $sl;
										// $sum = session::get("sum");
										// echo number_format($sum).'đ';
									}
									else{
										echo 'Trống';
										}
									 ?>
									
								</span>
							</a>
						</div>
			      </div>
			      <?php 
			      if(isset($_GET['idkhachhang'])){
			      	$idkhachhang = $_GET['idkhachhang'];
			      	$xoa_giohang = $cart->xoa_dulieu_giohang();
			      	$xoa_sosanh =  $cart->xoa_dulieu_sosanh($idkhachhang);
			      	session::destroy();
			      }
			       ?>
			     

		   <div class="login">
		   	<?php 
		   	$login_check=session::get('login_khachhang');
		   	if($login_check==false){
		   		echo '<a href="login.php">Đăng nhập</a>';
		   	}
		   	else{
		   		echo '<a href="?idkhachhang='.session::get('id_khachhang').'">Đăng xuất</a>';
		   	}
		   ?>
		  </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Trang chủ</a></li>
	  <li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	        	Danh mục sản phẩm
	        	
	       </a>
	        <ul class="dropdown-menu">
	        	<?php
	        	$laydanhmuc = $danhmuc->hienthi_danhmuc();
	        	if($laydanhmuc){
	      			while($result_new = $laydanhmuc->fetch_assoc()){
	      		?> 	
	          <li>
	          	<a href="danhmuc_sanpham.php?iddanhmuc=<?php echo $result_new['ID_Danhmuc'] ?>"><?php echo $result_new['Ten_Danhmuc'] ?></a>
	          </li>
	          <?php
	          	}
	          } 
	          ?>
	        </ul>

	      </li>
	    <li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	        	Thương hiệu
	        	 
	     </a>
	    
	         <ul class="dropdown-menu">
	        	<?php
	        	$thuonghieusp = $thuonghieu->hienthi_thuonghieu();
	        	if($thuonghieusp){
	      			while($result_new = $thuonghieusp->fetch_assoc()){
	      		?>
	          <li>
	          	<a href="thuonghieu_sanpham.php?idthuonghieu=<?php echo $result_new['ID_Thuonghieu'] ?>"><?php echo $result_new['Ten_Thuonghieu'] ?></a>
	          </li>
	          <?php
	          	}
	          } 
	          ?>
	        </ul>
	       
	    </li>
	     
	  <?php
	  	$check_cart = $cart->check_cart();
	  	if($check_cart==true){
	  		echo ' <li><a href="giohang.php">Giỏ hàng</a></li>';
	  	} else{
	  		echo '';
	  	}
	   ?>
	 
	  <?php
	  	 	$login_check=session::get('login_khachhang');
		   	if($login_check==false){
		   		echo '';
		   	}else{
		   		echo ' <li><a href="profile.php">Thông tin khách hàng</a> </li>';
		   	}
	   ?>
	   <?php
	   	 	$login_check=session::get('login_khachhang');
		   	if($login_check==false){
		   		echo '';
		   	}else{
		   		echo ' <li><a href="chitiet_donhang.php">Đơn hàng</a> </li>';
		   	}
	    ?>

	   <?php
	   	 	$login_check=session::get('login_khachhang');
		   	if($login_check==false){
		   		echo '';
		   	}else{
		   		echo '<li><a href="sosanh.php">So sánh</a> </li>';
		   	}
	    ?>
	 	 <?php
	   	 	$login_check=session::get('login_khachhang');
		   	if($login_check==false){
		   		echo '';
		   	}else{
		   		echo '<li><a href="dsyeuthich.php">Wishlist</a> </li>';
		   	}
	    ?>
	 	
	  <li><a href="lienhe.php">Liên hệ</a> </li>
	  <div class="clear"></div>
	</ul>
</div>