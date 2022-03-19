<?php
	include 'inc/header.php';
	//include 'inc/slider.php';
?>
<?php
	if(isset($_GET['iddathang']) && $_GET['iddathang']== 'dathang'){
        $id_khachhang = session::get('id_khachhang');
        $them_don_dathang = $cart->themdon($id_khachhang);
      
        $xoa_giohang = $cart->xoa_dulieu_giohang();
  		  echo '<script> location.replace("dathang_thanhcong.php"); </script>';
       
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
.dathang {
    padding: 13px 31px;
    background: #fc0303;
    border: none;
    font-size: 25px;
    font-weight: bold;
    color: #fff;
    margin-left: 43%;
    cursor: pointer;
    border-radius: 2%;
}

</style>
<form action="" method="POST">
	
</form>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="heading">
    			<h3>Thanh toán tại nhà</h3>
    		</div>
    		<div class="clear"></div>
    		<div class="box_left"><div class="cartpage">
			    <?php
			    	if(isset($capnhatgiohang)){
			    		echo $capnhatgiohang;
			    	} 
			    ?>

			    <?php
			    	if(isset($xoagiohang)){
			    		echo $xoagiohang;
			    	} 
			    ?>
				<table class="tblone">
					<tr>	
						<th width="3%">ID</th>
						<th width="25%">Tên sản phẩm</th>
						
						<th width="20%">Giá </th>
						<th width="28%">Số lượng</th>
						<th width="30%">Tổng tiền sản phẩm</th>
						
					</tr>
						<?php
							
							$lay_giohang = $cart->laygiohang();
							if($lay_giohang){ 
								$tongtien = 0;
								$sl = 0;
								$i=0;
								while($result = $lay_giohang->fetch_assoc()){
									$i++;
						 ?>
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $result['Ten_Sanpham'] ?></td>
						<td><?php echo number_format($result['Gia_Sanpham']).'đ' ?></td>
						<td>	
							<?php echo $result['Soluong']?>
						</td>
						<td>
							<?php
							$total = $result['Gia_Sanpham'] * $result['Soluong'];
							echo number_format($total).'đ'; 
							?>
						</td>
						
						</tr>
							<?php
							$tongtien += $total;
							$sl = $sl + $result['Soluong'];
								}
							} 
							 ?>
						</table>
						<?php
							$check = $cart->check_cart();
							if($check){
						?>
						<table style="float:right;text-align:left; width: 40%">
							<tr>
								<th>Tổng tiền : </th>
								<td><?php
									echo number_format($tongtien).'đ';
								//	session::set('sum', $tongtien);
									session::set('soluong', $sl);
								 ?></td>
							</tr>
							<tr>
								<th>VAT: </th>
								<td>10% (<?php echo number_format($vat = $tongtien * 0.1).'đ'?>)</td>
							</tr>
							<tr>
								<th>Tổng số lượng: </th>
								<td><?php
									$sl = $sl + $result['Soluong'];
									echo $sl;
								 ?></td>
							</tr>
							<tr>
								<th>Tổng cộng :</th>
								<td><?php
									$vat = $tongtien * 0.1;
									$Tongtien = $tongtien + $vat;
									echo number_format($Tongtien).'đ'; 
								 ?></td>
							</tr>
							
					   </table>
					   <?php
						}
						else{
							echo '<span style="color: red; font-size: 20px; font-weight: bold; margin-left: 45%">Giỏ hàng của bạn trống!</span>';
							}
					    ?>
						
					</div></div>
    		<div class="box_right"><table class="tblone">

    			<?php
    				$id = session::get('id_khachhang');
    				$get_khachhang = $khachhang->hienthi_khachhang($id);
    				if($get_khachhang){
    					while($result = $get_khachhang->fetch_assoc()){
    			
    			 ?>
    			<tr>
  					<td>Họ tên: </td>
  					<td><?php echo $result['Ten_Khachhang'] ?></td>  				
      			</tr>

    			<tr>
  					<td>Địa chỉ: </td>
  					<td><?php echo $result['Diachi'] ?></td>  				
      			</tr>
      			<tr>
  					<td>Email: </td>
  					<td><?php echo $result['Email'] ?></td>  				
      			</tr>
      			<tr>
  					<td>Số điện thoại: </td>  				
  					<td><?php echo $result['Sdt'] ?></td>  				
      			</tr>
      			<tr>
      				<td colspan="3"><a href="suaprofile.php">Cập nhật thông tin</a></td>
      			</tr>
      			
      			<?php
      				}
      			} 
      			 ?>
    		</table>
    		</div>

    	</div>	
    	<br>
    	<a href="?iddathang=dathang" class="dathang" style="text-decoration: none;">Đặt hàng ngay!</a>
	</div>
</div>
<?php
	include 'inc/footer.php';
?>