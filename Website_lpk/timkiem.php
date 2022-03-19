<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	
 //Kiểm tra hình thức gửi qua là post hay get thì 
     
 ?>
 <div class="main">
    <div class="content">
    	<?php
    	if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $tukhoa = $_POST['tukhoa'];
        $timkiem = $sanpham->timkiem_sanpham($tukhoa) ;   
    	}
    		 ?>
    	<div class="content_top">
    		<div class="heading">
    		<h3>Từ khóa tìm kiếm: <?php echo $tukhoa ?></h3>
    		</div>
    		
    		<div class="clear"></div>
    	</div>
   
	      <div class="section group">
	      	<?php
	      		if($timkiem){
	      		while($result = $timkiem->fetch_assoc()){

	      	 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="chitiet.php?idsanpham=<?php echo $result['ID_Sanpham']?>"><img src="admin/upload/<?php echo $result['Hinhanh_Sanpham']?>" alt="" /></a>
					 <h2><?php echo $result['Ten_Sanpham']?> </h2>
					
					 <p><span class="price"><?php echo number_format($result['Gia_Sanpham']).'đ'?></span></p>
				     <div class="button"><span><a href="chitiet.php?idsanpham=<?php echo $result['ID_Sanpham']?>" class="details">Xem chi tiết</a></span></div>
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