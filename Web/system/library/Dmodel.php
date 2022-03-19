<?php
	class Dmodel{
		
		protected $db = array();
		public function __construct(){
			$connect = 'mysql:dbname=pdo_web_ecommerce; host=localhost; charset=utf8';
			$user = 'root';
			$passwd = '';
			$this->db = new Database($connect, $user, $passwd);
		}
	}
?>