<?php
class TopicMapper extends CI_Model {
	
	const abled = 1;
	const disabled = 0; 
	
	public function __construct() {
		parent::__construct();
		$this->load->library('ResultBack', 'resultback');
	}
	
	public function update($data, $id) {
		$resultback = $this->resultback;
		try {
			$this->db->where('id', $id);
			$this->db->update('topic', $data);
			$resultback->setCM($resultback::success, '更新话题成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '更新话题失败');
		}
		
		return $resultback->getCM();
	}
	
	public function add($data) {
		$resultback = $this->resultback;
		try {
			$this->db->insert('topic',$data);
			$resultback->setCMD($resultback::success, '添加主题成功', array('id'=>$this->db->insert_id()));
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '添加主题失败');
		}
		
		return $resultback->getCMD();
	}
	
	public function get_all_topics() {
		$this->db->select();
		$query = $this->db->get('topic');
		return $query->result_array();
	}
	
	public function get_all_display_topics() {
		$this->db->select();
		$this->db->where('display', self::abled);
		$query = $this->db->get('topic');
		return $query->result_array();
	}
	
	public function get_topic($id) {
		$this->db->select();
		$this->db->where('display', self::abled);
		$this->db->where('id', $id);
		$query = $this->db->get('topic');
		return $query->row_array();
	}
	
	public function delete($id) {
		$resultback = $this->resultback;
		$this->load->model('QuestionMapper');
		try {
			$this->db->delete('topic', array('id' => $id));
			//$this->db->delete('question', array('topic_id' => $id));
			$this->db->select('id');
			$this->db->where('topic_id', $id);
			$id_query = $this->db->get('question');
			foreach ($id_query->result_array() as $question) {
				$this->db->delete('question', array('id' => $question['id']));
				$this->db->delete('option', array('question_id' => $question['id']));
			}
			
			//$this->db->delete('question', array('topic_id' => $id));

			//$this->db->delete('topic_question', array('topic_id'=>$id));
			
			
			$resultback->setCM($resultback::success, '删除主题成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '删除主题失败');
		}
		
		return $resultback->getCM();
	}
}

?>