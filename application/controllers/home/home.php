<?php
class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('TopicMapper');
		$this->load->model('QuestionMapper');
		$this->load->model('OptionMapper');
		$this->load->model('VisitorMapper');
	}

	public function index()
	{
		$data['topics'] = $this->TopicMapper->get_all_display_topics();
		$this->load->view('home/main', $data);
	}
	
	public function topic($id) {
		$data['topic'] = $this->TopicMapper->get_topic($id);
		if (empty($data['topic'])) {
			show_404();
		}
		$data['questions'] = $this->QuestionMapper->get_questions($id);
		$data['options'] = array();
		$is_submit = $this->VisitorMapper->is_submit($id);
		$data['is_submit'] = $is_submit;
		$data['stats'] = $this->VisitorMapper->get_topic_stat($id);

		foreach ($data['questions'] as $question) {
			$data['options'][$question['id']] = $this->OptionMapper->get_options($question['id']);
		}
		if (!$is_submit) {
			$this->load->view('home/topic', $data);
		}else {
			var_dump($data['stats']);
			$this->load->view('home/stat', $data);
		}
		
	}
	

	
}

?>