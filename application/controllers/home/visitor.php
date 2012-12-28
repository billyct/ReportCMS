<?php
class Visitor extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('VisitorMapper');
	}
	
	public function submit() {
		$data_visitor = array(
				'ip' => $_SERVER['REMOTE_ADDR' ],
				'create_at' => date('Y-m-d H:i:s'),
				);
		$data_answer = $this->input->post('answers');
		$resultback = $this->VisitorMapper->submit($data_visitor, $data_answer);

		echo json_encode($resultback);
	}
	

}

?>