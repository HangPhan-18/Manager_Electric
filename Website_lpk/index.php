<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>
 <div class="main">
 	<!-- <?php
 		echo session_id(); 
 	 ?> -->
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm nổi bật</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php 
	      		$laysanpham = $sanpham->Laysanpham_noibat();
	      		if($laysanpham){
	      			while($result = $laysanpham->fetch_assoc()){//fetch_assoc lay ra du lieu

	      	 ?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="chitiet.php?idsanpham=<?php echo $result['ID_Sanpham']?>"><img src="admin/upload/<?php echo $result['Hinhanh_Sanpham'] ?>" alt="" /></a>
					 <h2><?php echo $result['Ten_Sanpham'] ?></h2>
					 <p><?php echo $format->textShorten($result['Mota_Sanpham'], 35) ?></p>
					 <p><span class="price"><?php echo number_format($result['Gia_Sanpham']).'đ' ?></span></p>
				     <div class="button"><span><a href="chitiet.php?idsanpham=<?php echo $result['ID_Sanpham']?>" class="details" >Chi tiết</a></span></div>
				</div>
				<?php
					}
				} 
				 ?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Sản phẩm mới</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
					<?php 
	      		$laysanphammoi = $sanpham->Laysanpham_moi();
	      		if($laysanphammoi){
	      			while($result_new = $laysanphammoi->fetch_assoc()){//fetch_assoc lay ra du lieu

	      	 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="chitiet.php?idsanpham=<?php echo $result_new['ID_Sanpham']?>"><img src="admin/upload/<?php echo $result_new['Hinhanh_Sanpham'] ?>" alt="" /></a>
					 <h2> <?php echo $result_new['Ten_Sanpham'] ?></h2>
					 <p><span class="price"><?php echo number_format($result_new['Gia_Sanpham']).'đ' ?></span></p>
				     <div class="button"><span><a href="chitiet.php?idsanpham=<?php echo $result_new['ID_Sanpham']?>" class="details" style="text-decoration: none;">Chi tiết</a></span></div>
				</div>
				<?php
					}
				} 
				 ?>
				 </div>
<style>
	a.phantrang {
    background: #f09758;
    border: 1px solid;
    padding: 8px 15px 6px 13px;
    text-decoration: none;
    color: #fff;
    font-weight: bold;
 }
 .phantrang {
    margin-left: 15px;
    padding: 20px;
}
</style>
			
			<div class="phantrang">
				<?php
				$lay_tatca_sanpham = $sanpham->lay_tatca_sp();
				$dem_sanpham = mysqli_num_rows($lay_tatca_sanpham);
				$phantrang = ceil($dem_sanpham/5);
				$i=1;
				for($i=1; $i<$phantrang; $i++){
					echo '<a href="index.php?trang='.$i.'" style="margin: 0 5px;" class="phantrang">' .$i.'</a>';
					
				} 
				 ?>
				
			</div>
    </div>
 </div>
<?php
	include 'inc/footer.php';
?>