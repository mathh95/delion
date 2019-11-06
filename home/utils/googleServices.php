<?php

include_once $_SERVER['DOCUMENT_ROOT']."/config.php"; 

class GoogleServices {

    private $apikey = APIKEY_GOOGLE_SERVICES;

    function getGeocoding($address){
        
        $geoloc = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?&address='.urlencode($address).'&key='.$this->apikey);

        $geoloc_arr = json_decode($geoloc);

        // var_dump($geoloc_arr->results[0]->formatted_address);
        // var_dump($geoloc_arr->results[0]->geometry->location);

        if ($geoloc_arr->status=='OK') {
            $location = $geoloc_arr->results[0]->geometry->location;
        } else {
            return "-1";
            exit();
        }
        
        return $location;
    }

    //cálculo manual https://www.geodatasource.com/developers/php
    function getDistanceGeometry($lat1, $lon1, $lat2, $lon2, $unit){
        
        if(($lat1 == $lat2) && ($lon1 == $lon2)){
            return 0;
        }else{
            $theta = $lon1 - $lon2;

            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));

            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 *1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K"){
                return ($miles * 1.609344);
            }else if ($unit == "N"){
                return $miles;
            }            
        }
    }

    //Distância Rota
    function getDistanceMatrixInfo($origin, $destination){
        
        $distance_data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?&origins='.urlencode($origin).'&destinations='.urlencode($destination).'&key='.$this->apikey);
        
        $distance_arr = json_decode($distance_data);
        
        //var_dump($distance_arr);  
        
        if ($distance_arr->status=='OK') {
            $destination_addresses = $distance_arr->destination_addresses[0];
            $origin_addresses = $distance_arr->origin_addresses[0];
        } else {
            return "-1";
            exit();
        }
        
        if ($origin_addresses=="" or $destination_addresses=="") {
            return "Destino não encontrado";
            exit();
        }
        
        // Get the elements
        $distance_info = array();

        $elements = $distance_arr->rows[0]->elements;
        $distance_info['duration_text'] = $elements[0]->duration->text;//mins
        $distance_info['duration_sec'] = $elements[0]->duration->value;

        $distance_info['distance_km'] = $elements[0]->distance->text;//km
        $distance_info['distance_meters'] = $elements[0]->distance->value;


        return $distance_info;
        
    }

    //aposentado, usando da Entrega (controlerEntrega)
    function getDeliveryPrice($dist){

        //$tempo_preparo = "20" * 1;//sem pedidos, 1.1
        
        //(dist m * valor base/km) / 1000
        $delivery_price = ($dist * 1.5) / 1000; 

        return floor($delivery_price);//arredonda pra baixo
    }
}

?>