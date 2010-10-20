<?php
class Login extends MY_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('encrypt', 'form_validation'));
		
	}
	
	
	function index()
	{
		$this->is_logged_in();
			
		$data['page'] = '';	
		$data['main'] = 'admin/main';
		$title = "Welcome to Nash Homes Administration Area";
					
		
		$data['title'] = 'Login';
		
		$this->load->vars($data);
		$this->load->view('template');
		
	}
	function validate_credentials()
	{		
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();
		
		if($query) // if the user's credentials validated...
		{
			
			
			$this->db->where('username', $this->input->post('username'));
			$query2 = $this->db->get('users');
			if($query2->num_rows == 1)
			{
				foreach($query2->result() as $row)
					{
						$role_level = $row->role;
						$user_id = $row->user_id;
						$user_firstname = $row->firstname;
						$user_lastname = $row->lastname;
						$company_id = $row->company_id;
					}
			}
			
			$data = array(
				'username' => $this->input->post('username'),
				'role' => $role_level,
				'user_id' => $user_id,
				'company_id' => $company_id,
				'firstname' => $user_firstname,
				'lastname' => $user_lastname,
				'is_logged_in' => true,
			
				
			);
			
			$this->session->set_userdata($data);
			$this->session->set_flashdata('message', "Welcome.");
			redirect('admin/contacts');
		}
		else // incorrect username or password
		{
		$this->session->set_flashdata('message', "<strong>Alert:</strong> Login Failed.");
		redirect('welcome/');
			
			
		}
	}	
	
	function register()
	{
		$data['main'] = '/user/register';
		$this->load->vars($data);
		$this->load->view('template');
		//$this->template->load('template', 'user/register');
	}
	
	function create_member()
	{
		
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('firstname', 'Name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		
		
		if($this->form_validation->run() == FALSE)
		{
			$data['main'] = 'user/register';
		$this->load->vars($data);
		$this->load->view('template');
			//$this->template->load('template', 'user/register');
		}
		
		else
		{			
			$this->load->model('membership_model');
			
			if($query = $this->membership_model->create_member())
			{
				$data['main'] = 'user/signup_successful';
		$this->load->vars($data);
		$this->load->view('template');
				//$this->template->load('template', 'user/signup_successful');
			}
			else
			{
				$data['main'] = 'user/register';
		$this->load->vars($data);
		$this->load->view('template');
				//$this->template->load('template', 'user/register');		
			}
		}
		
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in == true)
		{
			redirect($this->uri->uri_string());
		}		
		$this->index();
	}
	
	
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in == true)
		{
			redirect('welcome/');
		}		
	}	

}


	

/* End of file login.php */
/* Location: ./system/application/controllers/user/login.php */