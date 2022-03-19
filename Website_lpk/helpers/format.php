<?php
	class format{

		//Dinh dang ngay thang nam o trong website
		public function formatDate($date){
			return date('F j, Y, g:i a', strtotime($date));
		}
		//Dinh dang chuan nhung doan text ngan
		public function textShorten($text, $limit = 400){
			$text = $text." ";
			$text = substr($text, 0, $limit);
			$text = substr($text, 0, strrpos($text, ' '));
			$text = $text."......";
			return $text;
		}
		//Kiem tra form
		public function validation($data){
			$data = trim($data);
			//Chuỗi bỏ dấu ngoặc kép
			$data = stripcslashes(($data));
			//Chuyển đổi các ký tự đặc biệt thành các thực thể HTML
			$data = htmlspecialchars($data);
			return $data;
		}
		//kiem tra ten cua server
		public function title(){
			$path = $_SERVER['SCRIPT_FILNAME'];
			//basename hàm sẽ trả về phần đuôi của đường dẫn truyên vào
			$title = basename($path, '.php');
			if($title=='index'){
				$title = 'home';
			}
			elseif ($title =='contact') {
				$title = 'contact';
			}
			//Viết hoa ký tự đầu tiên của chuỗi
			return $title = ucfirst($title);
		}
	}
?>