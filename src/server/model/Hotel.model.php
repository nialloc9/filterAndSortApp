<?php
/**
 * Created by PhpStorm.
 * User: Niall
 * Date: 01/02/2017
 * Time: 22:03
 */

namespace App\Model;


class Hotel
{
    //data memebers
    private $jsonData;
    private $decodedData;
    private $filter;
    private $value;
    private $returnData;

    /**
     * Get's Hotel data
     * @return Array
     * To make the site more dynamic and ensure that the site is scalable I would recommend having
     * this data stored in a database instead of a JSON file.
     */
    public final function getHotelData(){
        $this->jsonData = file_get_contents('http://example.com/example.json/');
        $this->decodeJSONData($this->jsonData);

        return $this->decodedData;
    }

    /**
     * @param $data
     * @return json data
     */
    public final function encodeJSONData($data){
        $this->decodedData = $data;
        return json_encode($this->decodedData, JSON_FORCE_OBJECT);
    }

    /**
     * decodes JSON data
     * @param $data
     */
    private final function decodeJSONData($data){
        $this->jsonData = $data;
        $this->decodedData = json_decode($this->jsonData, true);
    }

    /**
     * @param $data
     * @param $filter
     * @param $value
     * @return Array
     */
    public final function filterData($data, $filter, $value){
        $this->decodedData = $data;
        $this->filter = $filter;
        $this->value = $value;

        foreach($this->decodedData as $key => $data){
            if($data[$this->filter] == $this->value){
                $this->returnData[] = $this->value;
            }
        }

        return $this->returnData;
    }
}