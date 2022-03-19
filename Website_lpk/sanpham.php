
<?php
	include 'inc/header.php';
	//include 'inc/slider.php';
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm mới nhất </h3>
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
				     <div class="button"><span><a href="chitiet.php?idsanpham=<?php echo $result_new['ID_Sanpham']?>" class="details">Chi tiết</a></span></div>
				</div>
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