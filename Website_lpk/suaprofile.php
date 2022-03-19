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
<?php
      $id = session::get('id_khachhang');
      if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['save'])){
      	
        $suathongtin_khachhang= $khachhang->sua_khachhang($_POST, $id);
     } 
 ?>
<style>
   input#ten {
    width: 100%;
    text-align: center;
    }  

    input#diachi{
        width: 100%;
        text-align: center;
    }
    input#email{
        width: 100%;
        text-align: center;
    }
    input#sdt{
        width: 100%;
        text-align: center;
    }

</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
    			<div class="heading">
    			<h3>Cập nhật thông tin chi tiết của khách hàng</h3>
    			</div>
    		<div class="clear"></div>
    	</div>
      <form action="" method="post">
    		<table class="tblone">
            <tr>
               
                  <?php
                     if(isset($suathongtin_khachhang)){
                        echo '<td colspan="3">'.$suathongtin_khachhang.'</td>';
                     } 
                   ?>
               
            </tr>
    			<?php
    				$id = session::get('id_khachhang');
    				$get_khachhang = $khachhang->hienthi_khachhang($id);
    				if($get_khachhang){
    					while($result = $get_khachhang->fetch_assoc()){
    			 ?>
    			<tr>
  					<td>Họ tên: </td>
               <td><input type="text" name="name" id="ten" value="<?php echo $result['Ten_Khachhang'] ?>"></td>
  							
      			</tr>
    			<tr>
  					<td>Địa chỉ: </td>
  					<td><input type="text" name="address" id="diachi" value="<?php echo $result['Diachi'] ?>" ></td>  				
      		</tr>
      		<tr>
  					<td>Email: </td>
  					<td><input type="text" name="email" id ="email"value="<?php echo $result['Email'] ?>"></td>  				
      		</tr>
      			<tr>
  					<td>Số điện thoại: </td>  				
  					<td><input type="text" name="phone" id ="sdt"value="<?php echo $result['Sdt'] ?>"></td>  				
      		</tr>
      		<tr>
      			<td colspan="3"><input type="submit" name="save" value="Lưu" class="grey"></td>
      		</tr>
      		
      			<?php
      				}
      			} 
      			 ?>
    		</table>
         </form>
  		</div>
 	</div>
	<?php
		include 'inc/footer.php';
?>