<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

	public function search($location)
	{
		
		/* Helpers */
        $this->load->helper('xml');
        $this->load->helper('url'); 
        $this->load->helper('date');
        
        /* Libraries */
        $this->load->library('session');
        $this->load->library('pagination');

        /* Models */
        $this->load->model('HotelResults');    

		$paginationURL = site_url("location/search/$location");
		$wordLocation = $location;
        $location = $this->HotelResults->getCoordinates($location);
        
        $sess_array = '';
        $sess_array = array(
            'location' => $location
        );
                        
         $url  = "http://ews.expedia.com/wsapi/rest/hotel/v1/search?";
        $url .= "location=$location";
        $url .= "&radius=5km";
        $url .= "&key=7436C7B8-63A8-487E-96DF-90078411A590";
        
        $sessionCheck = $this->session->userdata('dlSearchresults');
        $sessionParamsCheck = $this->session->userdata('dlSearchParams');

        if($sess_array == $sessionParamsCheck) {
            if(!isset($sessionCheck)) {
                $dlHotels = $this->HotelResults->dateless($url);
                $this->session->set_userdata('dlSearchresults', $dlHotels);
                $this->session->set_userdata('dlSearchParams', $sess_array);
                $dlSearchresults = $this->session->userdata('dlSearchresults');
                $dlSearchParams = $this->session->userdata('dlSearchParams');
            } else {
                $dlSearchresults = $this->session->userdata('dlSearchresults');
                $dlSearchParams = $this->session->userdata('dlSearchParams');
            }
        } else {
            $dlHotels = $this->HotelResults->dateless($url);
            $this->session->set_userdata('dlSearchresults', $dlHotels);
            $this->session->set_userdata('dlSearchParams', $sess_array);
            $dlSearchresults = $this->session->userdata('dlSearchresults');
            $dlSearchParams = $this->session->userdata('dlSearchParams');

				$db_array = '';
        		$db_array = array(
            		'userID' => $this->aauth->get_user_id(),
            		'searchType' => "dateless",
            		'location' => $location,
            		'wordLocation' => $wordLocation,
            		'radius' => "Default (5km)",
            		'adults' => "Default (2)",
            		'children' => "Default (0)",
            		'roomAmount' => "Default (1)",
            		'dateF' => "Dateless Search",
            		'dateT' => "Dateless Search",
            		'dateSearched' => date("Y-m-d H:i:s")
        		);

				$this->db->insert('snapbid_searches', $db_array);
	
        }

		$sortBy = $this->session->userdata('sortby');
		$starrating = $this->input->post('starrating');
		$data['starrating'] = $this->input->post('starrating');
		$reviewscore = $this->input->post('reviewscore');
		$data['reviewscore'] = $this->input->post('reviewscore');


		/* SORTING */

		$sortby = $this->input->post('sortby');
		$data['sortby'] = $this->input->post('sortby');
		
		if(isset($sortby)) {
			foreach ($dlSearchresults as $dlSearchresult) {
  				foreach ($dlSearchresult as $key => $value){
    				${$key}[]  = $value; 
  				}  			
			}
			if($sortby === "nameASC") {
				array_multisort($Name, SORT_ASC, $dlSearchresults); 
			}
			if($sortby === "nameDESC") {
				array_multisort($Name, SORT_DESC, $dlSearchresults); 
			}
			if($sortby === "starASC") {
				array_multisort($StarRating, SORT_ASC, $dlSearchresults); 
			}
			if($sortby === "starDESC") {
				array_multisort($StarRating, SORT_DESC, $dlSearchresults); 
			}
            $this->session->set_userdata('searchresults', $dlSearchresults);
			
		}


		/* END Sorting */

		if(isset($starrating)) {
			$searchResults1s = array();
			$searchResults2s = array();
			$searchResults3s = array();
			$searchResults4s = array();
			$searchResults5s = array();

			if(in_array("1", $starrating)) {
				$searchResults1s = array_filter($dlSearchresults, function($v) { return $v['StarRating'] == 1.0; });
			} 
			if(in_array("2", $starrating)) {
				$searchResults2s = array_filter($dlSearchresults, function($v) { return $v['StarRating'] == 2.0; });
			} 
			if(in_array("3", $starrating)) {
				$searchResults3s = array_filter($dlSearchresults, function($v) { return $v['StarRating'] == 3.0; });
			} 
			if(in_array("4", $starrating)) {
				$searchResults4s = array_filter($dlSearchresults, function($v) { return $v['StarRating'] == 4.0; });
			} 
			if(in_array("5", $starrating)) {
				$searchResults5s = array_filter($dlSearchresults, function($v) { return $v['StarRating'] == 5.0; });
			} 

			$dlSearchresults = array_merge($searchResults5s, $searchResults4s, $searchResults3s, $searchResults2s, $searchResults1s);
		}


		if(isset($reviewscore)) {
			$reviewscore1 = array();
			$reviewscore2 = array();
			$reviewscore3 = array();
			$reviewscore4 = array();
			$reviewscore5 = array();
			$reviewscore6 = array();

			if(in_array("all", $reviewscore)) {
				$reviewscoreAll = array_filter($dlSearchresults, function($v) { return ($v['GuestRating'] > 0); });
			} 
			if(in_array("0", $reviewscore)) {
				$reviewscore1 = array_filter($dlSearchresults, function($v) { return ($v['GuestRating'] < 0); });
			} 
			if(in_array("1+", $reviewscore)) {
				$reviewscore2 = array_filter($dlSearchresults, function($v) { return (1.0 <= $v['GuestRating'] && $v['GuestRating'] < 2.0); });
			} 
			if(in_array("2+", $reviewscore)) {
				$reviewscore3 = array_filter($dlSearchresults, function($v) { return (2.0 <= $v['GuestRating'] && $v['GuestRating'] < 3.0); });
			} 
			if(in_array("3+", $reviewscore)) {
				$reviewscore4 = array_filter($dlSearchresults, function($v) { return (3.0 <= $v['GuestRating'] && $v['GuestRating'] < 4.0); });
			} 
			if(in_array("4+", $reviewscore)) {
				$reviewscore5 = array_filter($dlSearchresults, function($v) { return (4.0 <= $v['GuestRating'] && $v['GuestRating'] < 5.0); });
			}
			
			$dlSearchresults = array_merge($reviewscore1, $reviewscore2, $reviewscore3, $reviewscore4, $reviewscore5);
			
		}
               
        /* Data */
        $header['title'] = "SnapBid Location Search Results";
        $data['hotels'] = $dlSearchresults;

	
        
        /* Pagination Config */
        //pagination settings
        $config['base_url'] = $paginationURL;
        $config['total_rows'] = count($dlSearchresults);
        $config['per_page'] = "15";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 4;
        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['query_string_segment'] = 'page';

        //config for bootstrap pagination class integration
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
        $data['hotelsPage'] = array_slice($dlSearchresults, $config["bottom_per_page"], $config["per_page"]);           

        $data['pagination'] = $this->pagination->create_links();
            
        
        
        /* Templating */
        if(isset($data['hotels']['error'])) {
            $header['pageClass'] = "error";
            $this->load->view('common/head', $header);
            $this->load->view('common/header', $header);
            $this->load->view('error', $data);
            $this->load->view('common/whymail');
            $this->load->view('common/footer');
        } else {
            $header['pageClass'] = "result";
            $this->load->view('common/head', $header);
            $this->load->view('common/header', $header);
            $this->load->view('location', $data);
            $this->load->view('common/whymail');
            $this->load->view('common/footer');
        }
        
        
	}  
}