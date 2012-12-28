<?php
class QuestionMapper extends CI_Model {
	
	
	public function __construct() {
		parent::__construct();
		$this->load->library('ResultBack', 'resultback');
	}
	
	public function update($data, $id) {
		$resultback = $this->resultback;
		try {
			$this->db->where('id', $id);
			$this->db->update('question', $data);
			$resultback->setCMD($resultback::success, '更新问题成功', $data);
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '更新问题失败');
		}
		
		return $resultback->getCMD();
	}
	
	public function add($data) {
		$resultback = $this->resultback;
		$data_question = array(
				'title' => $data['title'],
				'type' => $data['type'],
				'topic_id' => $data['topic_id'],
				);
		try {
			$this->db->insert('question',$data_question);
			
// 			$data_relation = array(
// 					'topic_id' => $data['topic_id'],
// 					'question_id' => $this->db->insert_id()
// 			);
			
// 			$this->db->insert('topic_question', $data_relation);
			
			$resultback->setCMD($resultback::success, '添加问题成功', array('id'=>$this->db->insert_id()));
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '添加问题失败');
		}
		return $resultback->getCMD();
	}
	
	public function get_all_questions() {
		$this->db->select();
		$query = $this->db->get('question');
		return $query->result_array();
	}
	
	public function get_questions($topic_id) {
		$this->db->select();
		$this->db->where('topic_id', $topic_id);
		$query = $this->db->get('question');
		return $query->result_array();
	}
	
	public function delete($id) {
		$resultback = $this->resultback;
		try {
			$this->db->delete('question', array('id' => $id));
			$this->db->delete('option', array('question_id' => $id));
			//$this->db->delete('question_option', array('question_id'=>$id));
			//$this->db->delete('topic_question', array('question_id'=>$id));
			$resultback->setCM($resultback::success, '删除问题成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '删除问题失败');
		}
	
		return $resultback->getCM();
	}
}

?>