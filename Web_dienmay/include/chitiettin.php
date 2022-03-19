<?php
if(isset($_GET['id_tintuc'])){
	$id_baiviet = $_GET['id_tintuc'];

} else{
	$id_baiviet = '';
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
					$sql_tintuc = mysqli_query($con, "SELECT * FROM tintuc WHERE ID_Tintuc = '$id_baiviet' ORDER BY ID_Tintuc DESC"); 
					$row_tintuc = mysqli_fetch_array($sql_tintuc);
					 ?>

					<li><a href="index.php?quanly=tintuc&id_tintuc=<?php echo $row_tintuc['ID_Tintuc']?>"><?php echo $row_tintuc['Ten_Tintuc'] ?></a></li>
					<i>|</i>

					 <?php
					$sql_baiviet = mysqli_query($con, "SELECT * FROM baiviet WHERE ID_Baiviet = '$id_baiviet' ORDER BY ID_Baiviet DESC"); 
					$row_baiviet = mysqli_fetch_array($sql_baiviet);
					 ?> 
					<li> <?php echo $row_baiviet['Ten_Baiviet'] ?> </li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->

	<!-- about -->
	<div class="welcome py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
		<!-- 	<?php
				$sql_tin = mysqli_query($con, "SELECT * FROM tintuc WHERE ID_Tintuc = '$id' ORDER BY ID_Tintuc DESC"); 
				$row_tin = mysqli_fetch_array($sql_tin);
			?>
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<?php echo $row_tin['Ten_Tintuc'] ?>
				</h3> -->
			<!-- //tittle heading -->
			<?php
			$sql_baiviet_chitiet = mysqli_query($con, "SELECT * FROM baiviet WHERE ID_Baiviet = '$id_baiviet'");
			$row_baiviet_chitiet = mysqli_fetch_array($sql_baiviet_chitiet)
			 ?>
			<div class="row">
				<div class="col-lg-12 welcome-left">
					<h4 class="tieude" style="font-size: 30px;"><?php echo $row_baiviet_chitiet['Ten_Baiviet'] ?></h4>
					<h4 class="my-sm-3 my-2"><?php echo $row_baiviet_chitiet['Tomtat_Baiviet'] ?></h4>
					<p><?php echo $row_baiviet_chitiet['Noidung_Baiviet'] ?></p>
				
				</div>
			</div>
		</div>
	</div>