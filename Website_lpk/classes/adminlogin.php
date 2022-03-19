<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/session.php');
	session::checkLogin();
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php'); 
 ?>

<?php
	/**
	 * 
	 */
	class adminlogin
	{
		private $db; //database
		private $fm; //format

		public function __construct()
		{
			$this->db = new database();
			$this->fm = new format();
		}
		public function login_admin($adminUser, $adminPass){
				$adminUser = $this->fm->validation($adminUser);
				$adminPass = $this->fm->validation($adminPass);
				//Thoat cac ky tu dac biet trong chuoi
				$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
				$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

				if(empty($adminUser) || empty($adminPass)){
					$alert ="User and password must be not empty";
					return $alert;
				}else{
					$query = "SELECT * FROM admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'LIMIT 1";
					$result = $this->db->select($query);
					if($result != false){
						$value = $result->fetch_assoc();
						session::set('adminlogin', true);
						session::set('adminId', $value['Idadmin']);
						session::set('adminUser', $value['adminUser']);
						session::set('adminName', $value['adminName']);
						header("Location:index.php");
					}else{
						$alert ="<span class='error'>Tài khoản hoặc mật khẩu không đúng!</span>";
						return $alert;
					}
				}
			}
//Kiểm tra người dùng có phải là admin với level bằng 1 hay không
			public function check_admin($adminUser, $adminPass){
				$adminUser = $this->fm->validation($adminUser);
				$adminPass = $this->fm->validation($adminPass);
				//Thoat cac ky tu dac biet trong chuoi
				$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
				$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

				if(empty($adminUser) || empty($adminPass)){
					$alert ="User and password must be not empty";
					return $alert;
				}else{
					$query = "SELECT * FROM admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' AND Level = 1 LIMIT 1";
					$result = $this->db->select($query);
					if($result != false){
						$value = $result->fetch_assoc();
						session::set('check_admin', true);
						session::set('adminId', $value['Idadmin']);
						session::set('adminUser', $value['adminUser']);
						session::set('adminName', $value['adminName']);
						header("Location:index.php");
					}else{
						$alert ="<span class='error'>Tài khoản hoặc mật khẩu không đúng!</span>";
						return $alert;
					}
				}
			}

			
	}
?>