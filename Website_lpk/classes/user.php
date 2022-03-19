<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php'); 
 ?>

<?php
	/**
	 * 
	 */
	class user
	{
		private $db; //database
		private $fm; //format

		public function __construct()
		{
			$this->db = new database();
			$this->fm = new format();
		}
		public function them_user($data){
			$adminname = mysqli_real_escape_string($this->db->link, $data['adminname']);
			
			$adminuser = mysqli_real_escape_string($this->db->link, $data['adminuser']);
			
			$adminemail = mysqli_real_escape_string($this->db->link, $data['adminemail']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			$level = mysqli_real_escape_string($this->db->link, $data['level']);


			if($adminname==''||$adminuser==''||$adminemail==''||$password==''||$level==''){
				$alert ="<span class='error'>Không được bỏ trống</span>";
				return $alert;

			}else{
				$check_username = "SELECT * FROM admin WHERE adminUser='$adminuser' LIMIT 1";
				$result_check = $this->db->select($check_username);
				if($result_check){
					$alert = "<span class='error'>Tên người dùng đã tồn tại trong hệ thống</span>";
					return $alert;
				}else{
					$query = "INSERT INTO admin(adminName, adminEmail, adminUser, adminPass, Level) VALUES('$adminname', '$adminemail',  '$adminuser', '$password', '$level')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Bạn đã thêm thành công nhân viên mới!</span>";
						return $alert;

					}else{
						$alert = "<span class='error'>Bạn đã thêm KHÔNG thành công nhân viên mới!</span>";
						return $alert;
					}
				}
			}

		}

		public function hienthi_quantri(){
			$query = "SELECT * FROM admin ORDER BY Idadmin ASC";
			$result = $this->db->select($query);
			return $result;
		}

		public function sua_quantri($data, $id){

			$adminname = mysqli_real_escape_string($this->db->link, $data['adminname']);
			
			$adminuser = mysqli_real_escape_string($this->db->link, $data['adminuser']);
			
			$adminemail = mysqli_real_escape_string($this->db->link, $data['adminemail']);
			$password = mysqli_real_escape_string($this->db->link, $data['password']);
			$level = mysqli_real_escape_string($this->db->link, $data['level']);

			if($adminname==''||$adminuser==''||$adminemail==''||$password==''||$level==''){
				$alert ="<span class='error'>Không được bỏ trống</span>";
				return $alert;

			}else{
				$query = "UPDATE admin SET adminName='$adminname', adminEmail='$adminemail', adminUser='$adminuser', adminPass= '$password', Level='$level' WHERE Idadmin ='$id'";
					$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Thông tin đã được cập nhật thành công</span>";
						return $alert;

					}else{
						$alert = "<span class='error'>Thông tin CHƯA được cập nhật</span>";
						return $alert;
					}
				}
			
		}

		public function xoa_quantri($id){
			$query = "DELETE FROM admin WHERE Idadmin ='$id' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = '<span class="success">Người dùng này đã bị xóa thành công</span>';
				return $result;
			}
			else{
				$alert = '<span class="error">Không thể xóa người dùng này!</span>';
				return $result;
			}
		}

		public function Layid_admin($id){
			$query = "SELECT * FROM admin WHERE Idadmin ='$id' ";
			$result = $this->db->select($query);
			return $result;
		}

			



	}
?>