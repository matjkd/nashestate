<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends Controller {

	function __construct() {
	parent::__construct();
	// I shall eventually put all this into a database table, editable on an admin page
	$config_data['config_company_name'] = "Nash Homes Mallorca";
	$config_data['config_company_name_short'] = "Nash Homes";
	$config_data['config_address'] = "Address";
	$config_data['config_version'] = "0.0.9";
	$config_data['config_email'] = "email@email.com";
	$config_data['config_website'] = "email@email.com";
	$config_data['config_phone'] = "+34 971 67 59 69";
	$config_data['config_ftp_host'] = "213.229.86.110";
	$config_data['config_ftp_user'] = "nh001";
	$config_data['config_ftp_password'] = "1234567890";
	
	$this->config_email = 'email@email.com';
	$this->config_smtp_user = 'email@email.com';
	$this->config_smtp_pass = 'password';
	$this->config_company_name = 'Company';
	$this->config_ftp_host = '213.229.86.110';
	$this->config_ftp_user = 'nh001';
	$this->config_ftp_password = 'l33t523';
	$this->load->vars($config_data);
	
	
	//get the max sale and rent price to put in the dropdowns in the search box.
			//This section could probably be moved somewhere so it loads automatically 
			//get highest price of property from database
			$this->load->model('properties_model');
			
			$search['max_sale'] = $this->properties_model->get_max_price('1');	
			foreach($search['max_sale'] as $row):
				
				// determines how much to round up by
				$search['saleroundup'] = 50000;
				// determines how much to increment by in dropdown
				$search['saleincrements'] = 50000;
				
				$saleroundup = 1 / $search['saleroundup'];
				$value = $row['sale_price'];
				$search['max_sale_round'] = (ceil($value * $saleroundup) / $saleroundup );
				
			endforeach;
			
			//get highest price of rental property from database
			$search['max_rent'] = $this->properties_model->get_max_price('2');	
			foreach($search['max_rent'] as $row):
				
				// determines how much to round up by
				$search['rentroundup'] = 1000;
				// determines how much to increment by in dropdown
				$search['rentincrements'] = 50;
				
				$rentroundup = 1 / $search['rentroundup'];
				$value = $row['monthly_rent'];
				$search['max_rent_round'] = (ceil($value * $rentroundup) / $rentroundup );
				
			endforeach;
			
			
				// Creates arrays for incremental sale prices and rental prices. This should be moved to a controller eventually
				
				$saleprices = array();
								
				for ($saleprice = $search['saleincrements'] ; $saleprice <= $search['max_sale_round']+1; $saleprice=$saleprice+$search['saleincrements'] ) {
					
					$saleformat = number_format($saleprice);
					$saleprices[$saleprice] = $saleformat;
					
				}
				
				$rentprices = array();
								
				for ($rentprice = $search['rentincrements']; $rentprice <= $search['max_rent_round']+1; $rentprice=$rentprice+$search['rentincrements']) {
					$rentformat = number_format($rentprice);
					$rentprices[$rentprice] = $rentformat;
					
				}
		
				$search['saleprices'] = $saleprices;
				$search['rentprices'] = $rentprices;
			
			//end of getting max prices
		$this->load->vars($search);
	
	}
	

}