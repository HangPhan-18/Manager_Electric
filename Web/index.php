
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width-divice-wwidth, initial-scale=1.0">
	<title>Shop</title>
</head>
<body>
	
	<h1>
		<?php
			include 'system/library/main.php';
			include 'system/library/Dcontroller.php';
			include 'system/library/Database.php';
			include 'system/library/Dmodel.php';
			include 'system/library/Load.php';

			//$main = new main();

			$url = isset($_GET['url']) ? $_GET['url'] : NULL;
			
			if($url!=NULL){
				$url = rtrim($url, '/');
				$url = explode('/', filter_var($url, FILTER_SANITIZE_URL));
			}else{
				unset($url);
			}

			if(isset($url[0])){
				include 'app/Controllers/'.$url[0].'.php';
				$ctl = new $url[0]();
				if(isset($url[2])){
					$ctl->{$url[1]}($url[2]);
				}else{
					if(isset($url[1])){
						$ctl->{$url[1]}();
					}else{

					}
				}
			}else{
				include 'app/Controllers/index.php';
				$index = new index();
				$index->homepage();
				
			}

			
			// $product = new $url[0]();
			// $product->chitietsanpham();
		//	$ctr = new $url[0]();
			

		
			//$main -> chitietsanpham();
			//$ctl = new Dcontroller();
		//	$ctl->chitietbaiviet();
		
		 ?>
	</h1>
	
</body>
</html>