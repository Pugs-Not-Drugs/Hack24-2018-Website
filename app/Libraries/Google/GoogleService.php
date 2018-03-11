<?php

namespace App\Libraries\Google;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GoogleService 
{

    protected $endpoint;

    public function __construct(Client $guzzle) 
    {
        $this->endpoint = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';
        $this->guzzle = $guzzle;

    }

    public function searchCompanies($keywords) {
        $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=52.954783%2C-1.158109&radius=5000&type=restaurant&keyword=" . urlencode($keywords) . "&key=AIzaSyAPsnDKSbHd0I13ybmPkYlAfCsvGjvAK_4";
        $response = $this->guzzle->get($url);
        $body = json_decode($response->getBody());
        
        if(!empty($body) && !is_object($body)) {
            return json_decode($body)->results;
        } else {
            return $body->results;
        }
        return [];
            
    }

}


