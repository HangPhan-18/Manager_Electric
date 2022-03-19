
<?php
	include 'inc/header.php';
//	include 'inc/slider.php';
?>
<?php
	 if(isset($_GET['idgiohang'])){
         $idgiohang = $_GET['idgiohang'];
         $xoagiohang = $cart->xoa_giohang($idgiohang);
    }
 ?>
 <?php

  ?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2 style="color: blue; font-weight: bold;">So sánh sản phẩm</h2>
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
								<th width="25%">Thứ tự so sánh</th>
								<th width="30%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>
								<th width="15%">Giá </th>
								<th width="20%">Quản lý</th>
								
							</tr>
							<?php
							 	$idkhachhang = session::get('id_khachhang'); 
								$lay_sosanh = $sanpham->lay_sosanh($idkhachhang);
								if($lay_sosanh){ 
									$i=0;
									while($result = $lay_sosanh->fetch_assoc()){
										$i++;
							 ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['Ten_Sanpham'] ?></td>
								<td><img src="admin/upload/<?php echo $result['Hinhanh_Sanpham']?>" alt=""/></td>
								<td><?php echo number_format($result['Gia_Sanpham']).'đ' ?></td>
								
								<td><a href="chitiet.php?idsanpham=<?php echo $result['ID_Sanpham']?>"> Xem so sánh</a></td>
							</tr>
							<?php
						
								}
							} 
							 ?>
							
							
						</table>
					
					
						
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
	include 'inc/footer.php';
?>
