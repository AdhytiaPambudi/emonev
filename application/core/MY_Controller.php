<?php
	class MY_Controller extends CI_Controller
	{
		public $opd_id = null;
		public $redirect = null;
		public $user_id = null;
		public $is_admin = null;
		function __construct()
		{
			parent::__construct();
			if(!$this->session->has_userdata('is_admin_login'))
			{
				redirect('admin/auth/login');
			}
			$this->load->model('admin/opd_model', 'opd_model');
			$var = $this->session->userdata;
			$this->user_id = $var['user_id'];
			$this->opd_id = $var['opd'];
			$this->is_admin = $var['is_admin'];
			//$data = $this->opd_model->get_opd_by_id($var['opd']);
			//$segment1 = $this->uri->segment(1);
			//$redirect = explode("/", $data['redirect']);
			//$this->redirect = $data['redirect'];
			//if($segment1!=$redirect[0] && $segment1!='global'){
			//	redirect(base_url($data['redirect']), 'refresh');
			//}
		}
	}
?>

    