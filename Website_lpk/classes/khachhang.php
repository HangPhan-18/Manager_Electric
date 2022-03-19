<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php'); 
 ?>

<?php
	/**
	 * 
	 */
	class khachhang
	{
		private $db; //database
		private $fm; //format

		public function __construct()
		{
			$this->db = new database();
			$this->fm = new format();
		}

		public function them_khachhang($data){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));

			if($name==''||$email==''||$address==''||$phone==''||$password==''){
				$alert ="<span class='error'>Không được bỏ trống</span>";
				return $alert;

			}else{
				$check_email = "SELECT * FROM khachhang WHERE Email='$email' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error'>Email đã tồn tại trong hệ thống</span>";
					return $alert;
				}else{
					$query = "INSERT INTO khachhang(Ten_Khachhang, Diachi,  Email, Sdt, Password) VALUES('$name', '$address',  '$email', '$phone', '$password')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Đăng ký thành viên thành công!</span>";
						return $alert;

					}else{
						$alert = "<span class='error'>Đăng ký thành viên KHÔNG thành công</span>";
						return $alert;
					}
				}
			}

		}


		public function login_khachhang($data){
		
		 	$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));

			if(empty($email) ||empty($password)){
				$alert ="<span class='error'>Không được bỏ trống</span>";
				return $alert;

			}else{
				$check_login = "SELECT * FROM khachhang WHERE Email='$email' AND Password='$password'LIMIT 1";
				$result_check = $this->db->select($check_login);
				if($result_check){
					$value = $result_check->fetch_assoc();
					session::set('login_khachhang', true);
					session::set('id_khachhang', $value['ID_Khachhang']);
					session::set('ten_khachhang', $value['Ten_Khachhang']);
					echo '<script> location.replace("index.php"); </script>';

				}else{
					$alert = "<span class='error'>Email hoặc Password không đúng</span>";
					return $alert;
				}
			}
		}
		public function hienthi_khachhang($id){
			$query = "SELECT * FROM khachhang WHERE ID_Khachhang = '$id' LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function sua_khachhang($data, $id){
			$name = mysqli_real_escape_string($this->db->link, $data['name']);
			
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
			$address = mysqli_real_escape_string($this->db->link, $data['address']);
			
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		

			if($name==''||$email==''||$address==''||$phone==''){
				$alert ="<span class='error'>Không được bỏ trống</span>";
				return $alert;

			}else{
				$query = "UPDATE khachhang SET Ten_Khachhang='$name',  Diachi='$address',  Email='$email',  Sdt='$phone' WHERE ID_Khachhang ='$id'";
					$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>KHÁCH HÀNG ĐÃ THỰC HIỆN CẬP NHẬT THÀNH CÔNG</span>";
						return $alert;

					}else{
						$alert = "<span class='error'>Thông tin khách hàng CHƯA được cập nhật</span>";
						return $alert;
					}
				}
			
		}


		public function them_binhluan($idsanpham, $idkhachhang){
			$idsanpham = mysqli_real_escape_string($this->db->link, $idsanpham);
			$idkhachhang = mysqli_real_escape_string($this->db->link, $idkhachhang);
			// $idsanpham = $_POST['idsp_binhluan'];
			// $tenbinhluan = $_POST['tennguoibinhluan'];
			$binhluan = $_POST['binhluan'];
			if($binhluan==''){
				$alert = '<span class="error">Không được bỏ trống</span>';
				return $alert;
			}
			else{
				$query = "INSERT INTO binhluan(ID_Khachhang, Chitiet_Binhluan, ID_Sanpham) VALUES('$idkhachhang', '$binhluan', '$idsanpham')";
				$result = $this->db->insert($query);
				if($result){
					$alert = '<span class="success">Bình luận đã được thêm vào</span>';
					return $alert;
				}
				else{
					$alert = '<span class="error">Bình luận bị lỗi</span>';
					return $alert;
				}
			}
		}

		public function xoa_binhluan($id){
			$query = "DELETE FROM binhluan WHERE ID_Binhluan ='$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = '<span class="success">Bình luận đã được xóa</span>';
				return $result;
			}
			else{
				$alert = '<span class="error">Bình luận xóa KHÔNG thành công</span>';
				return $result;
			}
		}

		public function hienthi_binhluan($id){
			$query = "SELECT binhluan.*, khachhang.Ten_Khachhang FROM binhluan INNER JOIN khachhang ON binhluan.ID_Khachhang = khachhang.ID_Khachhang WHERE ID_Sanpham = '$id' ORDER BY ID_Binhluan DESC";
			$result = $this->db->select($query);
			return $result;
		}

	}
		
	

?>