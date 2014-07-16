<?php
class OptionMapper extends CI_Model {
	
	
	public function __construct() {
		parent::__construct();
		$this->load->library('ResultBack', 'resultback');
	}
	
	public function add($data) {
		$resultback = $this->resultback;
		$data_option = array(
				'content' => $data['content'],
				'question_id' => $data['question_id'],
				);
		
		try {
			$this->db->insert('option', $data_option);
			
// 			$data_relation = array(
// 					'question_id' => $data['question_id'],
// 					'option_id' => $this->db->insert_id(),
// 			);
			
// 			$this->db->insert('question_option', $data_relation);
			
			$resultback->setCMD($resultback::success, '添加选项成功', array('id'=>$this->db->insert_id()));
			
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '添加选项失败');
		}
		
		return $resultback->getCMD();
		
	}
	
	
	public function update($data, $id) {
		$resultback = $this->resultback;
		try {
			$this->db->where('id', $id);
			$this->db->update('option', $data);
			$resultback->setCMD($resultback::success, '更新选项成功', $data);
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '更新选项失败');
		}
		
		return $resultback->getCMD();
	}
	
	public function get_all_options() {
		$this->db->select();
		$query = $this->db->get('option');
		return $query->result_array();
	}
	
	public function get_options($question_id) {
		$this->db->select();
		$this->db->where('question_id', $question_id);
		$query = $this->db->get('option');
		return $query->result_array();
	}
	
	
	public function delete($id) {
		$resultback = $this->resultback;
		try {
			$this->db->delete('option', array('id' => $id));
			// $this->db->delete('question_option', array('option_id'=>$id));
			$resultback->setCM($resultback::success, '删除选项成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '删除选项失败');
		}
	
		return $resultback->getCM();
	}
}

?>