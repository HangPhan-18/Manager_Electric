<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php'); 
 ?>

<?php
	/**
	 * 
	 */
	class sanpham
	{
		private $db; //database
		private $fm; //format

		public function __construct()
		{
			$this->db = new database();
			$this->fm = new format();
		}
		public function them_sanpham($data, $files){
				//Thoat cac ky tu dac biet trong chuoi, loai bo nhung ky tu anh huong den cau lenh SQL
				$tensanpham = mysqli_real_escape_string($this->db->link, $data['tensanpham']);
				$danhmuc = mysqli_real_escape_string($this->db->link, $data['danhmuc']);
				$thuonghieu = mysqli_real_escape_string($this->db->link, $data['thuonghieu']);
				$mota_sanpham = mysqli_real_escape_string($this->db->link, $data['mota_sanpham']);
				$gia = mysqli_real_escape_string($this->db->link, $data['gia']);
				$noibat = mysqli_real_escape_string($this->db->link, $data['noibat']);
				// $tendanhmuc = mysqli_real_escape_string($this->db->link, $data['tensanpham']);
				//Kiem tra hinh anh va lay hinh anh cho vao folder uploads
				$hinhanh = array('jpg', 'jpeg', 'png', 'gìf');
				$file_name = $_FILES['image']['name'];
				$file_size = $_FILES['image']['size'];
				$file_temp = $_FILES['image']['tmp_name'];
				//Chia cắt cái tên file hình thành 2 phần abc.jpg
				$div = explode('.', $file_name);

				//Chuyển toàn bộ ký tự trong chuỗi về dạng chữ thường ở phần đuôi của $div
				$file_exit = strtolower(end($div));
				//trích xuất 1 phần của chuỗi như random từ 0 đến 10 và kết hợp $file_exit để thành 1 tên mới
				$unique_image = substr(md5(time()), 0, 10).'.'.$file_exit;
				$uploaded_image = "upload/".$unique_image;


				if($tensanpham==''||$danhmuc==''||$thuonghieu==''||$mota_sanpham==''||$gia==''||$noibat==''||$file_name==''){
					$alert ="<span class='error'>Không được bỏ trống</span>";
					return $alert;
				}else{
					move_uploaded_file($file_temp, $uploaded_image);

					$query = "INSERT INTO sanpham(Ten_Sanpham, ID_Danhmuc, ID_Thuonghieu, Mota_Sanpham, Noibat_Sanpham, Gia_Sanpham, Hinhanh_Sanpham) VALUES('$tensanpham', '$danhmuc', '$thuonghieu', '$mota_sanpham', '$noibat', '$gia', '$unique_image')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>THÊM SẢN PHẨM THÀNH CÔNG!</span>";
						return $alert;

					}else{
						$alert = "<span class='error'>THÊM SẢN PHẨM KHÔNG THÀNH CÔNG!</span>";
						return $alert;
					}
					
				}
			}
		 public function hienthi_sanpham(){
		 	$query = "SELECT sanpham.*,danhmucsp.Ten_Danhmuc, thuonghieusp.Ten_Thuonghieu 

		 	FROM sanpham INNER JOIN danhmucsp ON sanpham.ID_Danhmuc = danhmucsp.ID_Danhmuc 

		 				INNER JOIN thuonghieusp ON sanpham.ID_Thuonghieu = thuonghieusp.ID_Thuonghieu
		 				
		 				ORDER BY sanpham.ID_Sanpham  DESC";
		 	//$query = "SELECT * FROM sanpham ORDER BY ID_Sanpham DESC ";
		 	$result = $this->db->select($query);
		 	return $result;
		 }

		public function sua_sanpham($data, $files, $id){
				//Thoat cac ky tu dac biet trong chuoi
				$tensanpham = mysqli_real_escape_string($this->db->link, $data['tensanpham']);
				$danhmuc = mysqli_real_escape_string($this->db->link, $data['danhmuc']);
				$thuonghieu = mysqli_real_escape_string($this->db->link, $data['thuonghieu']);
				$mota_sanpham = mysqli_real_escape_string($this->db->link, $data['mota_sanpham']);
				$gia = mysqli_real_escape_string($this->db->link, $data['gia']);
				$noibat = mysqli_real_escape_string($this->db->link, $data['noibat']);
				// $tendanhmuc = mysqli_real_escape_string($this->db->link, $data['tensanpham']);
				//Kiem tra hinh anh co cac đuôi trong mảng mới cho phép upload va lay hinh anh cho vao folder upload
				$hinhanh = array('jpg', 'jpeg', 'png', 'gìf');
				$file_name = $_FILES['image']['name'];
				$file_size = $_FILES['image']['size'];
				$file_temp = $_FILES['image']['tmp_name'];

				$div = explode('.', $file_name);//Phan ten hinh anh ra thanh 2 boi dau cham 123 . png
				$file_exit = strtolower(end($div));//Chuyen phan mo rong trong file anh tu chu hoa thanh chu thuong PNG->png, PnG->png
				//Random so tu 0 toi 10 va ma hoa md5 va ket hop voi file_exit de tao thanh ten file moi
				$unique_image = substr(md5(time()), 0, 10).'.'.$file_exit;

				$uploaded_image = "upload/".$unique_image;

				if($tensanpham==''||$danhmuc==''||$thuonghieu==''||$mota_sanpham==''||$gia==''||$noibat==''){
					$alert ="<span class='error'>Không được bỏ trống</span>";
					return $alert;
				}else{
					if(!empty($file_name)){
						//Neu nguoi dung chon sua hinh anh
						if($file_name>2048){
							$alert = "<span class='success'>Hình ảnh sản phẩm phải nhỏ hơn 2MB!</span>";
							return $alert;
						}
						elseif(in_array($file_exit, $hinhanh)===false){					
							// echo "<span class='error'>Bạn chỉ có thể tải lên hình ảnh:-" .implode(',' ,$hinhanh)."</span>"
							$alert = "<span class='success'>Bạn chỉ có thể tải lên hình ảnh:-" .implode(',' ,$hinhanh)."</span>";
							return $alert;
					}
						//neu nguoi dung chon sua file hinh anh
						move_uploaded_file($file_temp, $uploaded_image);
						$query = "UPDATE sanpham SET 
						Ten_Sanpham = '$tensanpham',
						ID_Danhmuc = '$danhmuc',
						ID_Thuonghieu = '$thuonghieu',
						Mota_Sanpham = '$mota_sanpham',
						Noibat_Sanpham = '$noibat',
						Gia_Sanpham = '$gia',
						Hinhanh_Sanpham = '$unique_image'
						WHERE ID_Sanpham = '$id'";
						$result = $this->db->update($query);//co san trong lib->database.php
						if($result){
								$alert = "<span class='success'>Cập nhật danh mục thành công</span>";
								return $alert;

						}else{
							$alert = "<span class='error'>Cập nhật danh mục không thành công</span>";
							return $alert;
					}

					}else{
						//Neu nguoi dung khong chọn sua file hinh anh
						$query = "UPDATE sanpham SET 
						Ten_Sanpham = '$tensanpham',
						ID_Danhmuc = '$danhmuc',
						ID_Thuonghieu = '$thuonghieu',
						Mota_Sanpham = '$mota_sanpham',
						Noibat_Sanpham = '$noibat',
						Gia_Sanpham = '$gia'
						WHERE ID_Sanpham = '$id'";
					}
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

		public function xoa_sanpham($id){
			$query = "DELETE FROM sanpham WHERE ID_Sanpham='$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa sản phẩm thành công</span>";
				return $alert;

			}else{
				$alert = "<span class='error'>Xóa sản phẩm không thành công</span>";
				return $alert;
					}			
		}
		public function Layid_sanpham($id){
			$query = "SELECT * FROM sanpham WHERE ID_Sanpham ='$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		//End Backend
		public function Laysanpham_noibat(){
			$query = "SELECT * FROM sanpham WHERE Noibat_Sanpham ='1' LIMIT 5 ";
			$result = $this->db->select($query);
			return $result;
		}

		public function lay_tatca_sp(){
			$query = "SELECT * FROM sanpham ORDER BY ID_Sanpham";
			$result = $this->db->select($query);
			return $result;
		}

		public function Laysanpham_moi(){
			$sanpham_trang = 5;
			if(!isset($_GET['trang'])){
				$trang=1;
			}
			else{
				$trang = $_GET['trang'];
			}
			$tungtrang = ($trang-1)*$sanpham_trang;
			$query = "SELECT * FROM sanpham ORDER BY ID_Sanpham DESC LIMIT $tungtrang, $sanpham_trang ";
			$result = $this->db->select($query);
			return $result;
		}

		public function Laysanpham_chitiet($id){
			$query = "SELECT sanpham.*,danhmucsp.Ten_Danhmuc, thuonghieusp.Ten_Thuonghieu 

		 	FROM sanpham INNER JOIN danhmucsp ON sanpham.ID_Danhmuc = danhmucsp.ID_Danhmuc 

		 				INNER JOIN thuonghieusp ON sanpham.ID_Thuonghieu = thuonghieusp.ID_Thuonghieu
		 				
		 				WHERE sanpham.ID_Sanpham = '$id'";
		 	
		 	$result = $this->db->select($query);
		 	return $result;
		}


		public function laythuonghieuIntel(){
			$query = "SELECT * FROM sanpham WHERE ID_Thuonghieu = '10' ORDER BY ID_Sanpham DESC LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}
		public function laythuonghieuNVIDIA(){
			$query = "SELECT * FROM sanpham WHERE ID_Thuonghieu = '12' ORDER BY ID_Sanpham DESC LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}
		public function laythuonghieuMSI(){
			$query = "SELECT * FROM sanpham WHERE ID_Thuonghieu = '20' ORDER BY ID_Sanpham DESC LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}
		public function laythuonghieuAMD(){
			$query = "SELECT * FROM sanpham WHERE ID_Thuonghieu = '7' ORDER BY ID_Sanpham DESC LIMIT 1 ";
			$result = $this->db->select($query);
			return $result;
		}

		public function sosanh_sanpham($idsanpham, $idkhachhang){

			$idsanpham = mysqli_real_escape_string($this->db->link, $idsanpham);
			$idkhachhang = mysqli_real_escape_string($this->db->link, $idkhachhang);

			$check_sosanh =  "SELECT * FROM sosanh WHERE ID_Sanpham = '$idsanpham' AND ID_Khachhang = '$idkhachhang'";
			$result_check = $this->db->select($check_sosanh);
			if($result_check){
				$thongbao = "<span class='error'>Sản phẩm đã được thêm vào để so sánh</span>";
				return $thongbao;
			}
			else{

			$query = "SELECT * FROM sanpham WHERE ID_Sanpham = '$idsanpham'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$hinhanh = $result['Hinhanh_Sanpham'];
			$tensanpham = $result['Ten_Sanpham'];
			$gia = $result['Gia_Sanpham'];

			$query_sosanh = "INSERT INTO sosanh(ID_Sanpham, Ten_Sanpham, Gia_Sanpham, ID_Khachhang, Hinhanh_Sanpham) VALUES('$idsanpham', '$tensanpham', '$gia' , '$idkhachhang', '$hinhanh')";
			$themsosanh = $this->db->insert($query_sosanh);

			if($themsosanh){
				$alert = "<span class='success'>Thêm sản phẩm so sánh thành công</span>";
				return $alert;

			}else{
				$alert = "<span class='error'>Thêm sản phẩm so sánh KHÔNG thành công</span>";
				return $alert;
				}
			}
		
		}

		public function lay_sosanh($idkhachhang){
			$query = "SELECT * FROM sosanh WHERE ID_Khachhang = '$idkhachhang' ORDER BY ID_Sosanh DESC ";
			$result = $this->db->select($query);
			return $result;
		}
		public function lay_yeuthich($idkhachhang){
			$query = "SELECT * FROM dsyeuthich WHERE ID_Khachhang = '$idkhachhang' ORDER BY ID_Yeuthich DESC ";
			$result = $this->db->select($query);
			return $result;
		}


		public function yeuthich_sanpham($idsanpham, $idkhachhang){
			$idsanpham = mysqli_real_escape_string($this->db->link, $idsanpham);
			$idkhachhang = mysqli_real_escape_string($this->db->link, $idkhachhang);

			$check_yeuthich =  "SELECT * FROM dsyeuthich WHERE ID_Sanpham = '$idsanpham' AND ID_Khachhang = '$idkhachhang'";
			$result_check = $this->db->select($check_yeuthich);
			if($result_check){
				$thongbao = "<span class='error'>Sản phẩm đã được thêm vào danh sách yêu thích</span>";
				return $thongbao;
			}
			else{

			$query = "SELECT * FROM sanpham WHERE ID_Sanpham = '$idsanpham'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$hinhanh = $result['Hinhanh_Sanpham'];
			$tensanpham = $result['Ten_Sanpham'];
			$gia = $result['Gia_Sanpham'];

			$query_yeuthich = "INSERT INTO dsyeuthich(ID_Sanpham, Ten_Sanpham, Gia_Sanpham, ID_Khachhang, Hinhanh_Sanpham) VALUES('$idsanpham', '$tensanpham', '$gia' , '$idkhachhang', '$hinhanh')";
			$themyeuthich = $this->db->insert($query_yeuthich);

			if($themyeuthich){
				$alert = "<span class='success'>Thêm sản phẩm yêu thích thành công</span>";
				return $alert;

			}else{
				$alert = "<span class='error'>Thêm sản phẩm yêu thích KHÔNG thành công</span>";
				return $alert;
				}
			}
		}


// $query = "SELECT sanpham.*,danhmucsp.Ten_Danhmuc, thuonghieusp.Ten_Thuonghieu 

// 		 	FROM sanpham INNER JOIN danhmucsp ON sanpham.ID_Danhmuc = danhmucsp.ID_Danhmuc 

// 		 				INNER JOIN thuonghieusp ON sanpham.ID_Thuonghieu = thuonghieusp.ID_Thuonghieu
		 				
// 		 				ORDER BY sanpham.ID_Sanpham  DESC";

		public function timkiem_sanpham($tukhoa){
			//Kiểm tra biến từ khóa đã có chưa?
			$tukhoa = $this->fm->validation($tukhoa);
			$query = "SELECT sanpham.*, danhmucsp.Ten_Danhmuc, thuonghieusp.Ten_Thuonghieu

			FROM sanpham INNER JOIN danhmucsp ON sanpham.ID_Danhmuc = danhmucsp.ID_Danhmuc

						 INNER JOIN thuonghieusp ON sanpham.ID_Thuonghieu = thuonghieusp.ID_Thuonghieu

						  WHERE Ten_Sanpham LIKE '%$tukhoa%' OR Ten_Danhmuc LIKE '%$tukhoa' OR Ten_Thuonghieu LIKE '%$tukhoa' ORDER BY ID_Sanpham DESC ";

			$result = $this->db->select($query);
			return $result;
		}
		public function xoa_sanpham_yeuthich($idsanpham, $idkhachhang){
			$query = "DELETE FROM dsyeuthich WHERE ID_Sanpham='$idsanpham' AND ID_Khachhang='$idkhachhang'";
			$result = $this->db->delete($query);
		}


		public function them_slider($data, $files){
				//Thoat cac ky tu dac biet trong chuoi, loai bo nhung ky tu anh huong den cau lenh SQL
				$tenslider = mysqli_real_escape_string($this->db->link, $data['tenslider']);
				$type = mysqli_real_escape_string($this->db->link, $data['type']);
				
				//Kiem tra hinh anh va lay hinh anh cho vao folder uploads
				$hinhanh = array('jpg', 'jpeg', 'png', 'gìf');
				$file_name = $_FILES['image']['name'];
				$file_size = $_FILES['image']['size'];
				$file_temp = $_FILES['image']['tmp_name'];

				$div = explode('.', $file_name);//Phan ten hinh anh ra thanh 2 boi dau cham 123 . png
				$file_exit = strtolower(end($div));//Chuyen phan mo rong trong file anh tu chu hoa thanh chu thuong PNG->png, PnG->png
				//Random so tu 0 toi 10 va ma hoa md5 va ket hop voi file_exit de tao thanh ten file moi
				$unique_image = substr(md5(time()), 0, 10).'.'.$file_exit;

				$uploaded_image = "upload/".$unique_image;

				if($tenslider==''||$type==''){
					$alert ="<span class='error'>Không được bỏ trống</span>";
					return $alert;
				}else{
					if(!empty($file_name)){
						//Neu nguoi dung chon sua hinh anh
						if($file_name>2048){
							$alert = "<span class='success'>Hình ảnh sản phẩm phải nhỏ hơn 2MB!</span>";
							return $alert;
						}
						elseif(in_array($file_exit, $hinhanh)===false){					
							// echo "<span class='error'>Bạn chỉ có thể tải lên hình ảnh:-" .implode(',' ,$hinhanh)."</span>"
							$alert = "<span class='success'>Bạn chỉ có thể tải lên hình ảnh:-" .implode(',' ,$hinhanh)."</span>";
							return $alert;
					}
						//neu nguoi dung chon sua file hinh anh
						move_uploaded_file($file_temp, $uploaded_image);
						$query = "INSERT INTO slider(Ten_Slider, Hinhanh_Slider, An_Hien) VALUES('$tenslider', '$unique_image', '$type')";
						$result = $this->db->insert($query);
						
						//co san trong lib->database.php
						if($result){
								$alert = "<span class='success'>Thêm slider thành công</span>";
								return $alert;

						}else{
							$alert = "<span class='error'>Thêm slider KHÔNG thành công</span>";
							return $alert;
						}

					}	
					
				}
			}

			public function hienthi_slider(){
				$query = "SELECT * FROM slider WHERE An_Hien ='1' ORDER BY ID_Slider DESC";
				$result = $this->db->select($query);
				return $result;
			}

			public function danhsach_slider(){
				$query = "SELECT * FROM slider ORDER BY ID_Slider DESC";
				$result = $this->db->select($query);
				return $result;
			}

			public function capnhat_slider($id, $type){
				$type= mysqli_real_escape_string($this->db->link, $type);
				if($type==1){
					$query = "UPDATE slider SET An_Hien ='0' WHERE ID_Slider = '$id'";
				}else{
					$query = "UPDATE slider SET An_Hien ='1' WHERE ID_Slider = '$id'";
				}
				$result = $this->db->update($query);
				return $result;
			}

			public function xoa_slider($id){
				$query = "DELETE FROM slider WHERE ID_Slider = '$id'";
				$result = $this->db->delete($query);
				if($result){
					$alert = "<span class='success'>Xóa slider thành công</span>";
					return $alert;

				}else{
					$alert = "<span class='error'>Xóa slider KHÔNG thành công</span>";
					return $alert;
				}
			}

		

	}
?>