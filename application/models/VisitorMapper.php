<?php
class VisitorMapper extends CI_Model {
	
	const msg_visitor_exit = "你已经提交过了";
	const is_submit = true;
	const isn_submit = false;
	
	public function __construct() {
		parent::__construct();
		$this->load->library('ResultBack', 'resultback');
	}
	
	public function submit($data_visitor, $data_answers) {
		$resultback = $this->resultback;
		try {
			
			$ip = $data_visitor['ip'];
			$visitor_id = null;
			$this->db->where('ip', $ip);
			$visitor_query = $this->db->get('visitor');
			
			if ($visitor_query->num_rows() == 0) {
				$this->db->insert('visitor', $data_visitor);
				$visitor_id = $this->db->insert_id();
			}else {
				$visitor = $visitor_query->row_array();
				$visitor_id = $visitor['id'];
			}
			
			foreach ($data_answers as $key => $data_answer) {
				$data_answers[$key]['visitor_id'] = $visitor_id;
			}
			
			$this->db->insert_batch('answer', $data_answers);
			
			$resultback->setCM($resultback::success, '提交问卷成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, $e->getMessage());
		}
		
		return $resultback->getCM();
	}
	
	public function is_submit($id) {
		$ip = $_SERVER['REMOTE_ADDR' ];
		$this->db->where('ip', $ip);
		$visitor_query = $this->db->get('visitor');
		$visitor = $visitor_query->row_array();
		$this->db->where('visitor_id', $visitor['id']);
		$this->db->where('topic_id', $id);
		$query = $this->db->get('answer');
		if ($query->num_rows() > 0) {
			return self::is_submit;
		}
		return self::isn_submit;
	}
	
	public function get_question_stat($question_id, $type) {
		$result = null;
		try {
			//获取问题总记录
			$this->db->where('question_id', $question_id);
			$question_answer_query = $this->db->get('answer');
			$total = $question_answer_query->num_rows();
			
			
			if ($type == 3) {
				$this->db->where('question_id', $question_id);
				$this->db->where('option_id', 0);
				$option_answer_query = $this->db->get('answer');
				$option_false_num = $option_answer_query->num_rows();
				
				$this->db->where('question_id', $question_id);
				$this->db->where('option_id', 1);
				$option_answer_query = $this->db->get('answer');
				$option_true_num = $option_answer_query->num_rows();
				
				$options[0]['content'] = "否";
				$options[0]['percent'] = ($total==0)?0:round($option_false_num/$total*100).'%';
				
				$options[1]['content'] = "是";
				$options[1]['percent'] = ($total==0)?0:round($option_true_num/$total*100).'%';
			}else {
			
				//获取每一个选项的记录
				$this->db->where('question_id', $question_id);
				$option_query = $this->db->get('option');
				$options = $option_query->result_array();
				foreach ($options as $key => $option) {
					$this->db->where('question_id', $question_id);
					$this->db->where('option_id', $option['id']);
					$option_answer_query = $this->db->get('answer');
					$option_num = $option_answer_query->num_rows();
					$options[$key]['percent'] = ($total==0)?0:round($option_num/$total*100).'%';
				}
			}
			$result = $options;
		} catch (Exception $e) {
			
		}

	
		return $result;
	}
	
	public function get_topic_stat($topic_id) {
		$result = null;
		try {
			$this->db->where('topic_id', $topic_id);
			$this->db->where('type !=', 4);
			$question_query = $this->db->get('question');
			$questions = $question_query->result_array();
			foreach ($questions as $key => $question) {
				
				$options = $this->get_question_stat($question['id'], $question['type']);
				$questions[$key]['options'] = $options;
				
			}
			$result = $questions;
		} catch (Exception $e) {
		}
		
	
		return $result;
	}
	
	public function get_all_visitors() {
		$this->db->select();
		$query_visitors = $this->db->get('visitor');
		return $query_visitors->result_array();
	}
	
	public function delete($id) {
		$resultback = $this->resultback;
		try {
			$this->db->delete('visitor', array('id' => $id));
			$this->db->delete('answer', array('visitor_id' => $id));
			
			$resultback->setCM($resultback::success, '删除提交者成功');
		} catch (Exception $e) {
			$resultback->setCM($resultback::error, '删除提交者失败');
		}
		
		return $resultback->getCM();
	}
}

?>