<?php
class Question extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('QuestionMapper');

		//$this->load->library('qqFileUploader');
	}
	
	public function add_question() {
		$questionmapper = $this->QuestionMapper;
		$data = array(
				'title' => $this->input->post('title'),
				'type' => $this->input->post('type'),
 				'topic_id' => $this->input->post('topic_id'),
				);
		$resultback = $questionmapper->add($data);
		
		echo json_encode($resultback);
	}
	
	public function delete_question() {
		$id = $this->input->post('id');
		$questionmapper = $this->QuestionMapper;
		$resultback = $questionmapper->delete($id);
		echo json_encode($resultback);
	}
	
	public function update_question() {
		$data = $this->input->post();
		unset($data['id']);
		$id = $this->input->post('id');
		$questionmapper = $this->QuestionMapper;
		$resultback = $questionmapper->update($data, $id);
		echo json_encode($resultback);
	}
}

?>