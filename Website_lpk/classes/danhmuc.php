<?php
	$filepath = realpath(dirname(__FILE__)); //realpath trả về đường dẫn tuyệt dối
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php'); 
 ?>

<?php
	/**
	 * 
	 */
	class danhmuc
	{
		private $db; //database
		private $fm; //format

		public function __construct()
		{
			$this->db = new database();
			$this->fm = new format();
		}
		public function them_danhmuc($tendanhmuc){
				$tendanhmuc = $this->fm->validation($tendanhmuc);
			
				//Thoat cac ky tu dac biet trong chuoi
				$tendanhmuc = mysqli_real_escape_string($this->db->link, $tendanhmuc);
				

				if(empty($tendanhmuc)){
					$alert ="<span class='error'>Danh mục không được bỏ trống</span>";
					return $alert;
				}else{
					$query = "INSERT INTO danhmucsp(Ten_Danhmuc) VALUES('$tendanhmuc')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Thêm danh mục thành công</span>";
						return $alert;

					}else{
						$alert = "<span class='error'>Thêm danh mục không thành công</span>";
						return $alert;
					}
					
				}
			}
		public function hienthi_danhmuc(){
			$query = "SELECT * FROM danhmucsp ORDER BY ID_Danhmuc DESC ";
			$result = $this->db->select($query);
			return $result;
		}

		public function sua_danhmuc($tendanhmuc, $id){
				$tendanhmuc = $this->fm->validation($tendanhmuc);
			
				//Thoat cac ky tu dac biet trong chuoi
				$tendanhmuc = mysqli_real_escape_string($this->db->link, $tendanhmuc);
				$id = mysqli_real_escape_string($this->db->link, $id);
				

				if(empty($tendanhmuc)){
					$alert ="<span class='error'>Danh mục không được bỏ trống</span>";
					return $alert;
				}else{
					$query = "UPDATE danhmucsp SET Ten_Danhmuc = '$tendanhmuc' WHERE ID_Danhmuc = '$id'";
					$result = $this->db->update($query);//co san trong lib->database.php
					if($result){
						$alert = "<span class='success'>Cập nhật danh mục thành công</span>";
						return $alert;

					}else{
						$alert = "<span class='error'>Cập nhật danh mục không thành công</span>";
						return $alert;
					}
					
				}
		}

		public function xoa_danhmuc($id){
			$query = "DELETE FROM danhmucsp WHERE ID_Danhmuc='$id'";
			$result = $this->db->delete($query);
			if($result){
						$alert = "<span class='success'>Xóa danh mục thành công</span>";
						return $alert;

					}else{
						$alert = "<span class='error'>Xóa danh mục không thành công</span>";
						return $alert;
					}
					
			
		}

		public function Layid_danhmuc($id){
			$query = "SELECT * FROM danhmucsp WHERE ID_Danhmuc ='$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function hienthidanhmuc(){
			$query = "SELECT * FROM danhmucsp ORDER BY ID_Danhmuc ASC ";
			$result = $this->db->select($query);
			return $result;
		}

		public function Laysanpham_danhmuc($id){
			$query = "SELECT * FROM sanpham WHERE ID_Danhmuc ='$id' ORDER BY ID_Danhmuc DESC LIMIT 10 ";
			$result = $this->db->select($query);
			return $result;
		}
		public function layten_danhmuc($id){
			$query = "SELECT sanpham.*, danhmucsp.Ten_Danhmuc, danhmucsp.ID_Danhmuc FROM sanpham, danhmucsp WHERE sanpham.ID_Danhmuc= danhmucsp.ID_Danhmuc AND sanpham.ID_Danhmuc = '$id' LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

	}
?>