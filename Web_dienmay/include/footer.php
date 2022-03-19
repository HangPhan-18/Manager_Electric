<?php 
		
		$sql_danhmuc = mysqli_query($con,  "SELECT * FROM Danhmucsp ORDER BY ID_Danhmuc DESC");
								
	?>

<!-- footer -->
	<footer>
		<div class="footer-top-first">
			<div class="container py-md-5 py-sm-4 py-3">
				<!-- footer first section --><!-- 
				<h2 class="footer-top-head-w3l font-weight-bold mb-2">Electronics :</h2> -->
				<p class="footer-main mb-4">Nếu bạn đang cân nhắc một chiếc máy tính xách tay mới, đang tìm kiếm một dàn âm thanh nổi trên xe hơi mới mạnh mẽ hoặc mua một chiếc HDTV mới, chúng tôi sẽ giúp bạn dễ dàng tìm thấy chính xác những gì bạn cần với mức giá bạn có thể mua được. Chúng tôi cập nhật giá thấp hàng ngày trên các sản phẩm như: TV, máy tính xách tay, điện thoại di động, máy tính bảng và iPad, trò chơi điện tử, máy tính để bàn, máy ảnh và máy quay phim, âm thanh, video và hơn thế nữa.
					</p>
				<!-- //footer first section -->
				<!-- footer second section -->
				<div class="row w3l-grids-footer border-top border-bottom py-sm-4 py-3">
					<div class="col-md-4 offer-footer">
						<div class="row">
							<div class="col-4 icon-fot">
								<i class="fas fa-dolly"></i>
							</div>
							<div class="col-8 text-form-footer">
								<h3 style="font-family: Time New Roman;">Miễn phí ship</h3>
								<p>cho đơn hàng từ 1 triệu đồng trở lên </p>
							</div>
						</div>
					</div>
					<div class="col-md-4 offer-footer my-md-0 my-4">
						<div class="row">
							<div class="col-4 icon-fot">
								<i class="fas fa-shipping-fast"></i>
							</div>
							<div class="col-8 text-form-footer">
								<h3 style="font-family: Time New Roman;">Chuyển phát nhanh</h3>
								<p>toàn quốc</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 offer-footer">
						<div class="row">
							<div class="col-4 icon-fot">
								<i class="far fa-thumbs-up"></i>
							</div>
							<div class="col-8 text-form-footer">
								<h3 style="font-family: Time New Roman;">Nhiều sự lựa chọn</h3>
								<p>về sản phẩm</p>
							</div>
						</div>
					</div>
				</div>
				<!-- //footer second section -->
			</div>
		</div>
		<!-- footer third section -->
		<div class="w3l-middlefooter-sec">
			<div class="container py-md-5 py-sm-4 py-3">
				<div class="row footer-info w3-agileits-info">
					<!-- footer categories -->
					<div class="col-md-3 col-sm-6 footer-grids">
						<h3 class="text-white font-weight-bold mb-3">Danh mục sản phẩm</h3>
						<ul>
							<?php
							while($row_footer = mysqli_fetch_array($sql_danhmuc)){ 
							 ?>
							<li class="mb-3">
								<a href="?quanly=danhmuc&id=<?php echo $row_footer['ID_Danhmuc']?>"><?php echo $row_footer['Ten_Danhmuc'] ?> </a>
							</li>
							<?php
							} 
							 ?>
						</ul>
					</div>
					<!-- //footer categories -->
					<div class="col-md-3 col-sm-6 footer-grids mt-md-0 mt-4">
						<h3 class="text-white font-weight-bold mb-3">Thông tin liên hệ</h3>
						<ul>
							<li class="mb-3">
								<i class="fas fa-map-marker"></i>Việt Nam</li>
							<li class="mb-3">
								<i class="fas fa-mobile"></i>+84 333 2222 3333 </li>
							<li class="mb-3">
								<i class="fas fa-phone"></i>+84 111 999 4444 </li>
							<li class="mb-3">
								<i class="fas fa-envelope-open"></i>
								 adminstore@gmail.com
							</li>
							<li>
								<i class="fas fa-envelope-open"></i>
								 admin_store_dienmay@gmail.com
							</li>
						</ul>
					</div>
					<div class="col-md-3 col-sm-6 footer-grids w3l-agileits mt-md-0 mt-4">
						<!-- newsletter -->
						<h3 class="text-white font-weight-bold mb-3">Bảng tin</h3>
						<p class="mb-3">Miễn phí vận chuyển với chỉ 1 đơn hàng!</p>
						<h3 class="text-white font-weight-bold mb-3">Theo dõi chúng tôi qua</h3>
						<img src="images/ins.png" alt="" style="cursor: pointer;">
						<img src="images/facebook_48px.png" alt="" style="cursor: pointer;">
						<img src="images/twitter_48px.png" alt="" style="cursor: pointer;">
						<!-- //newsletter -->
					</div>
				</div>
				<!-- //quick links -->
			</div>
		</div>
		<!-- //footer third section -->
	</footer>