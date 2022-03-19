<?php
	include 'inc/header.php';
	//include 'inc/slider.php';
?>
<?php 
	$login_check=session::get('login_khachhang');
	if($login_check){
		echo '<script> location.replace("index.php"); </script>';
	}
		   
 ?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $themkhachhang = $khachhang->them_khachhang($_POST);
    }  
    //Đăng nhập
 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){

        $login= $khachhang->login_khachhang($_POST);
    }  
 ?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Đăng nhập</h3>
        	<p>Đăng nhập bằng form bên dưới.</p>
        	<?php
        		 if(isset($login)){
    				echo $login;
    			} 
        	 ?>
        	<form action="" method="post" >
               	<input type="text" name="email" class="field"  placeholder="Nhập email...">
                <input type="password" name="password" class="field" placeholder="Nhập mật khẩu">
         		<div class="search"><div><input type="submit" name="login" class="grey" value="Đăng nhập"></div></div>
            </form>
                    </div>
         	<div class="register_account">
    		<h3>Đăng ký tài khoản mới</h3>
    		<?php
    			if(isset($themkhachhang)){
    				echo $themkhachhang;
    			} 
    		 ?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Nhập vào họ tên" >
							</div>
							<div>
							<input type="text" name="address"placeholder="Nhập vào địa chỉ">
							</div>
							
							<div>
								<input type="text" name="email" placeholder="Email">
							</div>
		    			 </td>
		    			<td>
						
		           <div >
		          <input type="text" name="phone" placeholder="Nhập vào số điện thoại" >
		          </div>
				  
				  <div >
					 <input type="text" name="password" placeholder="Nhập mật khẩu" >
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="Tạo tài khoản"></div></div>
		    <p class="terms">Bằng cách nhấp vào tạo tài khoản bạn đồng ý với <a href="#">thỏa thuận &amp; điều kiện</a> của chúng tôi.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
	include 'inc/footer.php';
?>