<?php
	class category extends Dcontroller{
	
		public function __construct(){
			$data = array();
			parent::__construct();
		}
		public function category(){

			$this->load->view('header');
			$homemodel = $this->load->model('homemodel');
			$danhmuc = 'danhmucsp';

			$data['category'] = $homemodel->category($danhmuc);

			$this->load->view('category', $data);
			$this->load->view('footer');
		}
		public function iddanhmuc(){
			$this->load->view('header');
			$homemodel = $this->load->model('homemodel');
			$id = 1;
			$danhmuc = 'danhmucsp';
			$data['id_danhmuc'] = $homemodel->iddanhmuc($danhmuc, $id);
			$this->load->view('id_danhmuc', $data);
			$this->load->view('footer');
		}
	}
?>