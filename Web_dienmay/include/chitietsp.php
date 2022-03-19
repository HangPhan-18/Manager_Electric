<?php 
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}else{
		$id = '';
	}
	$sql_chitiet = mysqli_query($con, "SELECT * FROM sanpham WHERE ID_Sanpham = '$id'");

 ?>
 
<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">Trang chủ</a>
						<i>|</i>
					</li>
					<?php
						 while($row_chitiet = mysqli_fetch_array($sql_chitiet)){
					 ?>
					<li><?php echo $row_chitiet['Ten_Sanpham'] ?></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
	<!-- Single Page -->
	
	<div class="banner-bootom-w3-agileits py-5">
		<div class="container py-xl-4 py-lg-2">
			
			<!-- //tittle heading -->
			<div class="row">
				<div class="col-lg-5 col-md-8 single-right-left ">
					<div class="grid images_3_of_2">
						<div class="flexslider">
							<ul class="slides">

								<li data-thumb="images/<?php echo $row_chitiet['Hinhanh_Sanpham']?>">
									<div class="thumb-image">
										<img src="images/<?php echo $row_chitiet['Hinhanh_Sanpham']?>" data-imagezoom="true" class="img-fluid" alt=""> </div>
								</li>
							
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="col-lg-7 single-right-left simpleCart_shelfItem">
					<h3 class="mb-3"><?php echo $row_chitiet['Ten_Sanpham'] ?></h3>
					<p class="mb-3">
						<span class="item_price"><?php echo number_format($row_chitiet['Giakhuyenmai_Sanpham']).'đ' ?></span>
						<del class="mx-2 font-weight-light"><?php echo number_format($row_chitiet['Gia_Sanpham']).'đ' ?></del>
						<label>Miễn phí vận chuyển <img src="images/free_shipping_26px.png" alt=""></label>
					</p>
					<div class="single-infoagile">
						
					</div>
					<div class="product-single-w3l">
						<p>
							<?php echo $row_chitiet['Mota_Sanpham'] ?>
						</p>
						<hr width="100%" color="black">
						<p>
							<?php echo $row_chitiet['Chitiet_Sanpham'] ?>
						</p>
					</div>
					<br>
					<div class="occasion-cart">
						<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
							<form action="?quanly=giohang" method="post">
								<fieldset>
									<input type="hidden" name="tensanpham" value="<?php echo $row_chitiet['Ten_Sanpham']?>" />
									<input type="hidden" name="idsanpham" value="<?php echo $row_chitiet['ID_Sanpham']?>" />
									<input type="hidden" name="gia" value="<?php echo $row_chitiet['Giakhuyenmai_Sanpham']?>" />
									<input type="hidden" name="soluong" value="1" />
									<input type="hidden" name="hinhanh" value="<?php echo $row_chitiet['Hinhanh_Sanpham']?>" />

									
									<input type="submit" name="themgiohang" value="Thêm vào giỏ hàng" class="button" />
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- //Single Page -->
	<?php
	} 
	 ?>