<?php
	include 'inc/header.php';
	//include 'inc/slider.php';
?>

<?php
    if(!isset($_GET['idsanpham']) || $_GET['idsanpham']== NULL){
         echo "<script>window.location= '404.php';</script>";
    }else{
         $id = $_GET['idsanpham'];
    }

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
     	$soluong = $_POST['soluong'];
        $themgiohang = $cart->them_giohang($id, $soluong);
        $cart = new giohang();
    } 

    $idkhachhang = session::get('id_khachhang'); 
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['sosanh'])){
     	$idsanpham = $_POST['idsanpham'];
        $them_sosanh = $sanpham->sosanh_sanpham($idsanpham, $idkhachhang);
    } 

     if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['yeuthich'])){
     	$idsanpham = $_POST['idsanpham'];
        $them_yeuthich = $sanpham->yeuthich_sanpham($idsanpham, $idkhachhang);
    } 


    
    $idkhachhang = session::get('id_khachhang');
    if(isset($_POST['binhluan_submit'])){
    	$idsanpham = $_POST['idsp_binhluan'];
    	$binhluan = $khachhang->them_binhluan($idsanpham, $idkhachhang);
    	
    }


 ?>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php
    			 $chitietsp = $sanpham->Laysanpham_chitiet($id);
    			 if($chitietsp){
    			 	while($result_chitiet = $chitietsp->fetch_assoc()){

    		 ?>

				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/upload/<?php echo $result_chitiet['Hinhanh_Sanpham'] ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_chitiet['Ten_Sanpham'] ?></h2>
					<p style="color: blue; font-weight: bold; font-size: 15px;">Thông số sản phẩm:</p>
					<p><?php echo $result_chitiet['Mota_Sanpham'] ?></p>					
					<div class="price">
						<p>Giá sản phẩm: <span><?php echo number_format($result_chitiet['Gia_Sanpham']).'đ' ?></span></p>
						<p>Danh mục: <span><?php echo $result_chitiet['Ten_Danhmuc'] ?></span></p>
						<p>Sản phẩm của thương hiệu: <span><?php echo $result_chitiet['Ten_Thuonghieu'] ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="soluong" value="1" min="1"/>&emsp;
						<input type="hidden"  name="idsanpham" value="<?php echo $result_chitiet['ID_Sanpham']?>"/>
						 <?php
	   	 					$login_check=session::get('login_khachhang');
		   					if($login_check==false){
		   						echo '';
		  				 	}else{
		   						echo ' <input type="submit" class="buysubmit" name="submit" value="Mua ngay!"/>';
		   				?>
		   				<?php 		
		   						}
	   					?>	 	

					</form>	
					<br>
					<p>
					<?php 
						if(isset($themgiohang)){//Dong 14
							echo '<span style="color: red; font-size: 18px" >
								Sản phẩm đã tồn tại trong giỏ hàng	
							</span>';
						}
					 ?>

				
					 </p>		
				</div>

				<div class="add-cart">
					<div class="button-chitiet">
						<form action="" method="post">
						<!-- <a href="?sosanh=<?php echo $result_chitiet['ID_Sanpham']?>" class="buysubmit">So sánh sản phẩm</a> -->
						<input type="hidden"  name="idsanpham" value="<?php echo $result_chitiet['ID_Sanpham']?>"/>
						
						 <?php
	   	 					$login_check=session::get('login_khachhang');
		   					if($login_check==false){
		   						echo '';
		  				 	}else{
		   						echo '<input type="submit" class="buysubmit" name="sosanh" value="So sánh"/>';
		   				?>
		   				<?php 		
		   						}
	   					?>	 
						</form>
						<form action="" method="post">
						<input type="hidden"  name="idsanpham" value="<?php echo $result_chitiet['ID_Sanpham']?>"/>
						 <?php
	   	 					$login_check=session::get('login_khachhang');
		   					if($login_check==false){
		   						echo '';
		  				 	}else{
		  				 		echo '<input type="submit" class="buysubmit" name="yeuthich" value="Thêm vào danh sách yêu thích"/>';
		   				?>
		   				&emsp;
		   				<?php 
		   						
		   						}
	   					?>
	   					

						</form>
						</div>
						<div class="clear"></div>
						<p>
						<?php 
						if(isset($them_sosanh)){
							echo $them_sosanh;
							}
						 ?>
						
						<?php 
						if(isset($them_yeuthich)){
							echo $them_yeuthich;
							}
						 ?>
						 </p>
						
				</div>
			</div>
	</div>
	<?php
			}
		} 
	 ?>
				<div class="rightsidebar span_3_of_1">
					<h2>Danh mục sản phẩm</h2>
					<ul>
						<?php
						$Lay_danhmuc = $danhmuc->hienthi_danhmuc();
						if($Lay_danhmuc){
						while($result_danhmuc = $Lay_danhmuc->fetch_assoc()){ 
						 ?>
				      <li><a href="danhmuc_sanpham.php?iddanhmuc=<?php echo $result_danhmuc['ID_Danhmuc']?>"><?php echo $result_danhmuc['Ten_Danhmuc'] ?></a></li>
				      <?php
				     	 } 
					}
				       ?>
				     
    				</ul>
    	
 				</div>
 		</div>
<style>
	input.btn.btn-success {
    margin-left: 88%;
    font-size: 15px;
}

.hienthi_binhluan {
   
    border: 0.5px solid;
    margin-top: 30px;
    width: 66%;
    padding: 15px 15px 15px 15px;
}
</style>
 		<div class="binhluan">
 			<div class="row">
 				<div class="col-md-8">
 			<h3 style="font-weight: bold;">Bình luận về sản phẩm</h3>
 			<?php
 			if(isset($binhluan)){
 				echo $binhluan;
 			} 
 			 ?>
 			<form action="" method="post">
 				<p><input type="hidden" value=" " name="idsp_binhluan"></p>
	 			<input type="hidden" class="form-control" name="tennguoibinhluan" placeholder="Tên người bình luận"><br>
	 			<p><textarea class="form-control" name="binhluan" placeholder="Bình luận..." resize="none" rows="7"></textarea></p>
	 			 <?php
	   	 					$login_check=session::get('login_khachhang');
		   					if($login_check==false){
		   						echo '';
		  				 	}else{
		   						echo '<input type="submit" value="Gửi bình luận" class="btn btn-success" name="binhluan_submit">';
		   				?>
		   				<?php 		
		   						}
	   					?>	 	

	 			
 			</form>
 				</div>
 			</div>

 			<p style="font-size: 25px; font-weight: bold;">Bình luận của khách hàng về sản phẩm</p>
 			<div class="hienthi_binhluan">
 				<?php 
 				$id = session::get('idsanpham');
 				$hienthi_binhluan = $khachhang->hienthi_binhluan($id);
 				if($hienthi_binhluan){
 					while($result_binhluan = $hienthi_binhluan->fetch_assoc()){
 				?>
 				<p><?php echo $result_binhluan['Ten_Khachhang'] ?></p>
 				<p style="margin-left: 0px;font-size: 17px; background: #d6e1fa; color: #000; padding: 7px;"><?php echo $result_binhluan['Chitiet_Binhluan'] ?></p>
 				<?php

 					}
 				}

 				 ?>
 			</div>
 		</div>
 	</div>
	<?php
		include 'inc/footer.php';
?>