<?php
	include 'inc/header.php';
	//include 'inc/slider.php';
?>
<?php
	if(isset($_GET['iddathang']) && $_GET['iddathang']== 'dathang'){
        $id_khachhang = session::get('id_khachhang');
        $them_don_dathang = $cart->themdon($id_khachhang);
      
        $xoa_giohang = $cart->xoa_dulieu_giohang();
  		header("Location: dathang_thanhcong.php");
       
    }  
 ?>

<style>
	.box_left {
    width: 48%;
    border: 1px solid #000;
    float: left;
    padding: 10px;
}
.box_right {
    width: 48%;
    border: 1px solid #000;
    float: right;
     padding: 10px;
}
h2.dathang_thanhcong {
    text-align: center;
    color: #25c025;
    font-size: 27px;
    font-weight: bold;
    margin-top: 11px;

}
p.muasam {
    background: #c6c5ff;
    width: 174px;
    margin-left: 44%;
    padding: 11px 2px;
    text-align: center;
    font-size: 17px;
    font-weight: bold;
    cursor: pointer;
    border: 1px solid;
    margin-bottom: 40px;
    margin-top: 10px;
}

</style>
<form action="" method="POST">
	
</form>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<h2 class="dathang_thanhcong">Bạn đã đặt hàng thành công!<img src="images/success.png" class="dathang_thanhcong" alt=""></h2>
    		<p style="text-align: center; margin-top: 18px;">Xem chi tiết đơn đặt hàng <a href="chitiet_donhang.php">tại đây.</a></p>

    	</div>	
    	<br>
    	<p class="muasam"><a href="index.php" style="text-decoration: none;">Tiếp tục mua sắm</a></p>
	</div>
</div>
<?php
	include 'inc/footer.php';
?>