<?php
class Option extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('OptionMapper');
	}
	
	public function add_option() {
		$data = array(
				'content' => $this->input->post('content'),
 				'question_id' => $this->input->post('question_id'),
				);
		$optionmapper = $this->OptionMapper;
		$resultback = $optionmapper->add($data);
		echo json_encode($resultback);
	}
	
	public function delete_option() {
		$id = $this->input->post('id');
		$optionmapper = $this->OptionMapper;
		$resultback = $optionmapper->delete($id);
		
		echo json_encode($resultback);
	}
	
	public function update_option() {
		$id = $this->input->post('id');
		$data = $this->input->post();
		unset($data['id']);
		$optionmapper = $this->OptionMapper;
		$resultback = $optionmapper->update($data, $id);
		
		echo json_encode($resultback);
	}
}

?>