<?php
	include 'inc/header.php';
	//include 'inc/slider.php';
?>

 <?php
	$login_check=session::get('login_khachhang');
	if($login_check==false){
		 header("Location: login.php");
	}
	   ?>

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
    			<div class="heading">
    			<h3>Thông tin chi tiết của khách hàng</h3>
    			</div>
    		<div class="clear"></div>
    	</div>
    		<table class="tblone">

    			<?php
    				$id = session::get('id_khachhang');
    				$get_khachhang = $khachhang->hienthi_khachhang($id);
    				if($get_khachhang){
    					while($result = $get_khachhang->fetch_assoc()){
    			
    			 ?>
    			<tr>
  					<td>Họ tên: </td>
  					<td><?php echo $result['Ten_Khachhang'] ?></td>  				
      			</tr>

    			<tr>
  					<td>Địa chỉ: </td>
  					<td><?php echo $result['Diachi'] ?></td>  				
      			</tr>
      			<tr>
  					<td>Email: </td>
  					<td><?php echo $result['Email'] ?></td>  				
      			</tr>
      			<tr>
  					<td>Số điện thoại: </td>  				
  					<td><?php echo $result['Sdt'] ?></td>  				
      			</tr>
      			<tr>
      				<td colspan="3"><a href="suaprofile.php">Cập nhật thông tin</a></td>
      			</tr>
      			
      			<?php
      				}
      			} 
      			 ?>
    		</table>
  		</div>
 	</div>
	<?php
		include 'inc/footer.php';
?>