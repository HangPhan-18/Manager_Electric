<?php
	class index extends Dcontroller{
	
		public function __construct(){
			$data = array();
			parent::__construct();
		}

		public function homepage(){
			$this->load->view('header');
			$this->load->view('home');
			$this->load->view('footer');
		}

		public function category(){

			$this->load->view('header');
			$homemodel = $this->load->model('homemodel');
			$danhmuc = 'danhmucsp';

			$data['category'] = $homemodel->category($danhmuc);

			$this->load->view('category', $data);
			$this->load->view('footer');
		}
		
	}
?>