<?php
if(isset($_GET['id_tintuc'])){
	$id = $_GET['id_tintuc'];

} else{
	$id = '';
}
 ?>

<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.php">Trang chủ</a>
						<i>|</i>
					</li>
					<?php
					$sql_tintuc = mysqli_query($con, "SELECT * FROM tintuc WHERE ID_Tintuc = '$id' ORDER BY ID_Tintuc DESC"); 
					$row_tintuc = mysqli_fetch_array($sql_tintuc);
					 ?>
					<li><?php echo $row_tintuc['Ten_Tintuc'] ?></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- about -->
	<div class="welcome py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			
			<?php
			$sql_baiviet = mysqli_query($con, "SELECT * FROM tintuc, baiviet WHERE tintuc.ID_Tintuc = baiviet.ID_Tintuc AND tintuc.ID_Tintuc = '$id'");
			while($row_baiviet = mysqli_fetch_array($sql_baiviet)){ 
			 ?>
			<div class="row">
				<div class="col-lg-4 welcome-right-top mt-lg-0 mt-sm-5 mt-4" style="padding-top: 20px;margin-top: 5px;">
					<a href="index.php?quanly=chitiettin&id_tintuc=<?php echo $row_baiviet['ID_Baiviet']?> "><img src="images/<?php echo $row_baiviet['Hinhanh_Baiviet'] ?>" class="img-fluid" alt=" "></a>

				</div>
				<br>

				<div class="col-lg-8 welcome-left">
					<h4 class="tieude" style="font-size: 30px;"><a href="index.php?quanly=chitiettin&id_tintuc=<?php echo $row_baiviet['ID_Baiviet']?>"><?php echo $row_baiviet['Ten_Baiviet'] ?></a></h4>
					<h4 class="my-sm-3 my-2"><?php echo $row_baiviet['Tomtat_Baiviet'] ?></h4>
				
				</div>
			</div>
			<?php
			} 
			 ?>
		</div>
	</div>