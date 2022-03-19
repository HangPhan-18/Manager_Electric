<?php
	include 'inc/header.php';
	//include 'inc/slider.php';
?>
<?php
	$login_check=session::get('login_khachhang');
	if($login_check==false){
		 header("Location: login.php");
	}

	$cart = new giohang();
	 if(isset($_GET['idxuly'])){
      $id = $_GET['idxuly'];
      $time = $_GET['thoigian'];
      $gia = $_GET['gia'];
      $xacnhan = $cart->xacnhan_donhang($id, $time, $gia);
    }
 ?>
<style>
	.box_left {
    width: 100%;
    border: 1px solid #000;
    padding: 10px;
}

p.muasam {
    background: #c6c5ff;
    width: 174px;
    margin-left: 44%;
    padding: 11px 2px;
    text-align: center;
    font-size: 17px;
    font-weight: bold;
    cursor: pointer;
    border: 1px solid;
    margin-bottom: 40px;
    margin-top: 10px;
}

</style>
<form action="" method="POST">
	
</form>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="heading">
    			<h3>Đơn hàng của bạn</h3>
    		</div>
    		<div class="clear"></div>
    		<div class="box_left"><div class="cartpage">
				<table class="tblone">
					<tr>
						<th width="7%">Thứ tự</th>
						<th width="20%">Tên sản phẩm</th>
						<th width="7%">Hình ảnh</th>
						<th width="10%">Giá </th>
						<th width="7%%">Số lượng</th>
						<th width="13%">Ngày đặt</th>
						<th width="10%">Tình trạng</th>
						<th width="15%">Tổng tiền</th>
						<th width="20%">Thông báo</th>
					</tr>
						<?php
							$id = session::get('id_khachhang');
							$lay_donhang = $cart->laydonhang($id);
							if($lay_donhang){ 
								$tongtien = 0;
								$sl = 0;
								$i=0;
								while($result = $lay_donhang->fetch_assoc()){
									$i++;
						 ?>
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $result['Ten_Sanpham'] ?></td>
						<td><img src="admin/upload/<?php echo $result['Hinhanh'] ?>" alt=""></td>
						<td><?php echo number_format($result['Gia_Sanpham']).'đ' ?></td>
						<td>	
							<?php echo $result['Soluong']?>
						</td>
						<td><?php echo $format->formatDate($result['Ngay_Dathang']) ?></td>
						<td>
							<?php
							if($result['Tinhtrang']=='0'){
								echo 'Đang xử lý...';
							} 
							elseif($result['Tinhtrang']=='1'){
								?>
								<span>Đã vận chuyển</span>
							<!-- <a href="?idxuly=<?php echo $id?>&gia=<?php echo $result['Gia_Sanpham']?>&thoigian=<?php echo $result['Ngay_Dathang']?>">Đã vận chuyển</a> -->
							
							<?php
							}else{
								echo 'Đã nhận được hàng';
								}
							 ?>
							
						</td>
						<td>
							<?php
							$total = $result['Gia_Sanpham'] * $result['Soluong'];
							echo number_format($total).'đ'; 
							?>
						</td>
						<?php
							if($result['Tinhtrang']==0){					
						 ?>
						 <td>Đang chờ xử lý</td>
						 <!-- 	<td><a onclick="return confirm('Bạn chắc muốn hủy đơn hàng này chứ?');" href="?idgiohang=<?php echo $result['ID_Dathang']?>&huydon=<?php echo $result['Huydon']=2?>" >Hủy đơn</a></td> -->
						 <?php
						 }elseif($result['Tinhtrang']==1){ 

						  ?>
						 <td><a href="?idxuly=<?php echo $id?>&gia=<?php echo $result['Gia_Sanpham']?>&thoigian=<?php echo $result['Ngay_Dathang']?>">Đã nhận hàng</a></td>
						  <?php
						   }else{
						   ?>
							<td> </td>
						<?php
						} 
						 ?>
						</tr>
							<?php
								}
							} 
							 ?>
						</table>
						
					</div></div>
    	</div>	
    	<br>
    	<p class="muasam"><a href="index.php"style="text-decoration: none;">Quay lại</a></p>
	</div>
</div>
<?php
	include 'inc/footer.php';
?>