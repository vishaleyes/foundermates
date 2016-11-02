<?php
/**
 * Copyright (c) 2011 All Right Reserved, Todooli, Inc.
 *
 * This source is subject to the Todooli Permissive License. Any Modification
 * must not alter or remove any copyright notices in the Software or Package,
 * generated or otherwise. All derivative work as well as any Distribution of
 * this asis or in Modified
form or derivative requires express written consent
 * from Todooli, Inc.
 *
 *
 * THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY
 * KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A
 * PARTICULAR PURPOSE.
 *
 *
**/ 
/**
 *
 * Following is array used by everyone
    [results] => 1
    [actual_address] => sunnyvale, ca
    [accuracy] => 4
    [alternate_address] => Sunnyvale, CA, USA
    [country] => USA
    [administrative_area] => CA
    [locality] =>
    [dependent_locality] =>
    [sub_administrative_area] => Santa Clara
    [postal] =>
    [thorough_fare] =>
    [lat] => 37.36883
    [lng] => -122.0363496
 * Following is array used by solr
 */
class GoogleHelper {

 public function __construct()
	{
		
	}
	function google_location_chk($location=NULL, $fullAddress=false, $use_solr=false) {
		
		if (defined(USE_SOLR)) {
			if (USE_SOLR == 'false') {
				$use_solr = false;
			} else {
				$use_solr = true;
			}
		}
		$use_solr = false;
		$coord				= 	array();	
		$coord['status']	= 	false;	
		if ($use_solr) {
		  error_log("INFO GoogleHelper: For address: (use solr) ".$location);
		} else {
		  error_log("INFO GoogleHelper: For address: (no solr) ".$location);
		}
		if ($location) {
			if ($use_solr) {
				$googleCache = new SolrGoogleCache();
        		$location = $googleCache->normalize($location);
        		$result = $googleCache->get_location_from_solr($location);
			} else {
				$result = null;
			}
			//$result = null;
			
        	if ($result && count($result) > 0) {
				$coord['status']				= 	true;	
	            $coord['address']                =   $result[0]->title;
   	         	$coord['lat']                    =   $result[0]->lat;
            	$coord['lng']                    =   $result[0]->lng;
   	         	$coord['results']                =   $result[0]->results;
   	         	$coord['alternate_address']      =   $result[0]->alternate_address;
   	         	$coord['country']                =   $result[0]->country;
   	         	$coord['administrative_area']    =   $result[0]->administrative_area;
   	         	$coord['sub_administrative_area']=   $result[0]->sub_administrative_area;
   	         	$coord['locality']               =   $result[0]->locality;
   	         	$coord['dependent_locality']     =   $result[0]->dependent_locality;
   	         	$coord['thorough_fare']          =   $result[0]->thorough_fare;
   	         	$coord['accuracy']               =   $result[0]->accuracy;
   	         	$coord['postal']                 =   $result[0]->postal;
   	         	$coord['actual_address']         =   $result[0]->actual_address;
   	         	$coord['id']                     =   $result[0]->id;
   	         	$coord['created_on']             =   $result[0]->created_on;
				//error_log("Got location from SOLR = ".$this->getStringOfArray($coord));
        	} else {
				if ($use_solr) {
        			$location = $googleCache->normalize($location);
				}	
				$where = urlencode($location);
				$whereurl = $where;
			//$this->log("whereurl =>".$whereurl);
			// Note - Google key is domain specific!
		if (!defined ('API_KEY_GOOGLE_MAP')) {
			define('API_KEY_GOOGLE_MAP','ABQIAAAAoKEOVeH5Ak8SaEmM-hRytBRSYwPj9khfICxBbljTfsfiJS8R_BRzFQ9tZSd52bOGUKRQru8MIcs0aA');
		}
		
				$object = simplexml_load_file("http://maps.google.com/maps/geo?q=$whereurl&output=xml&key=".API_KEY_GOOGLE_MAP);
    			$status = $object->Response->Status->code;
				$coord['status']=false;	
				//error_log("Status Code = ".$status);
    			if (strcmp($status, "200") == 0) {
      				// Successful geocode
					$coord['status']=true;
					$name_of_location = $object->Response->name;
					$coord['results'] = count($object->Response->Placemark);
					if ($coord['results'] > 1) {
						$coord['actual_address'] = (string)$object->Response->name;
						$coord['accuracy'] = 
						(string)$object->Response->Placemark[0]->AddressDetails['Accuracy'];
						//$this->log("Accuracy: ".$coord['accuracy']);
						$alternate_address = 
							$object->Response->Placemark[0]->address;
						$coord['alternate_address'] = (string)$alternate_address;
						$country = 
							$object->Response->Placemark[0]->AddressDetails->Country->CountryName;
						$coord['country'] = (string)$country;
						if(isset($object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->AdministrativeAreaName))
						{
							$administrative_area = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->AdministrativeAreaName;
						}
						else
						{
							$administrative_area = '';
						}
						
						$coord['administrative_area'] = (string)$administrative_area;
						if(
				isset($object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->Locality)) {
							//error_log("Got Administrative locality = ");
							$locality = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->Locality->LocalityName;
							$coord['locality'] = (string)$locality;
							$coord['dependent_locality'] = (string)$locality;
							$sub_administrative_area = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->SubAdministrativeAreaName;
							$coord['sub_administrative_area'] = (string)$sub_administrative_area;
							if(isset($object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->Locality->Thoroughfare->ThoroughfareName)) {
								$postal = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->Locality->PostalCode->PostalCodeNumber;
								$streetAddress = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->Locality->Thoroughfare->ThoroughfareName;
							} else if (isset($object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->PostalCode->PostalCodeNumber)){
								$postal = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->PostalCode->PostalCodeNumber;
								$streetAddress = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->Thoroughfare->ThoroughfareName;
							} else {
								$postal = "";
								$streetAddress = "";
							}
						} else {
							if(
				isset($object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality)) {
								//error_log("Got SubAdministrativeArea->locality = ");
								$locality = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->LocalityName;
								$coord['locality'] = (string)$locality;
								$coord['dependent_locality'] = (string)$locality;
								$sub_administrative_area = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->SubAdministrativeAreaName;
								$coord['sub_administrative_area'] = (string)$sub_administrative_area;
								if(isset($object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->Thoroughfare->ThoroughfareName)) {
									$postal = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->PostalCode->PostalCodeNumber;
									$streetAddress = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->Thoroughfare->ThoroughfareName;
								} else {
									$postal = "";
									$streetAddress = "";
								}
							} else {
								if(isset($object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->DependentLocality->DependentLocalityName))
								{
									$locality = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->DependentLocality->DependentLocalityName;
								}
								else
								{
									$locality = '';
								}
								//error_log("Got dependent locality = ".$locality);
								$coord['locality'] = (string)$locality;
								$coord['dependent_locality'] = (string)$locality;
								$sub_administrative_area = "";
								$coord['sub_administrative_area'] = (string)$sub_administrative_area;
								if (isset($object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->DependentLocality->Thoroughfare->ThoroughfareName)) {
									$postal = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->DependentLocality->PostalCode->PostalCodeNumber;
									$streetAddress = $object->Response->Placemark[0]->AddressDetails->Country->AdministrativeArea->DependentLocality->Thoroughfare->ThoroughfareName;
								} else {
									$postal = "";
									$streetAddress = "";
								}
							}
						}
						$coord['postal'] = (string)($postal);
						$coord['thorough_fare'] = (string)($streetAddress);
						$coordinates = explode(",",$object->Response->Placemark[0]->Point->coordinates);
						$coord['lat'] = (float)$coordinates[1];
						$coord['lng'] = (float)$coordinates[0];
	            		$location_data                  = $coord;
   		        		$location_data['id']            = md5($name_of_location);
						if ($use_solr) {
        			  		$location = $googleCache->escape_string_for_solr($location);
						}
   		        		$location_data['title']         = (string)$location;
	            		$coord['address']               = (string)$location;
						if ($use_solr) {
   	         				$location_data['created_on']    = $googleCache->convertDateToSolrFormat(date("Y-m-d H:i:s"));
            				$result = $googleCache->add_location_to_solr($location_data); //insert location data to solr
						}
						foreach ($coord as $label=>$value) {
							$coord[$label] = $value;
						}
					} else {
						$coord['actual_address'] = (string)$object->Response->name;
						$coord['accuracy'] = 
						(string)$object->Response->Placemark->AddressDetails['Accuracy'];
						//$this->log("Accuracy: ".$coord['accuracy']);
						$alternate_address = 
							$object->Response->Placemark->address;
						$coord['alternate_address'] = (string)$alternate_address;
						$country = 
							$object->Response->Placemark->AddressDetails->Country->CountryName;
						$coord['country'] = (string)$country;
						if(isset($object->Response->Placemark->AddressDetails->Country->AdministrativeArea->AdministrativeAreaName))
						{
							$administrative_area = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->AdministrativeAreaName;
						}
						else
						{
							$administrative_area = '';
						}
						$coord['administrative_area'] = (string)$administrative_area;
						if(isset($object->Response->Placemark->AddressDetails->Country->AdministrativeArea->Locality)) {
							$locality = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->Locality->LocalityName;
							$coord['locality'] = (string)$locality;
							$coord['dependent_locality'] = (string)$locality;
							$sub_administrative_area = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->SubAdministrativeAreaName;
							$coord['sub_administrative_area'] = (string)$sub_administrative_area;
							if(isset($object->Response->Placemark->AddressDetails->Country->AdministrativeArea->Locality->Thoroughfare->ThoroughfareName)) {
								$postal = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->Locality->PostalCode->PostalCodeNumber;
								$streetAddress = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->Locality->Thoroughfare->ThoroughfareName;
							} else if (isset($object->Response->Placemark->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->PostalCode->PostalCodeNumber)){
								$postal = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->PostalCode->PostalCodeNumber;
								$streetAddress = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->Thoroughfare->ThoroughfareName;
							} else {
								//error_log("Not getting any locality = ");
								$postal = "";
								$streetAddress = "";
							}
						} else {
							if(isset($object->Response->Placemark->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality)) {
								$locality = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->LocalityName;
								$coord['locality'] = (string)$locality;
								$coord['dependent_locality'] = (string)$locality;
								$sub_administrative_area = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->SubAdministrativeAreaName;
								$coord['sub_administrative_area'] = (string)$sub_administrative_area;
								if(isset($object->Response->Placemark->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->Thoroughfare->ThoroughfareName)) {
									$postal = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->PostalCode->PostalCodeNumber;
									$streetAddress = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->SubAdministrativeArea->Locality->Thoroughfare->ThoroughfareName;
								} else {
									//error_log("Not getting any locality = ");
									$postal = "";
									$streetAddress = "";
								}
							} else {
							
								if(isset( $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->DependentLocality->DependentLocalityName))
								{
									$locality = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->DependentLocality->DependentLocalityName;
								}
								else
								{
									$locality = '';
								}
								
								//error_log("Got dependent locality = ".$locality);
								$coord['locality'] = (string)$locality;
								$coord['dependent_locality'] = (string)$locality;
								$sub_administrative_area = "";
								$coord['sub_administrative_area'] = (string)$sub_administrative_area;
								if(isset($object->Response->Placemark->AddressDetails->Country->AdministrativeArea->DependentLocality->Thoroughfare->ThoroughfareName)) {
									$postal = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->DependentLocality->PostalCode->PostalCodeNumber;
									$streetAddress = $object->Response->Placemark->AddressDetails->Country->AdministrativeArea->DependentLocality->Thoroughfare->ThoroughfareName;
								} else {
									//error_log("Not getting any locality = ".$locality);
									$postal = "";
									$streetAddress = "";
								}
							}
						}
						$coord['postal'] = (string)($postal);
						$coord['thorough_fare'] = (string)($streetAddress);
						$coordinates = explode(",",$object->Response->Placemark->Point->coordinates);
						$coord['lat'] = (float)$coordinates[1];
						$coord['lng'] = (float)$coordinates[0];
	            		$location_data                  = $coord;
   		        		$location_data['id']            = md5($name_of_location);
						if ($use_solr) {
        			  		$location = $googleCache->escape_string_for_solr($location);
						}
   		        		$location_data['title']         = (string)$location;
	            		$coord['address']               = (string)$location;
						if ($use_solr) {
   	         				$location_data['created_on']    = $googleCache->convertDateToSolrFormat(date("Y-m-d H:i:s"));
            				$result = $googleCache->add_location_to_solr($location_data); //insert location data to solr
						}
						foreach ($coord as $label=>$value) {
							$coord[$label] = $value;
						}
					}
				}
				//error_log("Got location from GOOGLE = ".$this->getStringOfArray($coord));
			}
			if ($coord['status'] == true) {
				if(isset($coord['accuracy'])) {
					if ($coord['accuracy'] < 4) {
						$coord['status']=false;	
					}
					if ($fullAddress == true) {
						if ($coord['accuracy'] < 8) {
							$coord['status']=false;	
						}
					}		
				} else {
					$coord['status']=false;	
				}
			}
		}
		$coord['need_retry'] = false;
		if ($coord['status']) {
			$a1 = strtolower(trim($coord['address']));
			$a2 = preg_replace("/[\s,]+usa$/", '', $a1);
			$a3 = preg_replace("/[\s,]+us$/", '', $a2);
			$a4 = preg_replace("/[\s,]+united states$/", ' ', $a3);
			$a5 = preg_replace("/[\s,]/", '', $a4); 
			$a6 = preg_replace("/[\\\\]/", '', $a5); 

      		$aa0 = strtolower(trim($coord['alternate_address']));
			if ($use_solr) {
      			$aa1 = $googleCache->escape_string_for_solr($aa0);
			} else {
      			$aa1 = $aa0;
			}
			$aa2 = preg_replace("/[\s,]+usa$/", '', $aa1);
			$aa3 = preg_replace("/[\s,]+us$/", '', $aa2);
			$aa4 = preg_replace("/[\s,]+united states$/", ' ', $aa3);
			$aa5 = preg_replace("/[\s,]/", '', $aa4); 
			$aa6 = preg_replace("/[\\\\]/", '', $aa5); 
		
			if (strcasecmp($a6, $aa6) != 0) {
				$coord['need_retry'] = true;
			}
			if ($fullAddress == true) {
				if ($coord['accuracy'] < 8) { 
					$coord['need_retry'] = true;
				}
			}
		}	
		//error_log("status: " . $coord['status'] . "need_retry: ". $coord['need_retry']);
		return $coord;
		
		
	}
	
	function getLatLongOfAddress($address) {
		$address=str_replace(' ','',$address);
		$address=str_replace(',','+',$address);
		$url='http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false';
		$point = array();
		if($geocode=file_get_contents($url))
		{
			$output = json_decode($geocode);
			if(!empty($output->results))
			{
				if($output->results['0']->geometry->location->lat != '')
				{
					$point['latitude'] = $output->results['0']->geometry->location->lat;
					$point['longitude'] = $output->results['0']->geometry->location->lng;
				}
			}
		}
		return $point;
	}

	function getStringOfArray($arrayVar) {
		$new_array = array_map(
						create_function('$key, $value', 'return $key.":".$value." # ";'), 
						array_keys($arrayVar), array_values($arrayVar));
		return (implode($new_array));
	}
}

