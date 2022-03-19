<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php'); 
 ?>

<?php
	/**
	 * 
	 */
	class giohang
	{
		private $db; //database
		private $fm; //format

		public function __construct()
		{
			$this->db = new database();
			$this->fm = new format();
		}
		public function them_giohang($id, $soluong){
			$soluong = $this->fm->validation($soluong);
			$soluong = mysqli_real_escape_string($this->db->link, $soluong);
			$id = mysqli_real_escape_string($this->db->link, $id);

			$session_id = session_id();

			$query = "SELECT * FROM sanpham WHERE ID_Sanpham = '$id'";
			$result = $this->db->select($query)->fetch_assoc();
			// echo '<pre>';
			// echo print_r($result);
			// echo '</pre>';
			$hinhanh = $result['Hinhanh_Sanpham'];
			$tensanpham = $result['Ten_Sanpham'];
			$gia = $result['Gia_Sanpham'];

				//Kiem tra gio hang khi them san pham trung lap
			$check_giohang =  "SELECT * FROM giohang WHERE ID_Sanpham = '$id' AND ID_Session = '$session_id'";
			$result_check = $this->db->select($check_giohang);
			if($result_check){
				$thongbao = "Sản phẩm đã có trong giỏ hàng";
				return $thongbao;
			}
			else{


			$query_giohang = "INSERT INTO giohang(ID_Sanpham, ID_Session, Ten_Sanpham, Gia_Sanpham, Soluong, Hinhanh) VALUES('$id', '$session_id','$tensanpham', '$gia' , '$soluong', '$hinhanh')";
			$themgiohang = $this->db->insert($query_giohang);
			if($themgiohang){
				echo '<span class = "success" style="font-weight:bold;">THÊM SẢN PHẨM VÀO GIỎ HÀNG THÀNH CÔNG!</span>';


			}else{
				header('Location: 404.php');
			}
		}
	}

		public function laygiohang(){
			$session_id = session_id();
			$query = "SELECT * FROM giohang WHERE ID_Session = '$session_id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function capnhat_giohang($idgiohang, $soluong){
			$idgiohang = mysqli_real_escape_string($this->db->link, $idgiohang);
			$soluong = mysqli_real_escape_string($this->db->link, $soluong);

			$query = "UPDATE giohang SET Soluong = '$soluong' WHERE ID_Giohang = '$idgiohang'";
			$result = $this->db->update($query);
			if($result){
				echo '<script> location.replace("giohang.php"); </script>';
			}
			else{
				$thongbao = '<span style="color: green; font-size:18px">Số lượng sản phẩm trong giỏ hàng KHÔNG được cập nhật</span>';
				return $thongbao;

			}
		}

		public function xoa_giohang($idgiohang){
			$idgiohang = mysqli_real_escape_string($this->db->link, $idgiohang);
			$query = "DELETE FROM giohang WHERE ID_Giohang='$idgiohang'";
			$result = $this->db->delete($query);
			if($result){
				echo '<script> location.replace("giohang.php"); </script>';
			}
			else{
				$thongbao = '<span style="color: green; font-size:18px">Sản phẩm trong giỏ hàng CHƯA được xóa</span>';
				return $thongbao;

			}
		}

		public function check_cart(){
			$session_id = session_id();
			$query = "SELECT * FROM giohang WHERE ID_Session = '$session_id'";
			$result = $this->db->select($query);
			return $result;	
		}
		public function xoa_dulieu_giohang(){
			$session_id = session_id();
			$query = "DELETE  FROM giohang WHERE ID_Session = '$session_id'";
			$result = $this->db->delete($query);
			return $result;	
		}
			public function xoa_dulieu_sosanh($idkhachhang){
			$session_id = session_id();
			$query = "DELETE  FROM sosanh WHERE ID_Khachhang = '$idkhachhang'";
			$result = $this->db->delete($query);
			return $result;	
		}


		public function themdon($id_khachhang){
			$session_id = session_id();
			$query = "SELECT * FROM giohang WHERE ID_Session = '$session_id'";
			$lay_sanpham = $this->db->select($query);
			if($lay_sanpham){
				while($result=$lay_sanpham->fetch_assoc()){
					$id_sanpham = $result['ID_Sanpham'];
					$ten_sanpham = $result['Ten_Sanpham'];
					$soluong = $result['Soluong'];
					$gia = $result['Gia_Sanpham'] ;
					$hinhanh = $result['Hinhanh'];
					$idkhachhang = $id_khachhang;

					$insert_don = "INSERT INTO dathang(ID_Sanpham, Ten_Sanpham, ID_Khachhang, Soluong, Gia_Sanpham, Hinhanh) VALUES('$id_sanpham', '$ten_sanpham','$idkhachhang', '$soluong', '$gia', '$hinhanh')";
					$themdon = $this->db->insert($insert_don);

				}
			}

		}

		public function laydonhang($id){
			$session_id = session_id();
			$query = "SELECT * FROM dathang WHERE ID_Khachhang = '$id'";
			$result = $this->db->select($query);
			return $result;	
		}

		public function lay_donhang(){
			$query = "SELECT * FROM dathang ORDER BY Ngay_Dathang ";
			$result = $this->db->select($query);
			return $result;	
		}

		public function xuly_donhang($id, $time, $gia){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$gia = mysqli_real_escape_string($this->db->link, $gia);

			$query = "UPDATE dathang SET Tinhtrang = '1' WHERE ID_Dathang = '$id' AND Ngay_Dathang='$time' AND Gia_Sanpham='$gia'";
			$result = $this->db->update($query);
			if($result){
				$message = '<span class="success"> Cập nhật đơn hàng thành công</span>';
				return $message;
			}
			else{
				$message = '<span class="error"> Cập nhật đơn hàng KHÔNG thành công</span>';
				return $message;
			}
		}

		public function xoa_donhang($id, $time, $gia){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$gia = mysqli_real_escape_string($this->db->link, $gia);

			$query = "DELETE FROM dathang WHERE ID_Dathang = '$id' AND Ngay_Dathang='$time' AND Gia_Sanpham='$gia'";
			$result = $this->db->delete($query);
			if($result){
				$message = '<span class="success"> Xóa đơn hàng thành công</span>';
				return $message;
			}
			else{
				$message = '<span class="error"> Xóa đơn hàng KHÔNG thành công</span>';
				return $message;
			}
		}

		public function xacnhan_donhang($id, $time, $gia){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$gia = mysqli_real_escape_string($this->db->link, $gia);
			$query = "UPDATE dathang SET Tinhtrang = '2' WHERE ID_Khachhang = '$id' AND Ngay_Dathang='$time' AND Gia_Sanpham='$gia'";
			$result = $this->db->update($query);
			return $result;
		}
	}

?>