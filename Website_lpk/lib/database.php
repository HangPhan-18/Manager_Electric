<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../config/config.php');
 ?>
<?php
	class database{
		public $host = DB_HOST;
		public $user = DB_USER;
		public $pass = DB_PASS;
		public $dbname = DB_NAME;

		public $link;
		public $error;

		public function __construct(){
			$this->connectDB();
		}

		//$this->link như file connect
		private function connectDB(){
			$this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
			mysqli_set_charset($this->link, "utf8");
			if(!$this->link){
				$this->error ="Connect failed".$this->link->connect_error;
				return false;
			}

		}
		//Truy van va doc du lieu

		public function select($query){
			$result = $this->link->query($query)
			or die($this->link->error.__LINE__);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}

		}
		//Chen du lieu
		public function insert($query){
			$insert_row = $this->link->query($query)or die($this->link->error.__LINE__);
			if($insert_row){
				return $insert_row;
			}
			else{
				return false;
			}
		}

		//Cap nhat du lieu
		public function update($query){
			$update_row = $this->link->query($query) or die($this->link->error.__LINE__);
			if($update_row){
				return $update_row;
			}else{
				return flase;
			}
		}

		//Xoa du lieu
		public function delete($query){
			$delete_row= $this->link->query($query) or die ($this->link->error>__LINE__);
			if($delete_row){
				return $delete_row;
			}
			else{
				return flase;
			}
		}
	}
?>