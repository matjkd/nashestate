<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();	
		$this->load->model('contacts_model');
		$this->load->model('properties_model');
		$this->load->model('ajax_model');
	}
	
	function index()
	{
		redirect('admin/contacts/details');
	}
	function details()
	{
		
		
		$segment_active = $this->uri->segment(4);
		if ($segment_active!=NULL)
			{
				$data['user_id'] = $this->uri->segment(4);
			}
		else
			{
				$data['user_id'] = $this->session->userdata('user_id');
			}
		
		//set variable for what table to view for contact details
		$data['contact_table'] = "contactconfirm";
		$data['add_contact_table'] = "contact_detail_table";
		$data['address_table'] = "address_table";
		$data['update_id'] = $data['user_id'];
		$data['segment_id'] = $segment_active;
		$data['data'] = $this->ajax_model->get_nationalities();
		$data['contact_detail'] = $this->contacts_model->get_contact($data['user_id']);
			
			foreach($data['contact_detail'] as $row):
				
				$data['company_id'] = $row['company_id'];
			$data['company_name'] = $row['company_name'];
				$data['user_name'] = "".$row['firstname']." ".$row['lastname']."";
			endforeach;
		$id = $data['company_id'];	
		
		$data['contacts'] = $this->contacts_model->list_contacts();
		
		$data['addresses'] = $this->contacts_model->get_addresses($data['user_id'], 'company_userid');
		
		$data['contact_details'] = $this->contacts_model->get_contact_details($data['user_id'], 'company_userid');
		
		$data['properties'] = $this->properties_model->get_contact_properties($data['user_id'], 'user_id');
		
		$data['left_section'] = 'admin/contacts/left_users';
		
		$data['left_main'] = 'admin/contacts/view_user';
		
		$data['right_main'] = 'admin/contacts/list_users';
		
		$data['page'] = 'contacts';
		
		$data['title'] = 'Nash Homes Contacts';
		
		$data['heading'] = 'Individual Details';
		
		$this->load->vars($data);
		
		$this->load->view('admin/admin');
	}
function view_company()
	{
		
		
		$segment_active = $this->uri->segment(4);
		if ($segment_active!=NULL)
			{
				$data['company_id'] = $this->uri->segment(4);
			}
		else
			{
				$data['company_id'] = $this->session->userdata('company_id');
			}
		
		
		$data['segment_id'] = $segment_active;
		//set variable for what table to view for contact details
		$data['contact_table'] = "companycontactconfirm";
		$data['add_contact_table'] = "company_contact_detail_table";
		$data['address_table'] = "company_address_table";
		$data['update_id'] = $data['company_id'];
		
		$data['data'] = $this->ajax_model->get_nationalities();
		$data['contact_detail'] = $this->contacts_model->get_company($data['company_id']);
			
			foreach($data['contact_detail'] as $row):
				
				$data['user_id'] = NULL;
				$data['company_name'] = $row['company_name'];
			endforeach;
		$id = $data['company_id'];	
		
		$data['contacts'] = $this->contacts_model->list_contacts();
		$data['addresses'] = $this->contacts_model->get_addresses($id, 'company_id');
		
		$data['contact_details'] = $this->contacts_model->get_contact_details($id, 'company_id');
		$data['properties'] = $this->properties_model->get_contact_properties($id, 'company_id');
		
		$data['company_users'] =  $this->contacts_model->get_company_users($id);
		
		$data['left_section'] = 'admin/contacts/left_company';
		$data['left_main'] = 'admin/contacts/view_user';
		$data['right_main'] = 'admin/contacts/list_users';
		$data['page'] = 'contacts';
		$data['title'] = 'Nash Homes Contacts';
			$data['heading'] = 'Group Details';
		$this->load->vars($data);
		$this->load->view('admin/admin');
	}
	
	
	function edit_user()
	{
		
	
		$data['user_id'] = $this->input->post('id');
		$data['field'] = $this->input->post('elementid');
		$data['value'] = $this->input->post('value');
		$this->contacts_model->edit_user($data['user_id'], $data['field'], $data['value']);
		$update = $this->input->post('value');
		$this->output->set_output($update);
		
		
	}
	function edit_company()
	{
		$data['company_id'] = $this->input->post('id');
		$data['field'] = $this->input->post('elementid');
		$data['value'] = $this->input->post('value');
		$this->contacts_model->edit_company($data['company_id'], $data['field'], $data['value']);
		$update = $this->input->post('value');
		$this->output->set_output($update);
				
	}
	function edit_address()
	{
		$data['address_id'] = $this->input->post('id');
		$data['field'] = $this->input->post('elementid');
		$data['value'] = $this->input->post('value');
		$this->contacts_model->edit_address($data['address_id'], $data['field'], $data['value']);
		$update = $this->input->post('value');
		$this->output->set_output($update);
				
	}
	function edit_contact_detail()
	{
		$data['contact_id'] = $this->input->post('id');
		$data['field'] = $this->input->post('elementid');
		$data['value'] = $this->input->post('value');
		$this->contacts_model->edit_contact_detail($data['contact_id'], $data['field'], $data['value']);
		$update = $this->input->post('value');
		$this->output->set_output($update);
				
	}
	function create_user()
	{
		$this->contacts_model->add_user();
	}
	function create_address()
	{
				
			$this->contacts_model->add_address();
			
	}
	function create_contact_detail()
	{
				
			$this->contacts_model->add_contact_detail();
			
	}
	function quick_add_company()
	{
		$this->form_validation->set_rules('company_name', 'company_name', 'trim|required');
		if($this->form_validation->run() == FALSE)
			{
			$this->session->set_flashdata('message', 'Nothing was entered');
			redirect('/admin/contacts/view_company');
			}
				
				
				
				
				$companydata['company_id'] = $this->contacts_model->add_company();
				
				foreach($companydata['company_id'] as $row2):
				$company_id = $row2['company_id'];
				endforeach;
				
				
				
				
				$this->session->set_flashdata('message', 'New Company Created');
				redirect('admin/contacts/view_company/'.$company_id);
	}
	
	function quick_add_user()
	{
		$this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
		$this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
		
		if($this->form_validation->run() == FALSE)
			{
			$this->session->set_flashdata('message', 'Enter a Firstname and Lastname');
			redirect('/admin/contacts/view_company');
			}
			
			// Create the company called N/A
			
			$companydata['company_id'] = $this->contacts_model->add_company();
				
				foreach($companydata['company_id'] as $row2):
				$company_id = $row2['company_id'];
				endforeach;
			
			// Add the user to above company
			$newuserdata['user_id'] = $this->contacts_model->quick_add_user($company_id);	
				foreach($newuserdata['user_id'] as $row3):
				$user_id = $row3['user_id'];
				endforeach;
			
			$this->session->set_flashdata('message', 'New Person Created');
			redirect('admin/contacts/details/'.$user_id);
	}
	
	function address_table()
	{
		
		$segment_active = $this->uri->segment(4);
		if ($segment_active!=NULL)
			{
				$data['user_id'] = $this->uri->segment(4);
			}
		else
			{
				$data['user_id'] = $this->session->userdata('user_id');
				
			}
		$user_id = $data['user_id'];
		
		//set variable for what table to view for contact details
		$data['contact_table'] = "contactconfirm";
		$data['add_contact_table'] = "contact_detail_table";
		$data['address_table'] = "address_table";
		
		$data['contact_detail'] = $this->contacts_model->get_contact($segment_active);
			
			foreach($data['contact_detail'] as $row):
				
				$data['company_id'] = $row['company_id'];
			
			endforeach;
		
		$id = $data['company_id'];	
		$data['addresses'] = $this->contacts_model->get_addresses($id, 'company_userid');
		if ($data['addresses'] == NULL)
			{
			$data['addresses'] = NULL; 
			}
		$this->load->vars($data);
		$this->load->view('admin/contacts/addresses');
	}
	
	function company_address_table()
	{
		
		$segment_active = $this->uri->segment(4);
			if ($segment_active!=NULL)
				{
					$data['company_id'] = $this->uri->segment(4);
				}
			else
				{
					$data['company_id'] = $this->session->userdata('company_id');
				}
		
		$data['segment_id'] = $segment_active;
		
		//set variable for what table to view for contact details
		$data['contact_table'] = "companycontactconfirm";
		$data['add_contact_table'] = "company_contact_detail_table";
		$data['address_table'] = "company_address_table";
		
		
		$data['data'] = $this->ajax_model->get_nationalities();
		$data['contact_detail'] = $this->contacts_model->get_company($data['company_id']);
			
			foreach($data['contact_detail'] as $row):
				
				$data['user_id'] = $row['company_id'];
			
			endforeach;
		$id = $data['company_id'];	
		
			
		$data['addresses'] = $this->contacts_model->get_addresses($id, 'company_id');
		if ($data['addresses'] == NULL)
			{
			$data['addresses'] = NULL; 
			}
		$this->load->vars($data);
		$this->load->view('admin/contacts/addresses');
	}
	
	function contact_detail_table()
	{
		
		$segment_active = $this->uri->segment(4);
		if ($segment_active!=NULL)
			{
				$data['user_id'] = $this->uri->segment(4);
			}
		else
			{
				$data['user_id'] = $this->session->userdata('user_id');
				
			}
			
			
		$user_id = $data['user_id'];
		//set variable for what table to view for contact details
		$data['contact_table'] = "contactconfirm";
		$data['add_contact_table'] = "contact_detail_table";
		$data['update_id'] = $data['user_id'];
		
		
		$data['contact_detail'] = $this->contacts_model->get_contact($segment_active);
			
			foreach($data['contact_detail'] as $row):
				
				$data['company_id'] = $row['user_id'];
			
			endforeach;
		
		$id = $data['user_id'];	

		$data['contact_details'] = $this->contacts_model->get_contact_details($data['user_id'], 'company_userid');
		if ($data['contact_details'] == NULL)
			{
			$data['contact_details'] = NULL; 
			}
		$this->load->vars($data);
		$this->load->view('admin/contacts/contacts');
	}
	
function company_contact_detail_table()
	{
		
		
		$segment_active = $this->uri->segment(4);
			if ($segment_active!=NULL)
				{
					$data['company_id'] = $this->uri->segment(4);
				}
			else
				{
					$data['company_id'] = $this->session->userdata('company_id');
				}
		
		$data['segment_id'] = $segment_active;
		//set variable for what table to view for contact details
		$data['contact_table'] = "companycontactconfirm";
		$data['add_contact_table'] = "company_contact_detail_table";
		
		
		
		$data['data'] = $this->ajax_model->get_nationalities();
		$data['contact_detail'] = $this->contacts_model->get_company($data['company_id']);
			
			foreach($data['contact_detail'] as $row):
				
				$data['user_id'] = $row['company_id'];
			
			endforeach;
		$id = $data['company_id'];	
		
		$data['contact_details'] = $this->contacts_model->get_contact_details($id, 'company_id');
		if ($data['contact_details'] == NULL)
			{
			$data['contact_details'] = NULL; 
			}
		$this->load->vars($data);
		$this->load->view('admin/contacts/contacts');
	}

function user_detail_table()
	{
		
		
		$segment_active = $this->uri->segment(4);
			if ($segment_active!=NULL)
				{
					$data['company_id'] = $this->uri->segment(4);
				}
			else
				{
					$data['company_id'] = $this->session->userdata('company_id');
				}
		
		$data['segment_id'] = $segment_active;
		$data['data'] = $this->ajax_model->get_nationalities();
		$data['contact_detail'] = $this->contacts_model->get_company($data['company_id']);
			
			foreach($data['contact_detail'] as $row):
				
				$data['user_id'] = $row['company_id'];
			
			endforeach;
		$id = $data['company_id'];	
		$data['company_users'] =  $this->contacts_model->get_company_users($id);
		$data['contact_details'] = $this->contacts_model->get_contact_details($id, 'company_id');
		if ($data['contact_details'] == NULL)
			{
			$data['contact_details'] = NULL; 
			}
		$this->load->vars($data);
		$this->load->view('admin/contacts/users_list');
	}
	
	function delete_address()
	{
		$id = $this->input->post('id');
		$this->contacts_model->delete_address($id); 
		
	}
	function delete_contact_detail()
	{
		$id = $this->input->post('id');
		$this->contacts_model->delete_contact_detail($id); 
		
	}
	function delete_user($id)
	{
		
		$this->contacts_model->delete_user($id); 
		redirect('admin/contacts/details');
	}
	
	function delete_group($id)
	{
			
		$data['properties'] = $this->properties_model->get_contact_properties($id, 'company_id');
		
		$data['company_users'] =  $this->contacts_model->get_company_users($id);
		
		$data['right_main'] = 'admin/contacts/delete_group';
		
		$data['page'] = 'contacts';
		
		$data['title'] = 'Nash Homes Groups';
		
		$data['heading'] = 'Delete Group';
		
		$this->load->vars($data);
		$this->load->view('admin/admin');
		
	}
	
	function delete_company()
	{
		$id = $this->input->post('id');
	}
	function view_address()
	{
		$segment_active = $this->uri->segment(4);
		$data['address'] = $this->contacts_model->get_address($segment_active); 
		
		 
		$data['address_id'] = $segment_active;
		
		$data['main'] = '/user/logged_in_area';
		
		
		
		
		$this->load->vars($data);
		$this->load->view('/admin/contacts/edit_address');
	}
	function view_contact_detail()
	{
		$segment_active = $this->uri->segment(4);
		$data['contact_detail'] = $this->contacts_model->get_contact_detail($segment_active); 
		
		 
		$data['contact_id'] = $segment_active;
		
		$data['main'] = '/user/logged_in_area';
		
		
		
		
		$this->load->vars($data);
		$this->load->view('/admin/contacts/edit_contact_detail');
	}	

	function make_main_user()
	{
		$company = $this->uri->segment(4);
		$user = $this->uri->segment(5);
		$this->contacts_model->make_main_user($user, $company);
		redirect('admin/contacts/view_company/'.$company);
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		$role = $this->session->userdata('role');
		if(!isset($is_logged_in) || $role != 1)
		{
			$this->session->set_flashdata('message', 'You are not logged in');
			redirect('welcome', 'refresh');
                       
		}	
			
	}	
}

/* End of file contacts.php */
/* Location: ./system/application/controllers/welcome.php */