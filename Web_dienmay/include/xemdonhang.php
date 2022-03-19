<?php
	if(isset($_GET['huydon'])&& isset($_GET['magiaodich'])){
		$huydon = $_GET['huydon'];
		$mahang = $_GET['magiaodich'];
	} 
	else{
		$huydon='';
		$mahang='';
	}
	 $sql_donhang_huydon = mysqli_query($con, "UPDATE donhang SET Huydon = '$huydon' WHERE Madonhang = '$mahang'");
	 $sql_giaodich_huydon = mysqli_query($con, "UPDATE giaodich SET Huydon = '$huydon' WHERE Ma_Giaodich = '$mahang'");
 ?>
<!-- top Products -->
	<div class="ads-grid py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Xem đơn hàng
			<!-- //tittle heading -->
			<div class="row">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<!-- first section -->
						
						<div class="row">
							<?php
								if(isset($_SESSION['dangnhap_home'])){
									
								} 
								 ?>
								 <br>
							<div class="col-md-12" style="font-size: 15px; margin-left: 140px;">
       						 <h4 style="font-weight: bold;">Thông tin lịch sử đơn hàng</h4><br>
      						  <?php 
      							if(isset($_GET['khachhang'])){
      								$idkhachhang = $_GET['khachhang'];

     						  }else{
         						 $idkhachhang='';
        					}
        						$sql_select = mysqli_query($con, "SELECT * FROM giaodich WHERE giaodich.ID_Khachhang = '$idkhachhang' GROUP BY giaodich.Ma_Giaodich");
         					?>
        					<table class="table table-bordered">
        					  <tr>
           						<td>Thứ tự</td>
            					<td>Mã giao dịch</td>
          						<td>Ngày đặt hàng</td>
          						<td>Tình trạng</td>
          						<td>Quản lý</td>
          						<td>Yêu cầu</td>
            
       						  </tr>
       					   <?php
          					$i=0;
       					   while($row_donhang = mysqli_fetch_array($sql_select)){ 
            				$i++;
           					?>
          					<tr>
            					<td><?php echo $i ?></td>
          
         					    <td><?php echo $row_donhang['Ma_Giaodich'] ?></td>   
            					
           						<td><?php echo $row_donhang['Ngaythang'] ?></td>
           						<td>
           						<?php
           							if($row_donhang['Tinhtrang']==0){
           								echo 'Đang xử lý';
           							} else{
           								echo 'Đã xử lý và đang giao hàng';
           							}

           						 ?>	
           						 </td>
           						<td><a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['idkhachhang']?>&magiaodich=<?php echo $row_donhang['Ma_Giaodich']?>">Xem chi tiết</a></td>


           						<td>
           							<?php
           							if($row_donhang['Huydon']==0){ 
           							 ?>
           							<a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['idkhachhang']?>&magiaodich=<?php echo $row_donhang['Ma_Giaodich']?>&huydon=1">Hủy đơn</a>
           							<?php
           							}elseif($row_donhang['Huydon']==1) {
           								echo 'Đang chờ hủy...';
           							}
           						
           							else{
           								echo 'Đã hủy';
           							} 
           							 ?>

           						</td>
         					</tr>
   					       <?php
          						} 
           					?>
        					</table>
    						  </div>
							<div class="col-md-12" style="font-size: 15px; margin-left: 140px;"><br>
    	  						<h4 style="font-weight: bold;" >Chi tiết đơn hàng</h4>
        							<?php 
        								if(isset($_GET['magiaodich'])){
          									$magiaodich = $_GET['magiaodich'];
        								}
        								else{
          									$magiaodich='';
        								}
        									$sql_select = mysqli_query($con, "SELECT * FROM khachhang, giaodich, sanpham WHERE giaodich.ID_Sanpham = sanpham.ID_Sanpham AND giaodich.ID_Khachhang = khachhang.ID_Khachhang AND giaodich.Ma_Giaodich = '$magiaodich' ORDER BY giaodich.Ma_Giaodich");
         								?>
         							<br>
        								<table class="table table-bordered">
          									<tr>
            									<td>Thứ tự</td>
            									<td>Mã giao dịch</td>
            									<td>Tên sản phẩm</td>
            									<td>Số lượng</td>
            									<td>Ngày đặt hàng</td>
            
          									</tr>
          							<?php
          								$i=0;
          								while($row_donhang = mysqli_fetch_array($sql_select)){ 
            								$i++;
           							?>
          									<tr>
           										<td><?php echo $i ?></td>
          
            									<td><?php echo $row_donhang['Ma_Giaodich'] ?></td>   
          										<td><?php echo $row_donhang['Ten_Sanpham'] ?></td> 
          										<td><?php echo $row_donhang['Soluong'] ?></td>
            									<td><?php echo $row_donhang['Ngaythang'] ?></td>
          									</tr>
          							<?php
          							} 
           							?>
        								</table>
      						</div>
							</div>
						
						<!-- //first section -->
					</div>
				</div>
				<!-- //product left -->
				
				
			</div>
		</div>
	</div>