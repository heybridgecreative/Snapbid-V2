<?php
class HotelResults extends CI_Model {

    public $data;

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }

     public function getCoordinates($wordLocation){
        $wordLocation = str_replace(" ", "+", $wordLocation);
        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$wordLocation";
        $response = file_get_contents($url);
        $json = json_decode($response,TRUE);
        return ($json['results'][0]['geometry']['location']['lat'].",".$json['results'][0]['geometry']['location']['lng']);
    }

    public function get_results_backup($url)
    {
        if (@simplexml_load_file($url)) {
            $h = simplexml_load_file($url);
            $h = json_decode(json_encode($h), true);
            
            $data = array();

            foreach ($h['HotelInfoList']['HotelInfo'] as $hotel) {
                        
						$object = $hotel['HotelID'];

                        $data[$object]['ID'] = $hotel['HotelID'];
                        $data[$object]['Name'] = $hotel['Name'];
                        $data[$object]['Address'] = $hotel['Location']['StreetAddress'];
                        $data[$object]['City'] = $hotel['Location']['City'];
                        $data[$object]['Province'] = $hotel['Location']['Province'];
                        $data[$object]['Country'] = $hotel['Location']['Country'];
                        if($hotel['StarRating']) { $data[$object]['StarRating'] = $hotel['StarRating']; }
						if($hotel['Description']) { $data[$object]['Description'] = $hotel['Description']; } else { $data[$object]['Description'] = ""; }
                        $data[$object]['Description'] = $hotel['Description'];
                        $data[$object]['StatusCode'] = $hotel['StatusCode'];

                        $data[$object]['Image'] = substr($hotel['ThumbnailUrl'], 0, -5).'b.jpg';

                        if(isset($hotel['GuestRating'])) {
                            $data[$object]['GuestRating'] = $hotel['GuestRating'];
                        } else {
                            $data[$object]['GuestRating'] = '0.0';
                        }

                        $data[$object]['GuestReviewCount'] = $hotel['GuestReviewCount'];
 
                    if($hotel['StatusCode'] == 0) {
						if($hotel['Price']) { $data[$object]['TotalPrice'] = $hotel['Price']['TotalRate']['Value']; }
                        if($hotel['Price']) { $data[$object]['Currency'] = $hotel['Price']['TotalRate']['Currency']; }
					} else {
						$data[$object]['TotalPrice'] = "Sold Out"; 
                        $data[$object]['Currency'] = " "; 
					}
                    
            }
        } else {
            $data['error'] = "Failed loading - Please try again.\n";
        }
        
        return $data;
    }    


	public function dateless($url)
    {
        if (@simplexml_load_file($url)) {
            $h = simplexml_load_file($url);
            $h = json_decode(json_encode($h), true);
            $data = array();

            foreach ($h['HotelInfoList']['HotelInfo'] as $hotel) {
                        $object = $hotel['HotelID'];
                        $data[$object]['ID'] = $hotel['HotelID'];
                        $data[$object]['Name'] = $hotel['Name'];
                        $data[$object]['Address'] = $hotel['Location']['StreetAddress'];
                        $data[$object]['City'] = $hotel['Location']['City'];
                        $data[$object]['Province'] = $hotel['Location']['Province'];
                        $data[$object]['Country'] = $hotel['Location']['Country'];
                        $data[$object]['Latitude'] = $hotel['Location']['GeoLocation']['Latitude'];
                        $data[$object]['Longitude'] = $hotel['Location']['GeoLocation']['Longitude'];
						
						if(isset($hotel['StarRating'])) {
                            $data[$object]['StarRating'] = $hotel['StarRating'];
                        } else {
                            $data[$object]['StarRating'] = '0.0';
                        }

						if(isset($hotel['Description'])) { $data[$object]['Description'] = $hotel['Description']; } else { $data[$object]['Description'] = ""; }

                        if(isset($hotel['ThumbnailUrl'])) {
                            $data[$object]['Image'] = substr($hotel['ThumbnailUrl'], 0, -5).'b.jpg';
                        } else {
                            $data[$object]['Image'] = " ";
                        }

                        if(isset($hotel['GuestRating'])) {
                            $data[$object]['GuestRating'] = $hotel['GuestRating'];
                        } else {
                            $data[$object]['GuestRating'] = '0.0';
                        }

                        $data[$object]['GuestReviewCount'] = $hotel['GuestReviewCount'];
              
            }
        } else {
            $data['error'] = "Failed loading - Please try again.\n";
        }
        return $data;
    }    



   public function get_results($url)
    {
        if (@simplexml_load_file($url)) {
            $h = simplexml_load_file($url);
            $h = json_decode(json_encode($h), true);
            
            $data = array();

            foreach ($h['HotelInfoList']['HotelInfo'] as $hotel) {

                        $object = $hotel['HotelID'];
                		if(isset($hotel['Price'])) { 
							$data[$object]['TotalPrice'] = $hotel['Price']['TotalRate']['Value']; 
                    		$data[$object]['Currency'] = $hotel['Price']['TotalRate']['Currency'];
						} else {
							$data[$object]['TotalPrice'] = "SOLD OUT";
                    		$data[$object]['Currency'] = "";
						}
                        $data[$object]['ID'] = $hotel['HotelID'];
                        $data[$object]['Name'] = $hotel['Name'];
                        $data[$object]['Address'] = $hotel['Location']['StreetAddress'];
                        $data[$object]['City'] = $hotel['Location']['City'];
                        $data[$object]['Province'] = $hotel['Location']['Province'];
                        $data[$object]['Country'] = $hotel['Location']['Country'];
                        if(isset($hotel['StarRating'])) { $data[$object]['StarRating'] = $hotel['StarRating']; } else { $data[$object]['StarRating'] = 0; }
						if($hotel['Description']) { $data[$object]['Description'] = $hotel['Description']; } else { $data[$object]['Description'] = ""; }
                        $data[$object]['Description'] = $hotel['Description'];
                        $data[$object]['StatusCode'] = $hotel['StatusCode'];
						if(isset($hotel['ThumbnailUrl'])) {
                        	$data[$object]['Image'] = substr($hotel['ThumbnailUrl'], 0, -5).'b.jpg';
						} else {
							$data[$object]['Image'] = "";
						}

                        if(isset($hotel['GuestRating'])) {
                            $data[$object]['GuestRating'] = $hotel['GuestRating'];
                        } else {
                            $data[$object]['GuestRating'] = '0.0';
                        }

                        $data[$object]['GuestReviewCount'] = $hotel['GuestReviewCount'];
             
            }
        } else {
            $data['error'] = "Failed loading - Please try again.\n";
        }
        
        return $data;
    } 

}
?>