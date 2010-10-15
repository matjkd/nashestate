<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @name 		Properties Admin
 * @author 		Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */


class Properties extends MY_Controller {

	function Properties()
	{
		parent::MY_Controller();
		$this->is_logged_in();	
		$this->load->model('contacts_model');
		$this->load->model('properties_model');
		$this->load->model('ajax_model');
		$this->load->model('Gallery_model');
	}
	
	function index()
	{
		redirect('admin/properties/view');
	}
	function view_sales()
	{
		$segment_active = $this->uri->segment(4);
		if($segment_active==NULL)
		{
			$segment_active=1;
		}
		$data['segment_id'] = $segment_active;
		
		$data['contact_detail'] = $this->contacts_model->get_contact($segment_active);
		foreach($data['contact_detail'] as $row):
		$data['company_id'] = $row['company_id'];
		endforeach;
		$data['contacts'] = $this->contacts_model->list_contacts();
		$data['properties'] = $this->properties_model->list_properties(1);
		//$data['left_section'] = 'admin/properties/left_property';
		//$data['left_main'] = 'admin/contacts/view_user';
		$data['right_main'] = 'admin/properties/list_properties';
		$data['page'] = 'sales';
		$data['title'] = 'Nash Homes: Properties For Sale';
		$data['heading'] = 'Properties For Sale';
		$this->load->vars($data);
		$this->load->view('admin/admin');
	}
	function view_rentals()
	{
		$segment_active = $this->uri->segment(4);
		if($segment_active==NULL)
		{
			$segment_active=1;
		}
		$data['segment_id'] = $segment_active;
		
		$data['contact_detail'] = $this->contacts_model->get_contact($segment_active);
		foreach($data['contact_detail'] as $row):
		$data['company_id'] = $row['company_id'];
		endforeach;
		$data['contacts'] = $this->contacts_model->list_contacts();
		$data['properties'] = $this->properties_model->list_properties(2);
		//$data['left_section'] = 'admin/properties/left_property';
		//$data['left_main'] = 'admin/contacts/view_user';
		$data['right_main'] = 'admin/properties/list_properties';
		$data['property_type'] = 'r';
		$data['page'] = 'rentals';
		$data['title'] = 'Nash Homes: Rental Properties';
		$data['heading'] = 'Rental Properties';
		$this->load->vars($data);
		$this->load->view('admin/admin');
	}
	function add()
	{
		$segment_active = $this->uri->segment(4);
		if($segment_active!=NULL)
		{
			$data['company'] = $this->contacts_model->get_company($segment_active);
			
		}
		$data['company_users'] = $this->contacts_model->get_users($segment_active);
		$data['property_types'] = $this->properties_model->property_types();
		$data['property_details'] = $this->properties_model->get_empty_property();
		$data['page'] = 'properties';
		$data['title'] = 'Nash Homes Rentals';
		$data['property_id'] = NULL;
		$data['right_main'] = 'admin/properties/create_property';
		$this->load->vars($data);
		$this->load->view('admin/admin');
	}
	function update($id)
	{
			
		
		$data['property_types'] = $this->ajax_model->get_property_types();
		
		$data['general_areas'] = $this->ajax_model->get_general_area();
	
		$data['property_details'] = $this->properties_model->get_property($id);
			
			foreach($data['property_details'] as $row):
			
				$data['features'] = $this->properties_model->features($row->sale_rent);
				$company_id = $row->company_id;
			endforeach;
		
		$data['assigned_features'] = $this->properties_model->list_features_property($id);
		
		$data['images'] = $this->Gallery_model->get_images($id);
		
		$data['room_table'] = $this->properties_model->get_rooms_table($id);
		$data['rooms'] =$this->properties_model->list_rooms();
		$data['additional'] = $this->properties_model->list_additional();
		$data['company_users'] = $this->contacts_model->get_users($company_id);
		$data['page'] = 'properties';
		$data['property_id'] = $id;
		$data['title'] = 'Nash Homes Edit Property';
		$data['update'] = "yes";
		$data['right_main'] = 'admin/properties/update_property';
		$this->load->vars($data);
		$this->load->view('admin/admin');
	}
	
	function create_property()
	{			
		$this->form_validation->set_rules('sale_rent','For Sale or Rent','required|max_length[45]');	
		$this->form_validation->set_rules('property_type','Property Type','required|max_length[45]');			
		$this->form_validation->set_rules('property_address1','Address1','max_length[45]');			
		$this->form_validation->set_rules('property_address2','Address2','max_length[45]');			
		$this->form_validation->set_rules('property_address3','Address3','max_length[45]');
		$this->form_validation->set_rules('property_address4','Address4','max_length[45]');
		$this->form_validation->set_rules('property_address5','Postcode','max_length[45]');
		$this->form_validation->set_rules('company_id','company_id','max_length[45]');
		$this->form_validation->set_rules('user_id','user_id','max_length[45]');
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
		
		if ($this->form_validation->run() == FALSE) // validation hasn'\t been passed
		{
			echo "failure of validation";
		}
		else // passed validation proceed to post success logic
		{
			
			$id_data = array('property_name' => set_value('property_type'));
			$sale_rent = set_value('sale_rent');
			// If user enters id it must remove any letters if they've added them
			// It must then check if they selected sale or rent, if rent add R at the start
			// It must then check if the ID already exists
			// if not create it and  skip the id creation process
			
			$add_id = $this->input->post('property_ref');
			$user_id =  $this->input->post('user_id');
			
			if($add_id > 0)
			{
				
				//remove letters from $add_id
				$id_result = preg_replace("/\D/","",$add_id);
				
				//if Rental property, add an R at the beginning
				if($sale_rent==2)
						{
							$id_result = "R".$id_result."";
							
						}
						else
						{
							
						}
				
				//check if $id_result already exists
				$check = $this->properties_model->check_id($id_result);
				
				
					if($check == 1)
					{
					$this->session->set_flashdata('message', 'ID exists '.$check.'  '.$id_result.'');
					redirect('admin/properties/add/'.$user_id.'', 'refresh');
					}
				
				
				$ref = $id_result;
				
			}
			
			else
			
			{
		
			if($sale_rent==2)
				{
					$this->properties_model->create_property_id('rental_id', $id_data);
					$ref = "R".$this->db->insert_id()."";
				}
			else
				{
					$this->properties_model->create_property_id('sale_id', $id_data);
					$ref = $this->db->insert_id();
				}
				
			$this->properties_model->create_sales_data($ref);
			}
			// build array for the model
			$form_data = array(
							'property_ref_no' => $ref,
					       	'property_type' => set_value('property_type'),
							'company_id' => set_value('company_id'),
					       	'property_address1' => set_value('property_address1'),
					       	'property_address2' => set_value('property_address2'),
					       	'property_address3' => set_value('property_address3'),
							'property_address4' => set_value('property_address4'),
							'property_address5' => set_value('property_address5'),
							'sale_rent' => set_value('sale_rent'),
							'user_id' => set_value('user_id')
						);
					
			// run insert model to write data to db
		
			if ($this->properties_model->create_property($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				
				
				$id = $this->db->insert_id();
				
				$config['hostname'] = '213.229.86.110';
				$config['username'] = 'nh001';
				$config['password'] = 'l33t523';
				$config['debug'] = TRUE;
				$this->ftp->connect($config);
				$this->ftp->mkdir('/public_html/images/properties/'.$ref.'/');
				$this->ftp->mkdir('/public_html/images/properties/'.$ref.'/thumbs/');
				$this->ftp->mkdir('/public_html/images/properties/'.$ref.'/medium/');
				$this->ftp->mkdir('/public_html/images/properties/'.$ref.'/large/');
				$this->ftp->close();
				
				redirect('admin/properties/update/'.$ref.'#tabs-1');   // or whatever logic needs to occur
			}
			else
			{
			echo 'An error occurred saving your information. Please try again later';
			// Or whatever error handling is necessary
			}
		}
	}
	
	function update_property1()
	{
		
		$id = $this->input->post('property_id');
		$this->properties_model->update_property1(); 
		
		redirect('admin/properties/update/'.$id.'/#tabs-1');  
		
	}
	function update_property2($id)
	{
		
		
		$this->properties_model->update_property2($id); 
		
		redirect('admin/properties/update/'.$id.'/#tabs-2');  
		
	}
	
	function delete_property($id)
	{
		
	}
	
	function upload_image()
	{
		
		$id = $this->input->post('id');
		if($this->input->post('upload'))
		{
			$this->Gallery_model->do_upload($id);
		}
		
		
		
		redirect('admin/properties/update/'.$id.'#tabs-3');   // or whatever logic needs to occur
		
	}
	function editable_property1()
	{
	
		
		
		$data['id'] = $this->input->post('id');
		$data['field'] = $this->input->post('elementid');
		$data['value'] = $this->input->post('value');
		$this->properties_model->edit_property1($data['id'], $data['field'], $data['value']);
		
		$update = $this->input->post('value');
		
		if($data['field'] == 'property_type')
		{
						
			$data['data'] = $this->properties_model->get_property_type($data['value']);
			
			foreach($data['data'] as  $row2):
					$update = $row2['property_type_name'];
			endforeach;	
		
		}
		if($data['field'] == 'general_area')
		{
						
			$data['data'] = $this->properties_model->get_general_area($data['value']);
			
			foreach($data['data'] as  $row2):
					$update = $row2['area'];
			endforeach;	
		
		}
		if($data['field'] == 'user_id')
		{
						
			$data['data'] = $this->contacts_model->get_contact($data['value']);
			
			foreach($data['data'] as  $row2):
					$update = "".$row2['firstname']." ".$row2['lastname']."";
			endforeach;	
		
		}
		
		if($data['field'] == 'active')
		{
						
			if($data['value'] == 0 ) {$update = 'No';}
					
			if($data['value'] == 1 ) {$update = 'Yes';}
		
		}
		
		
		$this->output->set_output($update);
	}
	
	function editable_salesdata()
	{
		$data['id'] = $this->input->post('id');
		$data['field'] = $this->input->post('elementid');
		$data['value'] = $this->input->post('value');
		$this->properties_model->edit_sales_data($data['id'], $data['field'], $data['value']);
		
		$update = $this->input->post('value');
		
						
		if($data['value'] == 0 ) {$update = 'No';}
					
		if($data['value'] == 1 ) {$update = 'Yes';}
		
				
		$this->output->set_output($update);
	}
function rooms_add_row($id)
	{
		$this->properties_model->room_insert_row($id);
		$data['room_table'] = $this->properties_model->get_rooms_table($id);
		$data['rooms'] =$this->properties_model->list_rooms();
		$data['additional'] = $this->properties_model->list_additional();
		$this->load->vars($data);
		$this->load->view('admin/properties/room_table');
	}
function delete_room()
	{
		$id = $this->input->post('id');
		$this->properties_model->delete_room_row($id);
	}
	
function rooms_table()
	{
		$data['id'] = $this->uri->segment(4);
		
		$data['room_table'] = $this->properties_model->get_rooms_table($data['id']);
		$data['rooms'] =$this->properties_model->list_rooms();
		$data['additional'] = $this->properties_model->list_additional();
		$this->load->vars($data);
		$this->load->view('admin/properties/room_table');
	}
	function edit_room_table()
	{
		$data['id'] = $this->input->post('id');
		$data['field'] = $this->input->post('elementid');
		$data['value'] = $this->input->post('value');
		$this->properties_model->edit_room($data['id'], $data['field'], $data['value']);
		$update = $this->input->post('value');
		
		if($data['field'] == 'room_type')
		{
						
			$data['data'] = $this->properties_model->get_room_type($data['value']);
			
			foreach($data['data'] as  $row2):
					$update = $row2['room_name'];
			endforeach;	
		
		}
		if($data['field'] == 'room_additional')
		{
						
			$data['data'] = $this->properties_model->get_additional_type($data['value']);
			
			foreach($data['data'] as  $row2):
					$update = $row2['additional'];
			endforeach;	
		
		}
		
		
		$this->output->set_output($update);
	}
	function add_feature()
	{
	$segment_active = $this->uri->segment(4);
		if($segment_active==NULL)
		{
			redirect('welcome', 'refresh');
		}
		else
		{
			$this->properties_model->add_feature($segment_active);
			
			redirect('admin/properties/update/'.$segment_active.'#tabs-2');   
		}
	}
	function delete_property_feature($id)
	{
	
	$data['property_id'] = $this->properties_model->delete_assigned_feature($id);
	foreach($data['property_id'] as $key => $row):
	$property = $row['property_id'];
	endforeach;
	
	redirect('admin/properties/update/'.$property.'#tabs-2', 'refresh');
	
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

/* End of file properties.php */
/* Location: ./system/application/controllers/admin/properties.php */