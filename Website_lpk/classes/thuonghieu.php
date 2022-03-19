<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php'); 
 ?>

<?php
	/**
	 * 
	 */
	class thuonghieu
	{
		private $db; //database
		private $fm; //format

		public function __construct()
		{
			$this->db = new database();
			$this->fm = new format();
		}
		public function them_thuonghieu($tenthuonghieu){
				$tenthuonghieu = $this->fm->validation($tenthuonghieu);
			
				//Thoat cac ky tu dac biet trong chuoi
				$tenthuonghieu = mysqli_real_escape_string($this->db->link, $tenthuonghieu);
				

				if(empty($tenthuonghieu)){
					$alert ="<span class='error'>Tên thương hiệu không được bỏ trống</span>";
					return $alert;
				}else{
					$query = "INSERT INTO thuonghieusp(Ten_Thuonghieu) VALUES('$tenthuonghieu')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Thêm thành công thương hiệu</span>";
						return $alert;

					}else{
						$alert = "<span class='error'>Thêm không thành công thương hiệu</span>";
						return $alert;
					}
					
				}
			}
		public function hienthi_thuonghieu(){
			$query = "SELECT * FROM thuonghieusp ORDER BY ID_Thuonghieu DESC ";
			$result = $this->db->select($query);
			return $result;
		}
		public function hienthi_thuonghieu_home(){
			$query = "SELECT * FROM thuonghieusp order by ID_Thuonghieu desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function Layten_thuonghieu($id){
			$query = "SELECT * FROM thuonghieusp WHERE ID_Thuonghieu='$id' ORDER BY ID_Thuonghieu DESC LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function layten_thuonghieu_sanpham($id){
			$query = "SELECT sanpham.*,thuonghieusp.Ten_Thuonghieu,thuonghieusp.ID_Thuonghieu FROM sanpham, thuonghieusp WHERE sanpham.ID_Thuonghieu=thuonghieusp.ID_Thuonghieu AND thuonghieusp.ID_Thuonghieu ='$id' LIMIT 8";
			
			$result = $this->db->select($query);
			return $result;
		}

		public function sua_thuonghieu($tenthuonghieu, $id){
				$tenthuonghieu = $this->fm->validation($tenthuonghieu);
			
				//Thoat cac ky tu dac biet trong chuoi
				$tenthuonghieu = mysqli_real_escape_string($this->db->link, $tenthuonghieu);
				$id = mysqli_real_escape_string($this->db->link, $id);
				

				if(empty($tenthuonghieu)){
					$alert ="<span class='error'>Tên thương hiệu không được bỏ trống</span>";
					return $alert;
				}else{
					$query = "UPDATE thuonghieusp SET Ten_Thuonghieu = '$tenthuonghieu' WHERE ID_Thuonghieu = '$id'";
					$result = $this->db->update($query);//co san trong lib->database.php
					if($result){
						$alert = "<span class='success'>Cập nhật thành công thương hiệu sản phẩm</span>";
						return $alert;

					}else{
						$alert = "<span class='error'>Cập nhật không thành công thương hiệu sản phẩm</span>";
						return $alert;
					}
					
				}
		}

		public function xoa_thuonghieu($id){
			$query = "DELETE FROM thuonghieusp WHERE ID_Thuonghieu='$id'";
			$result = $this->db->delete($query);
			if($result){
						$alert = "<span class='success'>Xóa thành công thương hiệu</span>";
						return $alert;

					}else{
						$alert = "<span class='error'>Xóa không thành công thương hiệu</span>";
						return $alert;
					}
					
			
		}

		public function Layid_thuonghieu($id){
			$query = "SELECT * FROM thuonghieusp WHERE ID_Thuonghieu ='$id' ";
			$result = $this->db->select($query);
			return $result;
		}

	}
?>