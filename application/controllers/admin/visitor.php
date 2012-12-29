<?php
class Visitor extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('VisitorMapper');
		$this->load->library('ResultBack', 'resultback');
		//$this->load->library('qqFileUploader');
	}
	
	public function delete_visitor() {
		$id = $this->input->post('id');
		$visitormapper = $this->VisitorMapper;
		$resultback = $visitormapper->delete($id);
		echo json_encode($resultback);
	}
}

?>