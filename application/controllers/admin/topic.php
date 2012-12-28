<?php
class Topic extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('TopicMapper');
		//$this->load->library('qqFileUploader');
	}
	
	public function add_topic() {
// 		$resultback = $this->resultback;
		$topicmapper = $this->TopicMapper;
		$topic_name = $this->input->post('name');
		$data = array(
				'name' => $topic_name
				);
		
		$resultback = $topicmapper->add($data);
		
		echo json_encode($resultback);
	}
	
	public function delete_topic() {
		$id = $this->input->post('id');
		$topicmapper = $this->TopicMapper;
		$resultback = $topicmapper->delete($id);

	
		echo json_encode($resultback);
	}
	
	public function update_topic() {
		$data = $this->input->post();
		unset($data['id']);
		$id = $this->input->post('id');
		$topicmapper = $this->TopicMapper;
		$resultback = $topicmapper->update($data, $id);
		echo json_encode($resultback);
	}
}

?>