<?php
/**
 * Created by PhpStorm.
 * User: Niall
 * Date: 01/02/2017
 * Time: 22:31
 */
require_once '../model/Hotel.model.php';

use App\Model\Hotel as Hotel;

//task check
if(!empty($_GET['task']) && $_GET['task'] == "FETCH_HOTEL_DATA"){

    //get required data
    $filter = $_GET['filter'];
    $value = $_GET['userInput'];

    //create new instance of Hotel object
    $hotel = new Hotel();

    //get data and filter
    $data = $hotel->getHotelData();
    $filteredData = $hotel->filterData($data, $filter, $value);

    //encode data as JSON object
    $returnData = $hotel->encodeJSONData($filteredData);

    echo $returnData;
}
?>