<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function Dashboard()
	{
		parent::MY_Controller();
		$this->is_logged_in();	
		$this->load->model('contacts_model');
	}
	
	function index()
	{
		$data['right_main'] = 'admin/dashboard';
		$data['page'] = 'admin';
		$data['title'] = 'Nash Homes Administration';
		$this->load->vars($data);
		$this->load->view('admin/admin');
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$role = $this->session->userdata('role');
		if(!isset($is_logged_in) || $role != 1)
		{
			$data['message'] = "You are not logged in";
			redirect('welcome', 'refresh');
                       
		}	
			
	}	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */