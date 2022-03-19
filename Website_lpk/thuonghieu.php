<?php
	include 'inc/header.php';
//	include 'inc/slider.php';
?>
<?php
	if(!isset($_GET['idthuonghieu']) || $_GET['idthuonghieu']==NULL){
       echo "<script>window.location ='404.php'</script>";
    }else{
        $id = $_GET['idthuonghieu']; 
    }
   
?>
 <div class="main">
    <div class="content">
    	  	<?php
	     	 $ten_thuonghieu = $thuonghieu->Layten_thuonghieu($id);
	      	 if($ten_thuonghieu){
	      	 	while($result_name = $ten_thuonghieu->fetch_assoc()){
	      	?>	
    	<div class="content_top">
    		<div class="heading">
    		<h3>Thương hiệu: <?php echo $result_name['Ten_Thuonghieu'] ?></h3>
    		<?php
    			}
    		} 
    		 ?>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
				<?php
	      	 $thuonghieu_sanpham = $thuonghieu->layten_thuonghieu_sanpham($id);
	      	 if($thuonghieu_sanpham){
	      	 	while($result = $thuonghieu_sanpham->fetch_assoc()){
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="chitiet.php?idsanpham=<?php echo $result['ID_Sanpham']?>"> <img src="admin/upload/<?php echo $result['Hinhanh_Sanpham']?>" alt="" /></a>
					 <h2><?php echo $result['Ten_Sanpham'] ?> </h2>
					 <p><?php echo $result['Mota_Sanpham'] ?></p>
					 <p><span class="price"><?php echo $result['Gia_Sanpham'] ?></span></p>
				    <div class="button"><span><a href="chitiet.php?idsanpham=<?php echo $result['ID_Sanpham']?>">Xem chi tiết</a></span></div>
				</div>
				  <?php
					}
			   }
			   else{
			   	echo '<span class="error">Thương hiệu hiện tại chưa có sản phẩm!</span>';
			   } 
			    ?>
			</div>

	</div>
 </div>
<?php
	include 'inc/footer.php';
?>