<?php
	class Load{
		public function __construct(){

		}
		public function view($fileName, $data=false){
			if($data == true){
				extract($data);
			}
			include 'app/Views/'.$fileName.'.php';
		}

		public function model($fileName){
			include 'app/Models/'.$fileName.'.php';
			return new $fileName();
		}
	}	
?>