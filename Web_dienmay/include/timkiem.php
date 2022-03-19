<!-- $query = "SELECT sanpham.*, danhmucsp.Ten_Danhmuc, thuonghieusp.Ten_Thuonghieu

			FROM sanpham INNER JOIN danhmucsp ON sanpham.ID_Danhmuc = danhmucsp.ID_Danhmuc

						 INNER JOIN thuonghieusp ON sanpham.ID_Thuonghieu = thuonghieusp.ID_Thuonghieu

						  WHERE Ten_Sanpham LIKE '%$tukhoa%' OR Ten_Danhmuc LIKE '%$tukhoa' OR Ten_Thuonghieu LIKE '%$tukhoa' ORDER BY ID_Sanpham DESC "; --> 
	 <?php
		if(isset($_POST['search_button'])){
			$tukhoa = $_POST['search_sanpham'];
		
			$sql_search = mysqli_query($con, "SELECT sanpham.*, danhmucsp.Ten_Danhmuc FROM sanpham INNER JOIN danhmucsp ON sanpham.ID_Danhmuc = danhmucsp.ID_Danhmuc WHERE Ten_Sanpham LIKE '%$tukhoa%' OR Ten_Danhmuc LIKE '%$tukhoa%'  ORDER BY ID_Sanpham DESC");
		
			$title = $tukhoa;
		}
	 ?> 
<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Tìm kiếm:  <?php echo $title ?>
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
							<div class="row">
								<?php
								
								
									while($row_danhmuc = mysqli_fetch_array($sql_search)){  
								 ?>

								<div class="col-md-4 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item text-center">
											<img src="images/<?php echo $row_danhmuc['Hinhanh_Sanpham'] ?>" alt="">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="?quanly=chitietsp&id=<?php echo $row_danhmuc['ID_Sanpham']?>" class="link-product-add-cart">Xem sản phẩm</a>
												</div>
											</div>
											<span class="product-new-top">Mới</span>

										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="?quanly=chitietsp&id=<?php echo $row_danhmuc['ID_Sanpham'] ?>"><?php echo $row_danhmuc['Ten_Sanpham'] ?></a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price" ><?php echo number_format($row_danhmuc['Giakhuyenmai_Sanpham']).'đ'?></span>
												<del><?php echo number_format($row_danhmuc['Gia_Sanpham']).'đ'?></del>
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
											<form action="?quanly=giohang" method="post">
								<fieldset>
									<input type="hidden" name="tensanpham" value="<?php echo $row_danhmuc['Ten_Sanpham']?>" />
									<input type="hidden" name="idsanpham" value="<?php echo $row_danhmuc['ID_Sanpham']?>" />
									<input type="hidden" name="gia" value="<?php echo $row_danhmuc['Giakhuyenmai_Sanpham']?>" />
									<input type="hidden" name="soluong" value="1" />
									<input type="hidden" name="hinhanh" value="<?php echo $row_danhmuc['Hinhanh_Sanpham']?>" />

									
									<input type="submit" name="themgiohang" value="Thêm vào giỏ hàng" class="button" />
								</fieldset>
							</form>
											</div>
										</div>
									</div>
								</div>
								<?php 
							
									} 
								?>
								
								
							</div>
						</div>
						<!-- //first section -->
					</div>
				</div>
				<!-- //product left -->
				<!-- product right -->
							</div>
		</div>
	</div>