<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends Controller {

	function __construct() {
	parent::Controller();
	// I shall eventually put all this into a database table, editable on an admin page
	$config_data['config_company_name'] = "Company";
	$config_data['config_address'] = "Address";
	$config_data['config_version'] = "0.0.9";
	$config_data['config_email'] = "email@email.com";
	$config_data['config_website'] = "email@email.com";
	$config_data['config_phone'] = "1234567890";
	$config_data['config_ftp_host'] = "213.229.86.110";
	$config_data['config_ftp_user'] = "nh001";
	$config_data['config_ftp_password'] = "1234567890";
	
	$this->config_email = 'email@email.com';
	$this->config_smtp_user = 'email@email.com';
	$this->config_smtp_pass = 'password';
	$this->config_company_name = 'Company;
	$this->load->vars($config_data);
	
	}
	

}