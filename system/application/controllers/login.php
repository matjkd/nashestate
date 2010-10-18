<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @name 		Login controller
 * @author 		Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */


class Login extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('ajax_model');	
		$this->load->model('search_model');		
		$this->load->model('properties_model');	
		$this->load->model('gallery_model');	
	}
	
}