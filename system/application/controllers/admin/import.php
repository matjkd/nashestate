<?php

class Import extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();	
		$this->load->model('import_model');
		$this->load->model('features_model');
		$this->load->model('properties_model');
		$this->load->model('area_model');
	}
	
	function index()
	{
		
	}
	function import_properties()
	{
		$data['old_properties'] = $this->import_model->get_old_properties();
		$data['old_areas'] = $this->import_model->get_old_areas();
		$data['list_areas'] = $this->area_model->list_areas();
		$data['title'] = "Import Properties from old site";
		//remove space at start of locations.
		//foreach($data['old_properties'] as $row):
		//$id = $row->id_property;
		//$address = trim($row->address); 
		//$this->import_model->update_address($id, $address);
 		//endforeach;
 		
		$this->load->vars($data);
		$this->load->view('admin/import/import');
	}
	
	function import_property()
	{
		//declare variables
		
		$property_id = $this->input->post('property_id');
		$active = $this->input->post('active');
		$title = $this->input->post('title');
		$property_type = $this->input->post('property_type');
		$price = $this->input->post('price');
		$build_size = $this->input->post('size');
		$plot_size = $this->input->post('plot_size');
		$description = $this->input->post('description');
		$number_of_bedrooms = $this->input->post('number_of_bedrooms');
		$number_of_bathrooms = $this->input->post('number_of_bathrooms');
		$number_of_parking = $this->input->post('number_of_parking');
		$sale_rent = $this->input->post('sale_rent');
		$sold_rented = $this->input->post('sold_rented');
		$old_area = $this->input->post('old_area');
		$view = $this->input->post('view');
		$pool = $this->input->post('pool');
		$floors = $this->input->post('floors');
		
		$area = $this->input->post('areas');
		
		//check area is selected
		$this->form_validation->set_rules('areas','areas','required');
		if ($this->form_validation->run() == FALSE) // validation hasn'\t been passed
		{
			$this->session->set_flashdata('message', 'No area was selected');
			redirect('admin/import/import_properties', 'refresh');
		}
		// if property is for sale
		if ($sale_rent == 0)
		{
			$pricetype = 'sale_price';
			$monthly = 0;
		}
		
		if ($sale_rent == 1)
		{
			$pricetype = 'sale_price';
			$monthly = 0;
		}
		
		// if property is for rent
		if ($sale_rent == 2)
		{
			$pricetype = 'rent_price';
			$monthly = $price;
		}
		
		//Check property ID exists.
		$data['check'] = $this->properties_model->get_property($property_id);
		if($data['check'])
		{
			$this->session->set_flashdata('message', 'Property '.$property_id.' is already in the database. Resolve conflict before importing.');
			redirect('admin/import/import_properties', 'refresh');
		}
		
		//Create Property
		$form_data = array(
							'property_ref_no' => $property_id,
							'active' => $active,
					       	'property_type' => $property_type,
							'company_id' => 1,
					       	'sale_rent' => $sale_rent,
							$pricetype => $price,
							'monthly_rent' => $monthly,
							'build_size' => $build_size,
							'plot_size' => $plot_size,
							'description' => $description,
							'property_title' => $title,
							'general_area' => $area,
							'old_area' => $old_area,
							'floors' => $floors,
							'sold_rented' => $sold_rented
						);
		$this->properties_model->create_property($form_data);				

		$config['hostname'] = $this->config_ftp_host;
				$config['username'] = $this->config_ftp_user;
				$config['password'] = $this->config_ftp_password;
				$config['debug'] = TRUE;
				$this->ftp->connect($config);
				$this->ftp->mkdir('/public_html/images/properties/'.$property_id.'/');
				$this->ftp->mkdir('/public_html/images/properties/'.$property_id.'/thumbs/');
				$this->ftp->mkdir('/public_html/images/properties/'.$property_id.'/medium/');
				$this->ftp->mkdir('/public_html/images/properties/'.$property_id.'/large/');
				$this->ftp->close();
		
		//import number of bedrooms
		$this->import_model->add_rooms(1, $number_of_bedrooms, $property_id);
		//import number of bathrooms
		$this->import_model->add_rooms(2, $number_of_bathrooms, $property_id);
		//import parking spaces
		$this->import_model->add_rooms(13, $number_of_parking, $property_id);
		
		
		//add features
		//add pool
		$this->features_model->add_feature($property_id, $pool);
		$this->features_model->add_feature($property_id, $view);
		
		//mark old property as imported
		$this->import_model->mark_imported($property_id);
		
	
		
		$this->session->set_flashdata('message', 'Property '.$property_id.' has been imported');
		//print_r($form_data);
		redirect('admin/import/import_properties', 'refresh');
		//
	}
	
	function images()
	{
		$data['images'] = $this->import_model->get_images();
		//foreach($data['images'] as $row):
		//$image_id = $row->Cod_img;
		//$filelocation = "../public_html/images/fotos/".$row->Foto;
		
		//$newlocationthumb = "../public_html/images/properties/".$row->id_property."/thumbs/".$row->Foto;
		
		
		
		//if(!file_exists($filelocation))
		//	{
				
		//		$this->import_model->mark_image_imported($image_id);
			
		//	}
		
		//if(file_exists($newlocationthumb))
		//	{
		//		$this->import_model->mark_image_imported($image_id);
		//	}
			
			
		
		//endforeach;
		
		
		$this->load->vars($data);
		$this->load->view('admin/import/import_images');
		
		
		
	}
	
	function convert_images()
	{
		$id = $this->input->post('property_id');
		$fullpath = $this->input->post('fullpath');
		$param1 = $this->input->post('filename');
		$image_id = $this->input->post('image_id');
		
		$filename = substr_replace($param1, '.', strrpos($param1, '_'), strlen('_'));
		
		$this->import_model->do_uploader($id, $fullpath, $filename);
		
		$this->import_model->mark_image_imported($image_id);
		redirect('admin/import/images', 'refresh');
		
	}
	function bulk_convert_images()
	{
		$data['images'] = $this->import_model->get_images();
		
		foreach($data['images'] as $row):
		
			$filelocation = "../public_html/images/fotos/".$row->Foto;
			$fullpath = "/home/nh001/public_html/images/fotos/";
			$filenamethumb = "../public_html/images/fotos/th_".$row->Foto;
			if(!file_exists($filelocation))
			{
   					if(file_exists($filenamethumb)){
  
 					$thumbfile = "th_".$row->Foto; 
	
					$id = $row->id_property;
					$fullpath = $fullpath;
					$param1 = $thumbfile;
					$image_id = $row->Cod_img;
					
					$filename = substr_replace($param1, '.', strrpos($param1, '_'), strlen('_'));
		
					$this->import_model->do_uploader($id, $fullpath, $filename);
		
					$this->import_model->mark_image_imported($image_id);
   					}
			}
			else
			{
			$id = $row->id_property;
			$fullpath = $fullpath;
			$param1 = $row->Foto;
			$image_id = $row->Cod_img;
		
		$filename = substr_replace($param1, '.', strrpos($param1, '_'), strlen('_'));
		
		$this->import_model->do_uploader($id, $fullpath, $filename);
		
		$this->import_model->mark_image_imported($image_id);
		
			}
		
		endforeach;
		
		
		
	}
	function convert_rentals()
	{
		$data['rentals'] = $this->import_model->select_rentals();
		
		foreach($data['rentals'] as $row):

		$this->import_model->change_rentals($row->property_id);

		endforeach;
		
		$this->load->vars($data);
		$this->load->view('admin/import/convert_rentals');
		
	}
	function convert_salerent()
	{
		$data['sales'] = $this->import_model->select_sales();
		
		foreach($data['sales'] as $row):

		$this->import_model->change_sales($row->property_id);

		endforeach;
		
		$data['rentals'] = $this->import_model->select_rentals();
		
		foreach($data['rentals'] as $row2):

		$this->import_model->change_rentals($row2->property_id);

		endforeach;
		
		$this->load->vars($data);
		$this->load->view('admin/import/convert_sales');
		
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