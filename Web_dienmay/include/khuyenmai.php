	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		
		<div class="carousel-inner">
			<?php
				$khuyenmai = mysqli_query($con, "SELECT * FROM khuyenmai WHERE Trangthai = '1' ORDER BY ID_Khuyenmai");
				$row_khuyenmai =mysqli_fetch_array($khuyenmai);
				 ?>
			<div class="carousel-item item1 active">
				
				<div class="container">
					<div class="w3l-space-banner">
						<div class="carousel-caption p-lg-5 p-sm-4 p-3">
							<p><?php echo $row_khuyenmai['Khuyenmai'] ?></p>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a> -->
	</div>

