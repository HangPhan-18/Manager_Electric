<?php 
		
		$sql_danhmuc = mysqli_query($con,  "SELECT * FROM Danhmucsp ORDER BY ID_Danhmuc DESC");
								
	?>
<div class="navbar-inner">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				    aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto text-center mr-xl-5">
						<li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="index.php">Trang chủ
								<span class="sr-only">(current)</span>
							</a>
						</li>

						<?php
								$sql = mysqli_query($con, "SELECT * FROM danhmucsp ORDER BY ID_Danhmuc DESC");						
								while($row_danhmuc = mysqli_fetch_array($sql)){
							 ?>

						<li class="nav-item mr-lg-2 mb-lg-0 mb-2">

							<a class="nav-link " href="?quanly=danhmuc&id=<?php echo $row_danhmuc['ID_Danhmuc'] ?>" role="button" aria-haspopup="true" aria-expanded="false">
								<?php echo $row_danhmuc['Ten_Danhmuc']; ?>
							</a>
							
						</li>
						 <?php
						 }
						?>
							<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
								<?php
								$sql_tintuc = mysqli_query($con, "SELECT * FROM tintuc ORDER BY ID_Tintuc DESC");

								 ?>
							<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Điều cần biết
							</a>
							<div class="dropdown-menu">
								<?php
								while($row_tintuc = mysqli_fetch_array($sql_tintuc)){ 
								 ?>
								<a class="dropdown-item" href="?quanly=tintuc&id_tintuc=<?php echo $row_tintuc['ID_Tintuc']?>"><?php echo $row_tintuc['Ten_Tintuc'] ?></a>
								<?php
								} 
								 ?>
								
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>