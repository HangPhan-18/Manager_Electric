	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
					$laythuonghieuIntel = $sanpham->laythuonghieuIntel();
					if($laythuonghieuIntel){ 
						while($resultIntel = $laythuonghieuIntel->fetch_assoc()){
				 ?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="chitiet.php?idsanpham=<?php echo $resultIntel['ID_Sanpham']?>"> <img src="admin/upload/<?php echo $resultIntel['Hinhanh_Sanpham']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Intel</h2>
						<p><?php echo $resultIntel['Ten_Sanpham'] ?></p>
						<div class="button"><span><a href="chitiet.php?idsanpham=<?php echo $resultIntel['ID_Sanpham']?>">Xem chi tiết</a></span></div>
				   </div>
			   </div>		
			   <?php
					}
			   } 
			    ?>	

			    <?php
					$laythuonghieuNVIDIA = $sanpham->laythuonghieuNVIDIA();
					if($laythuonghieuNVIDIA){ 
						while($resultNVIDIA = $laythuonghieuNVIDIA->fetch_assoc()){
				 ?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="chitiet.php?idsanpham=<?php echo $resultNVIDIA['ID_Sanpham']?>"><img src="admin/upload/<?php echo $resultNVIDIA['Hinhanh_Sanpham']?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>NVIDIA</h2>
						  <p><?php echo $resultNVIDIA['Ten_Sanpham'] ?></p>
						  <div class="button"><span><a href="chitiet.php?idsanpham=<?php echo $resultNVIDIA['ID_Sanpham']?>">Xem chi tiết</a></span></div>
					</div>
				</div>
				<?php
				}
				} 
				 ?>
			</div>
			<div class="section group">

				  <?php
					$laythuonghieuMSI = $sanpham->laythuonghieuMSI();
					if($laythuonghieuMSI){ 
						while($resultMSI = $laythuonghieuMSI->fetch_assoc()){
				 ?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="chitiet.php?idsanpham=<?php echo $resultMSI['ID_Sanpham']?>"> <img src="admin/upload/<?php echo $resultMSI['Hinhanh_Sanpham']?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>MSI</h2>
						<p><?php echo $resultMSI['Ten_Sanpham'] ?></p>
						<div class="button"><span><a href="chitiet.php?idsanpham=<?php echo $resultMSI['ID_Sanpham']?>">Xem chi tiết</a></span></div>
				   </div>
			   </div>
			   <?php
			  		 }
			   } 
			    ?>

			      <?php
					$laythuonghieuAMD = $sanpham->laythuonghieuAMD();
					if($laythuonghieuAMD){ 
						while($resultAMD = $laythuonghieuAMD->fetch_assoc()){
				 ?>

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="chitiet.php?idsanpham=<?php echo $resultAMD['ID_Sanpham']?>"><img src="admin/upload/<?php echo $resultAMD['Hinhanh_Sanpham']?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>AMD</h2>
						  <p><?php echo $resultAMD['Ten_Sanpham'] ?></p>
						  <div class="button"><span><a href="chitiet.php?idsanpham=<?php echo $resultAMD['ID_Sanpham']?>">Xem chi tiết</a></span></div>
					</div>
				</div>
				<?php
					}
				} 
				 ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php
						$slider = $sanpham->hienthi_slider();
						if($slider){
							while($result = $slider->fetch_assoc()){
						 ?>
						<li><a href=""><img src="admin/upload/<?php echo $result['Hinhanh_Slider']?>" alt="<?php echo $result['Ten_Slider']?>"/></a></li>
						<?php
							}

						} 
						 ?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	