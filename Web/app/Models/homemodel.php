<?php
	class homemodel extends Dmodel{
		public function __construct(){
			parent::__construct();
		}
		public function category($danhmuc){
			return $this->db->select($danhmuc);
			// $sql = "SELECT * FROM danhmucsp order by ID_Danhmuc DESC";
			// $result=$this->db->select($sql);
			// return $result;
			// $sql = "SELECT * FROM danhmucsp order by ID_Danhmuc DESC";
			// $query = $this->db->query($sql);
			// $result = $query->fetchAll();
			// return $result;
		}
		// public function iddanhmuc($danhmuc, $id){
		// 	 $sql = "SELECT * FROM $danhmuc where ID_Danhmuc = :id";
		// 	 $statement=$this->db->prepare($sql);
			
		// } $statement->bindParam(':id', $id);
		// 	 $statement->execute();
		// 	 return $statement->fetchAll();
	}
?>