<?php
class Admin extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('UserMapper');
		$this->load->model('TopicMapper');
		$this->load->model('QuestionMapper');
		$this->load->model('OptionMapper');
		$this->load->model('VisitorMapper');
		$this->load->library('ResultBack', 'resultback');
		//$this->load->library('qqFileUploader');
	}

	public function index()
	{
		if ($this->session->userdata('auth') != null) {
			$data['topics'] = $this->TopicMapper->get_all_topics();
			$data['questions'] = $this->QuestionMapper->get_all_questions();
			$data['options'] = $this->OptionMapper->get_all_options();
			$data['visitors'] = $this->VisitorMapper->get_all_visitors();
			
			$this->load->view('admin/main', $data);
		}else {
			$this->load->view('admin/login');
		}
	}
	
	public function login() {
		$login_flag = $this->input->post('login');
		if ($login_flag) {
			$this->UserMapper->auth();
			redirect('/admin');
		}
	
		$this->load->view('admin/login');
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('/admin');
	}
	

}

?>