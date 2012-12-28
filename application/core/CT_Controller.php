<?php
class CT_Controller extends CI_Controller{
	
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
		
		if ($this->session->userdata('auth') == null) {
			redirect(base_url('admin/'));
		}
	}
}

?>