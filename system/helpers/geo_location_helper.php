<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('get_geolocation')) {

    function get_geolocation($ip) {
        $d = file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=70aa25190ab35380cb2e72754fc1570e07341ce5f75f118224f867b14644bee8&ip=$ip&output=xml");

        //Use backup server if cannot make a connection
        if (!$d) {
            $backup = file_get_contents("http://backup.ipinfodb.com/ip_query.php?ip=$ip");
            $result = $backup;
            if (!$backup) {
                return false; // Failed to open connection
			}
        } else {
            $result = $d;
        }
        //Return the data as an array
	
		$output = explode(";", $result);

        return array('ip'=>$ip, 'country_code'=>$output['CountryCode'], 'country_name'=>$result['CountryName'], 'region_name'=>$result['RegionName'], 'city'=>$result->City, 'zip_postal_code'=>$result->ZipPostalCode, 'latitude'=>$result->Latitude, 'longitude'=>$result->Longitude, 'timezone'=>$result->Timezone, 'gmtoffset'=>$result->Gmtoffset, 'dstoffset'=>$result->Dstoffset);
    }
}