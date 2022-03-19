<?php
	include 'inc/header.php';
	//include 'inc/slider.php';
?>

<style>
	h3.thanhtoan{
	text-align: center;
    font-size: 20px;
    font-weight: bold;
	}
	
	a.thanhtoan_tainha {
    padding: 15px 15px 15px 15px;
    border: 1px #130b06;
    background: #3261e6;
    color: beige;
    margin-left: 43%;
    font-weight: bold;
    text-decoration: none;
}
p.back {
    padding-top: 37px;
    margin-left: 46%;
}
a.back {
    padding: 10px 39px 10px 39px;
    border: 1px solid;
    background: orange;
    font-weight: bold;
    color: white;
}

</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
    			<div class="heading">
    			<h3>Thanh toán</h3>
    			</div>
    			<div class="clear"></div>
    			
	    			<a href="thanhtoan_tainha.php" class="thanhtoan_tainha">Thanh toán khi nhận hàng</a><br>
	    			<p class="back"><a href="giohang.php" class="back">Back</a></p>
    			
    		<div class="clear"></div>
    	</div>
    		
  		</div>
 	</div>
	<?php
		include 'inc/footer.php';
?>