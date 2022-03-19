</div>
   <div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
	     		<div class="col_1_of_4 span_1_of_4">
					<h4>Địa chỉ cửa hàng</h4>
						<ul>
							<li><a href="">9/10, Lý Chính Thắng, phường 4,</a></li>
							<li><a href=""> quận 10, Tp Hồ Chí Minh</a></li>
							
						</ul>
				</div>
					<div class="col_1_of_4 span_1_of_4">
					<h4>Mua hàng</h4>
						<ul>
							<li><a href="#" >Giao hàng toàn quốc miễn phí</a></li>
							<li><a href="#">Đổi trả dễ dàng</a></li>
							<li><a href="#">Hỗ trợ nhiệt tình</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Tài khoản của bạn</h4>
						<ul>
							<li><a href="login.php">Đăng nhập</a></li>
							<li><a href="giohang.php">Xem giỏ hàng</a></li>
							<li><a href="dsyeuthich.php">Danh sách yêu thích</a></li>
							<li><a href="chitiet_donhang">Theo dõi đơn hàng</a></li>
							
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Liên hệ</h4>
						<ul>
							<li><span>+84-854364633</span></li>
							<li><span>+84-378347374</span></li>
						</ul>
						<div class="social-icons">
							<h4>Theo dõi chúng tôi</h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"></a> </li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p>Linh kiện | Phụ kiện máy tính Dino </p>
		   </div>
     </div>
    </div>

    
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
</body>
</html>
