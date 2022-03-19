<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	
    if(!isset($_GET['idthuonghieu']) || $_GET['idthuonghieu']== NULL){
        echo "<script>window.location= '404.php';</script>";
    }else{
         $id = $_GET['idthuonghieu'];
    }


   //goi class trong file adminlogin
    //su dung phuong thuc gui tap tin, du lieu bang phuong thuc get hay post
    //  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //     $tendanhmuc = $_POST['tendanhmuc'];
        

    //     $sua_danhmuc = $danhmuc->sua_danhmuc($tendanhmuc, $id) ;   
    // } 
 ?>
 <div class="main">
    <div class="content">
    	<?php
    			$layten_thuonghieu = $thuonghieu->layten_thuonghieu($id);
    			if($layten_thuonghieu){
	      		while($result = $layten_thuonghieu->fetch_assoc()){
    		 ?>
    	<div class="content_top">
    		
    		<div class="heading">
    		<h3>Thương hiệu <?php echo $result['Ten_Thuonghieu'] ?></h3>
    		</div>
    		
    		<div class="clear"></div>
    	</div>
    	<?php
    			}
    		} 
    		 ?>
	      <div class="section group">
	      	<?php
	      	$sanphamid = $thuonghieu->layten_thuonghieu_sanpham($id);
	      	if($sanphamid){
	      		while($result = $sanphamid->fetch_assoc()){

	      	 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="chitiet.php?idsanpham=<?php echo $result['ID_Sanpham']?>"><img src="admin/upload/<?php echo $result['Hinhanh_Sanpham']?>" alt="" /></a>
					 <h2><?php echo $result['Ten_Sanpham']?> </h2>
					
					 <p><span class="price"><?php echo number_format($result['Gia_Sanpham']).'đ'?></span></p>
				     <div class="button"><span><a href="chitiet.php?idsanpham=<?php echo $result['ID_Sanpham']?>" class="details">Xem chi tiết</a></span></div>
				</div>

				<?php
					}
				}else{
					echo '<span style="margin-left:40%">Hiện đang cập nhật sản phẩm cho thương hiệu này</span>';
				} 
				 ?>
			</div>
    </div>
 </div>
<?php
	include 'inc/footer.php';
?>