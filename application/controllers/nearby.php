<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nearby extends CI_Controller {

	public function index()
	{

		/* Helpers */
        $this->load->helper('url'); 
        $this->load->helper('date');

        $this->load->library('pagination');
        $this->load->library('session');

        $this->load->model('HotelResults');   
		
		if(isset($_COOKIE['myCoords'])) {
			$this->session->set_userdata('myCoords', $_COOKIE['myCoords']);
			$location = $this->session->get_userdata('myCoords');
			$location = $location['myCoords'];
		}

		$paginationURL = site_url("nearby");

		$myCoordsCheck = $this->session->userdata('myCoords');
		if($myCoordsCheck) {

			$url  = "http://ews.expedia.com/wsapi/rest/hotel/v1/search?";
        	$url .= "location=$location";
       		$url .= "&radius=5km";
        	$url .= "&key=7436C7B8-63A8-487E-96DF-90078411A590";
			
			if($location == $_COOKIE['myCoords']) {
	                $nbHotels = $this->HotelResults->dateless($url);
    	            $this->session->set_userdata('nbSearchresults', $nbHotels);
            	    $nbSearchresults = $this->session->userdata('nbSearchresults');

				if(!$this->aauth->is_loggedin()) {
					$db_array = '';
   		     		$db_array = array(
        	    		'userID' => $this->aauth->get_user_id(),
            			'searchType' => "nearby",
            			'location' => $location,
            			'wordLocation' => "Nearby",
            			'radius' => "Default (5km)",
            			'adults' => "Default (2)",
            			'children' => "Default (0)",
            			'roomAmount' => "Default (1)",
            			'dateF' => "Nearby Search",
            			'dateT' => "Nearby Search",
            			'dateSearched' => date("Y-m-d H:i:s")
        			);
					$this->db->insert('snapbid_searches', $db_array);
				}
	        } 
	     
        	$config['base_url'] = $paginationURL;
        	$config['total_rows'] = count($nbSearchresults);
        	$config['per_page'] = "15";
        	$config["uri_segment"] = 4;
        	$choice = $config["total_rows"] / $config["per_page"];
        	$config["num_links"] = 4;
        	$config['page_query_string'] = TRUE;
        	$config['reuse_query_string'] = TRUE;
        	$config['use_page_numbers'] = TRUE;
        	$config['query_string_segment'] = 'page';
        	$config['full_tag_open'] = '<ul class="pagination">';
        	$config['full_tag_close'] = '</ul>';
        	$config['first_link'] = false;
        	$config['last_link'] = false;
        	$config['first_tag_open'] = '<li>';
        	$config['first_tag_close'] = '</li>';
        	$config['prev_link'] = '&laquo';
        	$config['prev_tag_open'] = '<li class="prev">';
        	$config['prev_tag_close'] = '</li>';
        	$config['next_link'] = '&raquo';
        	$config['next_tag_open'] = '<li>';
        	$config['next_tag_close'] = '</li>';
        	$config['last_tag_open'] = '<li>';
        	$config['last_tag_close'] = '</li>';
        	$config['cur_tag_open'] = '<li class="active"><a href="#">';
        	$config['cur_tag_close'] = '</a></li>';
        	$config['num_tag_open'] = '<li>';
        	$config['num_tag_close'] = '</li>';
		
        	$this->pagination->initialize($config);
        
        	$data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;
        
        	if($data['page'] == 0) {
            	$config["top_per_page"] = (($data['page']+1)*15);
            	$config["bottom_per_page"] = (($data['page'])*15);
        	} else {
           	 	$config["top_per_page"] = $data['page']*15;
            	$config["bottom_per_page"] = (($data['page']-1)*15)+1;
        	}
        
        	//call the model function to get the department data
        	$data['hotelsPage'] = array_slice($nbSearchresults, $config["bottom_per_page"], $config["per_page"]);           

        	$data['pagination'] = $this->pagination->create_links();	
        	$data['hotels'] = $nbSearchresults;

			$latlng = $this->session->userdata('myCoords');
			$latlng = explode(",", $latlng);
			$data['lat'] = $latlng[0];
			$data['lng'] = $latlng[1];
        
		} else {
			$data = '';
		}

        /* Data */
        $header['title'] = "SnapBid - Nearby Hotel Search";
        $header['pageClass'] = "nearby";

        /* Templating */
		if(!isset($nbSearchresults)) {
        	$this->load->view('common/nearby-head', $header);
        	$this->load->view('common/header');
        	$this->load->view('nearby', $data);
        	$this->load->view('common/whymail');
        	$this->load->view('common/footer');
		} else {
        	$this->load->view('common/nearby-head', $header);
        	$this->load->view('common/header');
        	$this->load->view('nearby-results', $data);
        	$this->load->view('common/whymail');
        	$this->load->view('common/footer');
		}
	}
}
