
<?php
	include 'inc/header.php';
//	include 'inc/slider.php';
?>
<?php
	 if(isset($_GET['idgiohang'])){
         $idgiohang = $_GET['idgiohang'];
         $xoagiohang = $cart->xoa_giohang($idgiohang);
    }

	 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
	 	$idgiohang = $_POST['idgiohang'];
     	$soluong = $_POST['soluong'];
      $capnhatgiohang = $cart->capnhat_giohang($idgiohang, $soluong);

      if($soluong<=0){
      	 $xoagiohang = $cart->xoa_giohang($idgiohang);
      }
    }  
 ?>
 <?php
 //Tu dong refresh se tu dong quay ve id = live (trực tiếp bằng cái id đó)
 	if(!isset($_GET['id'])){
 		echo "<meta http-equiv='refresh' content='0;URL=?id=live' >";
 	} 
  ?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2 style="color: blue; font-weight: bold;">Giỏ hàng của bạn</h2>
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
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>
								<th width="15%">Giá </th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng tiền sản phẩm</th>
								<th width="10%">Quản lý</th>
							</tr>
							<?php
								$lay_giohang = $cart->laygiohang();
								if($lay_giohang){ 
									$tongtien = 0;
									$sl = 0;
									while($result = $lay_giohang->fetch_assoc()){
							 ?>
							<tr>
								<td><?php echo $result['Ten_Sanpham'] ?></td>
								<td><img src="admin/upload/<?php echo $result['Hinhanh']?>" alt=""/></td>
								<td><?php echo number_format($result['Gia_Sanpham']).'đ' ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="idgiohang" min="0" value="<?php echo $result['ID_Giohang']?>"/>
										<input type="number" name="soluong" min="0" value="<?php echo $result['Soluong']?>"/>
										<input type="submit" name="submit" value="Cập nhật"/>
									</form>
								</td>
								<td><?php
									$total = $result['Gia_Sanpham'] * $result['Soluong'];
									echo number_format($total).'đ'; 
								 ?></td>
								<td><a onclick="return confirm('Bạn chắc muốn xóa sản phẩm này chứ?');" href="?idgiohang=<?php echo $result['ID_Giohang']?>"href="?idgiohang=<?php echo $result['ID_Giohang']?>"> Xóa</a></td>
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
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Tổng tiền : </th>
								<td><?php
									
									echo number_format($tongtien).'đ';
								//	session::set('sum', $tongtien);
									session::set('soluong', $sl);
								 ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
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
						
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php" style="padding: 15px; background: #2fa8bc; color: white; border-radius: 15px;" style="text-decoration: none;"><img src="images/undo_32px.png" alt="">Tiếp tục mua sắm</a>
						</div>
						<div class="shopright">
							<a href="thanhtoan.php" style="padding: 15px; background: #2fa8bc; color: white; border-radius: 15px;" style="text-decoration: none;">Thanh toán</a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
	include 'inc/footer.php';
?>
