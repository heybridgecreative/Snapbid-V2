<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel extends CI_Controller {

	public function index($hotelID)
	{
        /* Helpers */
        $this->load->helper('url'); 
        $this->load->helper('date');
        
        /* Libraries */
        $this->load->library('session');
        $this->load->library('Googlemaps');
        $this->load->library('Aauth');
        
        /* Models */
        $this->load->model('HotelInfo'); 

        
        /* Get info from Session */
        $url = "https://partnerapi.expedia.com/m/hotels/info?hotelId=$hotelID";
        $url .= "&deeplinks=ratedetails";
        $hotel = $this->HotelInfo->get_info($url);
    
        $roomSubmit = $this->input->get('roomSubmit');
        
        if(isset($roomSubmit)) {
            $datef = $this->input->get('datef');
            $datet = $this->input->get('datet');
			$datef = nice_date($datef, 'Y-m-d');
			$datet = nice_date($datet, 'Y-m-d');
            $adults = $this->input->get('adults');
            $roomAmount = $this->input->get('roomAmount');
            $children = $this->input->get('children');

            $sess_array = '';
            $sess_array = array(
                'datef' => $datef,
                'datet' => $datet,
                'adults' => $adults,
                'roomAmount' => $roomAmount,
                'children' => $children
            );
            
            $this->session->set_userdata('searchparams', $sess_array);
        }
        
        $searchParams = $this->session->userdata('searchparams');
        $output['datef'] = $searchParams['datef'];
        $output['datet'] = $searchParams['datet'];
        $output['adults'] = $searchParams['adults'];
        $output['children'] = $searchParams['children'];
        $output['roomAmount'] = $searchParams['roomAmount'];
                
        if($searchParams){
            $rooms = $this->HotelInfo->get_rooms($hotelID);
            $output = array_merge($hotel, $rooms);
            $output['ratingTitle'] = $this->HotelInfo->get_rating_title($rooms['rating']);
            $output['datef'] = $searchParams['datef'];
            $output['datet'] = $searchParams['datet'];
            $output['adults'] = $searchParams['adults'];
            $output['children'] = $searchParams['children'];
            $output['roomAmount'] = $searchParams['roomAmount'];
        } else {
            $rooms = "";
            $output = $hotel;
            $output['ratingTitle'] = $this->HotelInfo->get_rating_title(0);
            $output['rating'] = "N/A";
            $output['reviews'] = "N/A ";
        }
        
        /* Data */
        $data['title'] = $hotel['hotelName'] . " - " . $hotel['hotelCity'] . ", " . $hotel['hotelStateProvince'];
        $data['pageClass'] = "hotelInfo";
        
        $output['fullAddress'] = $hotel['hotelAddress'];
        $output['fullAddress'] .= ", ";
        $output['fullAddress'] .= $hotel['hotelCity'];
        $output['fullAddress'] .= ", ";
        $output['fullAddress'] .= $hotel['hotelCountry'];
        $output['fullAddress'] = str_replace(" ", "+", $output['fullAddress']);
		$output['hotelID'] = $hotelID;

		$userID = $this->aauth->get_user_id();
			if($userID) {
				$views = $this->db->query("SELECT * FROM snapbid_views where userID = $userID and hotelID = $hotelID");
			}
		$hotelName = $hotel['hotelName'];
		$fullAddress = $hotel['hotelCity'];
		
		$update = array(
			'userID' => $userID,
			'hotelID' => $hotelID,
			'hotelName' => $hotelName,
			'hotelLocation' => $fullAddress
		);

		$this->db->where('userID',$userID); 
		$this->db->where('hotelID',$hotelID); 
		$q = $this->db->get('snapbid_views');  
		if ($q->num_rows > 0)  { 
			$this->db->where('userID', $userID);
			$this->db->where('hotelID', $hotelID);
			$this->db->insert('snapbid_views', $update);
		} else { 
			$this->db->where('userID', $userID);
			$this->db->where('hotelID', $hotelID); 
			$this->db->update('snapbid_views', $update);
		}

            
        /* Templating */
        $this->load->view('common/head', $data);
        $this->load->view('common/header');
        $this->load->view('hotel', $output);
        $this->load->view('common/whymail');
        $this->load->view('common/footer');
	}
    
    public function addToTrips()
	{
		/* Helpers */
        $this->load->helper('url'); 
        $this->load->helper('date');
        
        /* Libraries */
        $this->load->library('Aauth');

		$tripData = $this->input->post();
		$tripDataJson = json_encode($tripData);

		$tripList = array();
		$tripIDs = $this->aauth->get_user_var('tripIDs');


		if (strpos($tripIDs, $tripData['hotelID']) !== false) {
			$tripList = str_ireplace($tripData['hotelID'], '', $tripIDs);
		} else {
			$tripList = $tripIDs;
			$tripList .= ", ";
			$tripList .= $tripData['hotelID'];
		}

		$checkTrip = $this->aauth->get_user_var($tripData['hotelID']);

		if(!$checkTrip) {
			$this->aauth->set_user_var("tripIDs", $tripList);
			$this->aauth->set_user_var($tripData['hotelID'], $tripDataJson);
		} else {
			$this->aauth->unset_user_var($tripData['hotelID']);
		}
    }
}
