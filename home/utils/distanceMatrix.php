<?php

class DistanceMatrix {

    function getDistanceInfo($origin, $destination){
        
        $distance_data = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?&origins='.urlencode($origin).'&destinations='.urlencode($destination).'&key=AIzaSyAS7HedlAWWAMuzXlS8boXxNIC5RJFUH-A');
        
        $distance_arr = json_decode($distance_data);
        
        //var_dump($distance_arr);
        
        if ($distance_arr->status=='OK') {
            $destination_addresses = $distance_arr->destination_addresses[0];
            $origin_addresses = $distance_arr->origin_addresses[0];
        } else {
            return "Erro na Requisição";
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

    function getDeliveryPrice($dist){

        //$tempo_preparo = "20" * 1;//sem pedidos, 1.1
        
        //(dist m * valor base/km) / 1000
        $delivery_price = ($dist * 1.5) / 1000; 

        return floor($delivery_price);//arredonda pra baixo
    }
}

?>