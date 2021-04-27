
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @name 	xml controller
 * @author 	 Mat Sadler - Redstudio Design Limited
 * @package 	Nash Estate Agents
 * @subpackage 	Controllers
 */
class xml extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ajax_model');
        $this->load->model('search_model');
	$this->load->model('properties_model');
        $this->load->library('pagination');
        $this->load->model('gallery_model');
		
    }

    function index() {
        redirect('/xml/content');
    }

    /**
     * 
     */
    function content() {

        $data['search_type'] = 3;
        $data['title'] = "searchpage";
        $data['page'] = "search";
        $data['menu'] = $this->content_model->get_menus();
        $data['main_text'] = "searchpage";
        $data['content'] = "search/search_list";
        $data['general_areas'] = $this->ajax_model->get_general_area();
        $data['area_groups'] = $this->ajax_model->get_area_groups();
        
        
        // store the search data, unless it is already stored
        if($this->input->post('location') == NULL) {
            
           $area = $this->session->userdata('area');
        $data['search_type'] = $this->session->userdata('search_type');
            
        } else {
            
            
           $storedsearch = array(
               'search_type' => 3,
              'area' => $this->input->post('location') 
              );
      $this->session->set_userdata($storedsearch);
      $area = $this->input->post('location');
            
        }
            
           
            
       
       
        
     




        // Deal with data sent from search form
        $data['beds'] = $this->input->post('beds');
        $data['maxbeds'] = $this->input->post('maxbeds');

        if ($data['maxbeds'] <= $data['beds']) {
            $data['maxbeds'] = 999;
        }

        $data['buyfrom'] = $this->input->post('buyfrom');
        $data['buyto'] = $this->input->post('buyto');


        $data['rentfrom'] = $this->input->post('rentfrom');
        $data['rentto'] = $this->input->post('rentto');


        // location, and if selected find out what group OR groups it is in
        //if($this->input->post('location')==NULL){
        //    $area = $this->session->userdata('area');
       // } else {
       // $area = $this->input->post('location');
      // }
        $group = $this->search_model->find_group($area);



        // Search Both rent and purchase with no limit on price
        if ($data['rentto'] == 0 && $data['buyto'] == 0) {
            $data['list'] = 'both unlimited';
            $data['search_desc'] = "All properties";
           
            
            if ($area != "any") {
                $data['nearby'] = $this->search_model->search_sales(0, 0, $data['beds'], $data['maxbeds'], $area, 1);
               
                $data['nearbyrentals'] = $this->search_model->search_sales(0, 0, $data['beds'], $data['maxbeds'], $area, 1);
            }
            
            $data['properties'] = $this->search_model->search_sales(0, 0, $data['beds'], $data['maxbeds'], $area, 0);
             
            $data['rentals'] = $this->search_model->search_rentals(0, 0, $data['beds'], $data['maxbeds'], $area, 0);
            
        
        }
        // Purchase Only
        if ($data['search_type'] == 1) {
            $data['list'] = 'purchase only';
           // $data['search_desc'] = "Properties for Sale between " . number_format($data['buyfrom']) . "&euro; and " . number_format($data['buyto']) . "&euro;";
             $data['search_desc'] = "Properties for Sale";
            $data['properties'] = $this->search_model->search_sales($data['buyfrom'], $data['buyto'], $data['beds'], $data['maxbeds'], $area, 0);
            
            if ($area != "any") {
                $data['nearby'] = $this->search_model->search_sales($data['buyfrom'], $data['buyto'], $data['beds'], $data['maxbeds'], $area, 1);
            }
            $data['rentals'] = NULL;
        }

        // Rent Only
        if ($data['search_type'] == 2) {
            $data['list'] = 'rent only';
            //$data['search_desc'] = "Properties for Rent between " . number_format($data['rentfrom']) . "&euro; and " . number_format($data['rentto']) . "&euro; per month";
                $data['search_desc'] = "Properties for Rent";
            $data['rentals'] = $this->search_model->search_rentals($data['rentfrom'], $data['rentto'], $data['beds'], $data['maxbeds'], $area, 0);
            if ($area != "any") {
                $data['nearbyrentals'] = $this->search_model->search_rentals($data['rentfrom'], $data['rentto'], $data['beds'], $data['maxbeds'], $area, 1);
            }
            $data['properties'] = NULL;
        }

        // Search Both rental and purchase limited by price
        if ($data['search_type'] == 3) {
       //  if ($data['rentto'] > 0 && $data['buyto'] > 0) {
            $data['list'] = 'both limited';
            //$data['search_desc'] = "Properties for Sale between " . number_format($data['buyfrom']) . "&euro; and " . number_format($data['buyto']) . "&euro; and for Rent between " . number_format($data['rentfrom']) . "&euro; and " . number_format($data['rentto']) . "&euro; per month";
            $data['search_desc'] = "Properties for Sale and Rent";
            $data['properties'] = $this->search_model->search_sales($data['buyfrom'], $data['buyto'], $data['beds'], $data['maxbeds'], $area, 0);
            $data['rentals'] = $this->search_model->search_rentals($data['rentfrom'], $data['rentto'], $data['beds'], $data['maxbeds'], $area, 0);
            if ($area != "any") {
                $data['nearby'] = $this->search_model->search_sales($data['buyfrom'], $data['buyto'], $data['beds'], $data['maxbeds'], $area, 1);
                $data['nearbyrentals'] = $this->search_model->search_rentals($data['rentfrom'], $data['rentto'], $data['beds'], $data['maxbeds'], $area, 1);
            }
        // }
        }


        //convert rental period to something that works

        $data['rental_period'] = "month";

        //get property of the week
        if ($data['search_type']  == 2) {
            $data['featured_property'] = $this->properties_model->get_featured_rental();
            
        } else {
            $data['featured_property'] = $this->properties_model->get_featured_property();
        }
        
        //get property of the week images
        
         if($data['featured_property'] != NULL){
        foreach($data['featured_property'] as $row):
            $featuredpropertyid = $row['property_id'];
            $data['featured_images'] = $this->gallery_model->get_property_images($featuredpropertyid);
            
        endforeach;
         }
        
        	$data['references'] = $this->content_model->get_testimonials();
       
	    
	    // Load Template
        $data['rentals'] = $this->search_model->search_rentals($data['rentfrom'], $data['rentto'], $data['beds'], $data['maxbeds'], $area, 0);
	    $this->load->vars($data);
	    
	$xml = '<root>';

  $xml .= '<item>
             <name>test</name>
             <price>test</price>
             <image>test</image>
           </item>';

$xml .= '</root>';

	    header('Content-type: text/xml');
//	    $this->output->set_content_type('text/xml');
//$this->output->set_output($xml);  
	    
$this->load->view('template/standard/xmlfeed');	    
	    
    }

	function feed() {
		
	$data['properties'] = $this->search_model->search_sales(0, 99999999999, 0, 999, NULL, 0);
	$data['rentals'] = $this->search_model->search_rentals(0, 99999999999, 9, 999, NULL, 0);
	    $this->load->vars($data);
		 header('Content-type: text/xml');
		
		echo "<root>
				<kyero>
			    		<feed_version>3</feed_version>
			        </kyero>
				    
	   	";
		
		
		
		foreach($data['properties'] as $row):
		echo "<property>";
			$id = $row['property_ref_no'];
		echo "<id>".$id."</id>";
		if($row['date_updated'] == NULL || $row['date_updated'] == 0) {
			$date = 1619444163;}
		else {
		$date =	$row['date_of_instruction'];
		}
		
		$propertydata['property_details'] = $this->properties_model->get_active_property($id);

		echo "<date>".date('Y-m-d h:i:s', $date)."</date>";
		echo "<ref>".$id."</ref>";
		echo "<price>".INTVAL($row['sale_price'])."</price>";
		echo "<price_freq>sale</price_freq>";
		echo "<currency>EUR</currency>";
		echo "<part_ownership>0</part_ownership>";
		echo "<new_build>0</new_build>";
		echo "<leasehold>0</leasehold>";
		
		 foreach($propertydata['property_details'] as $propertyDetails):
		echo "<type>".$propertyDetails->property_type_name."</type>";
		echo "<province>".$propertyDetails->area."</province>";
	echo $propertyDetails->general_area_id;
		endforeach;
		
		echo "<town>Test place</town>";
		echo "<location>
		<latitude>0</latitude>
		<longitude>0</longitude>
		
		</location>";
		echo "<location_detail></location_detail>";
		
		
		
		echo "<country>spain</country>";
		
		// echo "<video_url></video_url>";
		// echo "<virtual_tour_url></virtual_tour_url>";
		// echo "<catastral>0</catastral>";
				echo "<notes>0</notes>";
		echo "<prime>0</prime>";
		
		echo "<desc>";
		$description = str_replace('&nbsp;', '', $row['description']);
		$description = str_replace('&#160;', '', $description);
		$description = str_replace('&', 'and', $description);
		echo "<en>".strip_tags($description)."</en>";
		echo "</desc>";
		
		
		
		
			         
        		//if property is returned, load other details
			if ($propertydata['property_details']) {
			    $propertydata['property_rooms'] = $this->properties_model->get_rooms_table($id);
			    $propertydata['property_images'] = $this->gallery_model->get_property_images($id);
			    $propertydata['property_features'] = $this->properties_model->get_assigned_features($id);
			    $propertydata['property_id'] = $id;
			echo "<features>";	
			foreach( $propertydata['property_features'] as $featureRow):
			
				if($featureRow['features']){
					$feature = str_replace('&', 'and', $featureRow['features']);
				echo "<feature>".$feature."</feature>";
				}
				
				endforeach;
			echo "</features>";
				
			$imageCount = 0;	
				echo "<images>";
		foreach($propertydata['property_images'] as $imagedata):
				
		$imagefilename = "images/properties/".$imagedata->property_id."/large/".$imagedata->filename;
           if(file_exists($imagefilename)){
              
               $filelocation = "/large/".$imagedata->filename;
           } else {
               $filelocation = "/medium/".$imagedata->filename;
           }
           $localimage = "images/properties/".$imagedata->property_id.$filelocation;
	  $baselocalimage = base_url().$localimage;
		
		if(file_exists($localimage)){
			
		$theImage = $baselocalimage;
		$imageBase = base_url()."images/properties/";
		
		} else {
			
		
			$checklarge = "https://nashhomes.s3-eu-west-1.amazonaws.com/properties/".$imagedata->property_id."/large/".$imagedata->filename;
			
			if(file_exists($checklarge)){
			$theImage = "https://nashhomes.s3-eu-west-1.amazonaws.com/properties/".$imagedata->property_id."/large/".$imagedata->filename;
				} else {
			$theImage = "https://nashhomes.s3-eu-west-1.amazonaws.com/properties/".$imagedata->property_id."/medium/".$imagedata->filename;
		
			$imageBase = "https://nashhomes.s3-eu-west-1.amazonaws.com/properties/";
			}
		
		
		}		
				
		$imageCount = $imageCount+1;		
		echo "<image id='".$imageCount."'>";		
		echo "<url>".$theImage."</url>";
		echo "</image>";
				endforeach;
		
		echo "</images>";

			
		
		
					//rooms
				// Count Rooms
				$bedrooms = 0;
				$parking = 0;
				$bathrooms = 0;
			if($propertydata['property_rooms']){
				foreach($propertydata['property_rooms'] as $rooms):

				//Count Bedrooms
				if($rooms['room_type'] == 1)
				{
					$bedrooms = $bedrooms + 1;
				}

				//Count Parking Spaces
				if($rooms['room_type'] == 13)
				{
					$parking = $parking + 1;
				}


				//Count Bathrooms bathroom is room type 2 and en suite bathroom is room type 11
				if($rooms['room_type'] == 2 || $rooms['room_type'] == 11)
				{
					$bathrooms = $bathrooms + 1;
				}

				//get size of terrace
				if($rooms['room_type'] == 7 || $rooms['room_type'] == 8)
				{
					$terrace_size = $rooms['room_size'];
				}
				endforeach;
			}
			}
	echo "<beds>".$bedrooms."</beds>";
	echo "<baths>".$bathrooms."</baths>";
	echo "<pool></pool>";
	echo "<surface_area>
		<built>".$row['build_size']."</built>
		<plot>".$row['plot_size']."</plot>
		</surface_area>";
	
		
	//energy rating
	if($row['energy_rating'] == "A" || $row['energy_rating'] == "B" || $row['energy_rating'] == "C" || $row['energy_rating'] == "D" || $row['energy_rating'] == "E" || $row['energy_rating'] == "F" || $row['energy_rating'] == "G" || $row['energy_rating'] == "X") {
		$energyrating = $row['energy_rating'];
	} else {
		$energyrating = "X";
	
	}
		echo "<energy_rating>
		<consumption>".$energyrating."</consumption>
		</energy_rating>";
			
		
		echo "<url>
		<en>http://www.nashhomesmallorca.com/property/display/".$id."</en>
		</url>";
		
		echo "</property>";
		endforeach;
		
		echo "</root>";
		  
		
		
		
	}
	
	function feed2() {
		
	$data['properties'] = $this->search_model->search_sales(0, 99999999999, 0, 999, NULL, 0);
	$data['rentals'] = $this->search_model->search_rentals(0, 99999999999, 9, 999, NULL, 0);
	    $this->load->vars($data);
		 header('Content-type: text/xml');
		
		echo "<root>
				<kyero>
			    		<feed_version>3</feed_version>
			        </kyero>
				    <property>
				    <id>12</id>
				    </property>
	   	";
		
		
		foreach($data['properties'] as $row):
		echo "<property>";
			$id = $row['property_ref_no'];
		echo "<id>".$id."</id>";
		
			  $propertydata['property_details'] = $this->properties_model->get_active_property($id);
        
        		//if property is returned, load other details
			if ($propertydata['property_details']) {
			    $propertydata['property_rooms'] = $this->properties_model->get_rooms_table($id);
			    $propertydata['property_images'] = $this->gallery_model->get_property_images($id);
			    $propertydata['property_features'] = $this->properties_model->get_assigned_features($id);
			    $propertydata['property_id'] = $id;
				
			foreach( $propertydata['property_features'] as $featureRow):
			
				if($featureRow['features']){
					$feature = str_replace('&', 'and', $featureRow['features']);
				echo "<feature>".$feature."</feature>";
				}
				
				endforeach;
				
			}
	
		echo "<test>er</test>";
		echo "</property>";
		endforeach;
		
		echo "</root>";
		
	}
	
	
	
    /**
     * 
     */
    function property_id() {

        $this->form_validation->set_rules('property_id', 'property_id', 'trim|required');

        //need to add a check to see if property exists, or it will direct to a page with errors

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('message', 'You must enter a property id');

            redirect('/');
        }
        $id = $this->input->post('property_id');
        redirect('/property/display/' . $id);
    }

}
