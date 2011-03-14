<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Searchbox extends Controller {

	function __construct() {
	parent::Controller();
	
	// need to get this loading automatically, it is currently also in my_controller but that is hidden by gitignore 
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