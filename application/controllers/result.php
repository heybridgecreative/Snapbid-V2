<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class result extends CI_Controller {

	function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
	{
    	$datetime1 = date_create($date_1);
    	$datetime2 = date_create($date_2);
    
    	$interval = date_diff($datetime1, $datetime2);
    
    	return $interval->format($differenceFormat);
    
	}

	public function send() 
	{
		// load email library
		$this->load->library('email');

		// prepare email
		$this->email
    		->from('cmarsterson@gmail.com', 'Craig Marsterson')
    		->to('cmarsterson@gmail.com')
    		->subject('Send a Bid')
    		->message('Hello, We are <strong>Example Inc.</strong>')
    		->set_mailtype('html');

		//Send mail 
         if($this->email->send()) {
         	$this->session->set_flashdata("email_sent","Email sent successfully."); 
         } else { 
         	$this->session->set_flashdata("email_sent","Error in sending Email."); 
		}
	}

	public function index()
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
        
        $wordLocation = $this->input->get('location');
        $location = $this->HotelResults->getCoordinates($wordLocation);
        $radius = $this->input->get('radius');
        $datef = nice_date($this->input->get('datef'), 'Y-m-d');
        $datet = nice_date($this->input->get('datet'), 'Y-m-d');
        $adults = $this->input->get('adults');
        $roomAmount = $this->input->get('rooms');
        $children = $this->input->get('children');
        
        $sess_array = '';
        $sess_array = array(
            'location' => $location,
            'datef' => $datef,
            'datet' => $datet,
            'radius' => $radius,
            'adults' => $adults,
            'roomAmount' => $roomAmount,
            'children' => $children,
            'wordLocation' => $wordLocation
        );

		$data['radius'] = $radius;
                        
        /*		$url = "http://xmlfeed.laterooms.com/index.aspx?aid=1000&rtype=4&kword=$location&sdate=$datef&nights=3"; */
		$url  = "http://ews.expedia.com/wsapi/rest/hotel/v1/search?"; 
        $url .= "location=$location"; 
        $url .= "&radius=$radius"; 
        $url .= "&adults=$adults,$roomAmount"; 
        $url .= "&dates=$datef,$datet"; 
        $url .= "&key=7436C7B8-63A8-487E-96DF-90078411A590"; 
         
        $sessionCheck = $this->session->userdata('searchresults');
        $sessionParamsCheck = $searchParams = $this->session->userdata('searchparams');

        if($sess_array == $sessionParamsCheck) {
            if(!isset($sessionCheck)) {
                $hotels = $this->HotelResults->get_results($url);
                $this->session->set_userdata('searchresults', $hotels);
                $this->session->set_userdata('searchparams', $sess_array);
                $searchResults = $this->session->userdata('searchresults');
                $searchParams = $this->session->userdata('searchparams');
            } else {
                $searchResults = $this->session->userdata('searchresults');
                $searchParams = $this->session->userdata('searchparams');
            }
        } else {
            $hotels = $this->HotelResults->get_results($url);
            $this->session->set_userdata('searchresults', $hotels);
            $this->session->set_userdata('searchparams', $sess_array);
            $searchResults = $this->session->userdata('searchresults');
            $searchParams = $this->session->userdata('searchparams');

				$db_array = '';
        		$db_array = array(
            		'userID' => $this->aauth->get_user_id(),
            		'searchType' => "search",
            		'location' => $location,
            		'wordLocation' => $wordLocation,
            		'radius' => $radius,
            		'adults' => $adults,
            		'children' => $children,
            		'roomAmount' => $roomAmount,
            		'dateF' => $datef,
            		'dateT' => $datet,
            		'dateSearched' => date("Y-m-d H:i:s")
        		);

				$this->db->insert('snapbid_searches', $db_array);
        }

		$data['datef'] = $datef;
		$data['datet'] = $datet;
        $datediff = $this->dateDifference($datef, $datet, $differenceFormat = '%a');
		$data['datediff'] = $datediff;
	
		$price1low = 10 * $datediff; 
		$price1high = 150 * $datediff; 
		$price2low = $price1high + 1; 
		$price2high = 250 * $datediff; 
		$price3low = $price2high + 1; 
		$price3high = 400 * $datediff; 
		$price4low = $price3high + 1; 
		$price4high = 650 * $datediff; 
		$price5low = $price4high + 1; 
		$price5high = 1000 * $datediff; 
		$price6low = $price5high + 1; 
	
		$data['price1'] = $price1low."-".$price1high;
		$data['price2'] = $price2low."-".$price2high;
		$data['price3'] = $price3low."-".$price3high;
		$data['price4'] = $price4low."-".$price4high;
		$data['price5'] = $price5low."-".$price5high;
		$data['price6'] = $price6low."+";
	
		$data['viewprice1'] = "&pound;".$price1low." - &pound;".$price1high;
		$data['viewprice2'] = "&pound;".$price2low." - &pound;".$price2high;
		$data['viewprice3'] = "&pound;".$price3low." - &pound;".$price3high;
		$data['viewprice4'] = "&pound;".$price4low." - &pound;".$price4high;
		$data['viewprice5'] = "&pound;".$price5low." - &pound;".$price5high;
		$data['viewprice6'] = "&pound;".$price6low." +";
	
		/* CHECKING for FILTER */

		$sortBy = $this->session->userdata('sortby');
		$filterP = $this->session->userdata('filterP');
		$filterRS = $this->session->userdata('filterRS');
		$filterSR = $this->session->userdata('filterSR');

		$postSortBy = $this->input->post('sortby');
		$postFilterP = $this->input->post('price');
		$postFilterRS = $this->input->post('reviewscore');
		$postFilterSR = $this->input->post('starrating');


		/* END CHECK */

		if(isset($filterP)) {
			if($postFilterP === $filterP) { 
				$price = $this->session->userdata('filterP');
				$data['price'] = $this->session->userdata('filterP');
			} else {
				$this->session->unset_userdata('filterP');
				$price = $this->input->post('price');
				$data['price'] = $this->input->post('price');
			}
		} else {
			$price = $this->input->post('price');
			$data['price'] = $this->input->post('price');
		}

		if($filterSR) {
			if($postFilterSR === $filterSR) {
				$starrating = $this->session->userdata('filterSR');
				$data['starrating'] = $this->session->userdata('filterSR');
			} else {
				$this->session->unset_userdata('filterSR');
				$starrating = $this->input->post('starrating');
				$data['starrating'] = $this->input->post('starrating');
			}
		} else {
			$starrating = $this->input->post('starrating');
			$data['starrating'] = $this->input->post('starrating');
		}

		if($filterRS) {
			if($postFilterSR === $filterSR) {
				$reviewscore = $this->session->userdata('filterRS');
				$data['reviewscore'] = $this->session->userdata('filterRS');
			} else {
				$this->session->unset_userdata('filterRS');
				$reviewscore = $this->input->post('reviewscore');
				$data['reviewscore'] = $this->input->post('reviewscore');
			}
		} else {
			$reviewscore = $this->input->post('reviewscore');
			$data['reviewscore'] = $this->input->post('reviewscore');
		}



		/* SORTING */

		$sortby = $this->input->post('sortby');
		$data['sortby'] = $this->input->post('sortby');
		
		if(isset($sortby)) {
			foreach ($searchResults as $searchResult) {
  				foreach ($searchResult as $key => $value){
    				${$key}[]  = $value; 
  				}  			
			}
			if($sortby === "priceASC") {
				array_multisort($TotalPrice, SORT_ASC, $searchResults); 
			}
			if($sortby === "priceDESC") {
				array_multisort($TotalPrice, SORT_DESC, $searchResults); 
			}
			if($sortby === "nameASC") {
				array_multisort($Name, SORT_ASC, $searchResults); 
			}
			if($sortby === "nameDESC") {
				array_multisort($Name, SORT_DESC, $searchResults); 
			}
			if($sortby === "starASC") {
				array_multisort($StarRating, SORT_ASC, $searchResults); 
			}
			if($sortby === "starDESC") {
				array_multisort($StarRating, SORT_DESC, $searchResults); 
			}
            $this->session->set_userdata('searchresults', $searchResults);
			
		} else {
			foreach ($searchResults as $searchResult) {
  				foreach ($searchResult as $key => $value){
    				${$key}[]  = $value; 
  				}  			
			}
			array_multisort($TotalPrice, SORT_ASC, $searchResults);
			array_multisort($StarRating, SORT_DESC, $searchResults);
		}


		/* END Sorting */


		if(isset($starrating)) {
			$searchResults1s = array();
			$searchResults2s = array();
			$searchResults3s = array();
			$searchResults4s = array();
			$searchResults5s = array();

			if(in_array("1", $starrating)) {
				$searchResults1s = array_filter($searchResults, function($v) { return $v['StarRating'] == 1.0; });
			} 
			if(in_array("2", $starrating)) {
				$searchResults2s = array_filter($searchResults, function($v) { return $v['StarRating'] == 2.0; });
			} 
			if(in_array("3", $starrating)) {
				$searchResults3s = array_filter($searchResults, function($v) { return $v['StarRating'] == 3.0; });
			} 
			if(in_array("4", $starrating)) {
				$searchResults4s = array_filter($searchResults, function($v) { return $v['StarRating'] == 4.0; });
			} 
			if(in_array("5", $starrating)) {
				$searchResults5s = array_filter($searchResults, function($v) { return $v['StarRating'] == 5.0; });
			} 

			$searchResults = array_merge($searchResults5s, $searchResults4s, $searchResults3s, $searchResults2s, $searchResults1s);
            $this->session->set_userdata('filterSR', $starrating);
			
		}


		if(isset($price)) {
		
			$price1 = array();
			$price2 = array();
			$price3 = array();
			$price4 = array();
			$price5 = array();
			$price6 = array();

			$price1explode = explode("-", $data['price1']);
			$price2explode = explode("-", $data['price2']);
			$price3explode = explode("-", $data['price3']);
			$price4explode = explode("-", $data['price4']);
			$price5explode = explode("-", $data['price5']);

			if(in_array($data['price1'], $price)) {
				$price1 = array_filter($searchResults, function($v) use ($price1explode) { return ($price1explode[0] < $v['TotalPrice'] && $v['TotalPrice'] < $price1explode[1]); });
			} 
			if(in_array($data['price2'], $price)) {
				$price2 = array_filter($searchResults, function($v) use ($price2explode) { return ($price2explode[0] < $v['TotalPrice'] && $v['TotalPrice'] < $price2explode[1]); });
			} 
			if(in_array($data['price3'], $price)) {
				$price3 = array_filter($searchResults, function($v) use ($price3explode) { return ($price3explode[0] < $v['TotalPrice'] && $v['TotalPrice'] < $price3explode[1]); });
			} 
			if(in_array($data['price4'], $price)) {
				$price4 = array_filter($searchResults, function($v) use ($price4explode) { return ($price4explode[0] < $v['TotalPrice'] && $v['TotalPrice'] < $price4explode[1]); });
			} 
			if(in_array($data['price5'], $price)) {
				$price5 = array_filter($searchResults, function($v) use ($price5explode) { return ($price5explode[0] < $v['TotalPrice'] && $v['TotalPrice'] < $price5explode[1]); });
			}  
			if(in_array($data['price6'], $price)) {
				$price6 = array_filter($searchResults, function($v) use ($price5explode) { return ($price5explode[1] < $v['TotalPrice']); });
			} 
			
			$searchResults = array_merge($price1, $price2, $price3, $price4, $price5, $price6);
            $this->session->set_userdata('filterP', $price);
			
	
		}


		if(isset($reviewscore)) {
			$reviewscore1 = array();
			$reviewscore2 = array();
			$reviewscore3 = array();
			$reviewscore4 = array();
			$reviewscore5 = array();
			$reviewscore6 = array();

			if(in_array("all", $reviewscore)) {
				$reviewscoreAll = array_filter($searchResults, function($v) { return ($v['GuestRating'] > 0); });
			} 
			if(in_array("0", $reviewscore)) {
				$reviewscore1 = array_filter($searchResults, function($v) { return ($v['GuestRating'] < 0); });
			} 
			if(in_array("1+", $reviewscore)) {
				$reviewscore2 = array_filter($searchResults, function($v) { return (1.0 <= $v['GuestRating'] && $v['GuestRating'] < 2.0); });
			} 
			if(in_array("2+", $reviewscore)) {
				$reviewscore3 = array_filter($searchResults, function($v) { return (2.0 <= $v['GuestRating'] && $v['GuestRating'] < 3.0); });
			} 
			if(in_array("3+", $reviewscore)) {
				$reviewscore4 = array_filter($searchResults, function($v) { return (3.0 <= $v['GuestRating'] && $v['GuestRating'] < 4.0); });
			} 
			if(in_array("4+", $reviewscore)) {
				$reviewscore5 = array_filter($searchResults, function($v) { return (4.0 <= $v['GuestRating'] && $v['GuestRating'] < 5.0); });
			}
			
			$searchResults = array_merge($reviewscore1, $reviewscore2, $reviewscore3, $reviewscore4, $reviewscore5);
            $this->session->set_userdata('filterRS', $reviewscore);
			
		}
               

			




        /* Data */
        $header['title'] = "SnapBid Expedia Results";
        $data['hotels'] = $searchResults;
		$data['location'] = $wordLocation;
		$data['radius'] = $radius;
		$data['adults'] = $adults;
		$data['children'] = $children;
		$data['roomAmount'] = $roomAmount;
		$data['datef'] = $datef;
		$data['datet'] = $datet;
        
        /* Pagination Config */
        //pagination settings
        $config['base_url'] = 'http://snapbidv2.azurewebsites.net/index.php/result';
        $config['total_rows'] = count($searchResults);
        $config['per_page'] = "15";
        $config['uri_segment'] = 4;
        $choice = $config["total_rows"] / $config["per_page"];
        $config['num_links'] = 7;
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
        $data['hotelsPage'] = array_slice($searchResults, $config["bottom_per_page"], $config["per_page"]);           

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
            $this->load->view('result', $data);
            $this->load->view('common/whymail');
            $this->load->view('common/footer');
        }
        
        
	}  
}