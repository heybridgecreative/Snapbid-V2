<?php
class HotelInfo extends CI_Model {

    public $data;

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }
    
    
	public function get_rooms($hotelID) 
    {
        
        $searchParams = $this->session->userdata('searchparams');
        $datef = $searchParams['datef'];
        $datet = $searchParams['datet'];
        
        $url  = "http://ews.expedia.com/wsapi/rest/hotel/v1/search?";
        $url .= "hotelids=$hotelID";
        $url .= "&dates=$datef,$datet";
        $url .= "&allroomtypes=true";
        $url .= "&deeplinks=ratedetails";
        $url .= "&key=7436C7B8-63A8-487E-96DF-90078411A590";
            
        if (@simplexml_load_file($url)) {
            $r = simplexml_load_file($url);
            $r = json_decode(json_encode($r), true);
        }


        $output['rating'] =  "";
        $output['reviews'] =  "";
		$output['URL'] =  "";
        			
		if (array_key_exists("RoomTypeList", $r['HotelInfoList']['HotelInfo'])) {
        	$output['roomTypeList'] = $r['HotelInfoList']['HotelInfo']['RoomTypeList']['RoomType'];
			
		} else {
			$output['roomTypeList'] = "noRooms";
		}
		if (array_key_exists("GuestRating", $r['HotelInfoList']['HotelInfo'])) {
        	$output['rating'] = $r['HotelInfoList']['HotelInfo']['GuestRating'];
		} else {
			$output['rating'] = "0.0";
		}
        
		if (array_key_exists("RateDetailsUrl", $r['HotelInfoList']['HotelInfo'])) {
        	$output['URL'] = $r['HotelInfoList']['HotelInfo']['RateDetailsUrl'];
		} else if(array_key_exists("DetailsUrl", $r['HotelInfoList']['HotelInfo'])) {
        	$output['URL'] = $r['HotelInfoList']['HotelInfo']['DetailsUrl'];
		} else {
			$output['URL'] = "#";
		}

		if (array_key_exists("GuestReviewCount", $r['HotelInfoList']['HotelInfo'])) {
        	$output['reviews'] = $r['HotelInfoList']['HotelInfo']['GuestReviewCount'];
		} else {
			$output['rating'] = "0";
		}

                
        return $output;
    }
	
    /*
	
	public function get_rooms($hotelID) 
    {
    	$opts = array(
          'http'=>array(
            'method'=>"GET",
            'header'=>"Authorization: expedia-apikey key=7436C7B8-63A8-487E-96DF-90078411A590\r\n" .
                      "User-agent: useragent=Snapbid.UK\r\n"
          )
        );

        $context = stream_context_create($opts);
		
        $searchParams = $this->session->userdata('searchparams');
        $datef = $searchParams['datef'];
        $datet = $searchParams['datet'];
        $adults = $searchParams['adults'];
        
        $url  = "https://partnerapi.expedia.com/m/hotel/offers?";
        $url .= "hotelid=$hotelID";
        $url .= "&checkInDate=$datef";
		$url .= "&checkOutDate=$datet";
        $url .= "&room=$adults";
            
        $r = file_get_contents($url, false, $context);
		
		print_r($r);
        return $output;
    }
    */
    
    public function get_rating_title($rating) 
    {
        if($rating > 4) {
            $ratingText = "Excellent";
        } else if($rating >= 3 && $rating < 4) {
            $ratingText = "Very Good";
        } else if($rating >= 2 && $rating < 3) {
            $ratingText = "Good";
        } else if($rating >= 1 && $rating < 2) {
            $ratingText = "Pleasant";
        } else {
            $ratingText = "No Rating";
        }
        return $ratingText;
    }
    
    
    public function get_info($url)
    {
        $opts = array(
          'http'=>array(
            'method'=>"GET",
            'header'=>"Authorization: expedia-apikey key=7436C7B8-63A8-487E-96DF-90078411A590\r\n" .
                      "User-agent: useragent=Snapbid.UK\r\n"
          )
        );

        $context = stream_context_create($opts);

        // Open the file using the HTTP headers set above
        $getHotel = file_get_contents($url, false, $context);
        $hotel = json_decode($getHotel);
                
        $output['hotelName'] = $hotel->hotelName;
        $output['hotelAddress'] = $hotel->hotelAddress;
        $output['hotelCity'] = $hotel->hotelCity;
        $output['hotelStateProvince'] = $hotel->hotelStateProvince;
        $output['hotelCountry'] = $hotel->hotelCountry;
        $output['hotelLat'] = $hotel->latitude;
        $output['hotelLong'] = $hotel->longitude;
             
        $output['longDescription'] = $hotel->longDescription;
        $output['otherDescription'] = "";
        
        $longDescs = explode('<p>', $hotel->longDescription);
        
        $output['roomAmenities'] = '';
        $output['locationDetails'] = '';
        $output['hotelFeatures'] = '';
        $output['hotelAmenities'] =  '';
        $output['pointsOfInterest'] = '';
        $output['hotelPolicies'] = '';
        $output['hotelRoomInfo'] = '';
        $output['hotelFees'] = '';
        $output['otherDescription'] = '';
        
        foreach ($longDescs as $longDesc) {
            if (strpos($longDesc, 'Room Amenities') !== false) {
                $output['roomAmenities'] = $longDesc;
            } else if (strpos($longDesc, 'Location') !== false) {
                $output['locationDetails'] = $longDesc;
            } else if (strpos($longDesc, 'Hotel Features') !== false) {
                $output['hotelFeatures'] = $longDesc;
            } else if (strpos($longDesc, 'Property Amenities') !== false) {
                $output['hotelAmenities'] = $longDesc;
            } else if (strpos($longDesc, 'Points of Interest') !== false) {
                $output['pointsOfInterest'] = $longDesc;
            } else if (strpos($longDesc, 'Policies') !== false) {
                $output['hotelPolicies'] = $longDesc;
            } else if (strpos($longDesc, '<strong>Rooms</strong>') !== false) {
                $output['hotelRoomInfo'] = $longDesc;
            } else if (strpos($longDesc, '<strong>Fees</strong>') !== false) {
                $output['hotelFees'] = $longDesc;
            } else {
                $output['otherDescription'] .= $longDesc;
            }
        }
                
        $output['hotelPhotos'] = $hotel->photos;
        $output['featuredImage'] = current($output['hotelPhotos'])->url;
        $output['hotelPoliciesText'] = $hotel->hotelPoliciesText->content;
        
        
        return $output;
    }
}
?>