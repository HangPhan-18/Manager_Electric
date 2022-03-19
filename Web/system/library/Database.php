<?php
	class Database extends PDO{
		
		public function __construct($connect, $user, $passwd){
			parent::__construct($connect, $user, $passwd);
		//	$db = new PDO($connect, $user, $passwd);
		}
		public function select($table, $data=array()){
			$sql = "SELECT * FROM $table";

			// $statement->bindParam(':id', $id);
			// $statement->execute();
			// return $statement->fetchAll();

			$statement = $this->prepare($sql);
			$statement->execute();
			return $statement->fetchAll();
		}
	}
?>