<?php
/**
 * Created by PhpStorm.
 * User: Niall
 * Date: 01/02/2017
 * Time: 22:31
 */

//require_once '../Model/Hotel.Model.php';

class Autoloader{

    public static function modelLoader($modelName){
        require_once '../'.$modelName.'.model.php';
    }

    //other loaders
}

spl_autoload_register('Autoloader::modelLoader');

use Model\Hotel as Hotel;

//task check
if(!empty($_GET['task']) && $_GET['task'] == "FETCH_HOTEL_DATA"){

    //get required data
    $filter = $_GET['filterType'];
    $value = $_GET['filterValue'];

    //create new instance of Hotel object
    $hotel = new Hotel();

    //get data and filter
    $data = $hotel->getHotelData();

    //if no filter encode all data else filter
    if(empty($filter)){
        $returnData = $hotel->encodeJSONData($data['Establishments']);
    }else{
        $filteredData = $hotel->filterData($data, $filter, $value);
        $returnData = $hotel->encodeJSONData($filteredData);
    }

    echo($returnData);
}
?>