<?php

namespace App\Libraries\Bing;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class BingService 
{

    protected $endpoint;

    public function __construct(Client $guzzle) 
    {
        $this->endpoint = 'http://spatial.virtualearth.net/REST/v1/data/c2ae584bbccc4916a0acf75d1e6947b4/NavteqEU/NavteqPOIs';
        $this->guzzle = $guzzle;

    }

    public function searchCompanies($keywords) {

        $companies = [];
        try {
            $queryParams = [
                "spatialFilter" => "nearby('Nottingham',100)",
                "entityType" => "Business",
                '$format'   => 'json',
                "key"       =>  env('BING_MAP_KEY'),
                "keywords"  => $keywords
            ];

            $data = [
                'body' => json_encode([]),
                'headers' => []
            ];

            $response = $this->guzzle->get(
                $this->endpoint . '?' . http_build_query($queryParams), 
                $data
            );

            $contentType = $response->getHeader('Content-Type');

            // get the body of the response
            $body = json_decode($response->getBody());
            
            // Ensure we successfully decoded the response
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \App\Exceptions\RequestException("Failed to decode JSON response: " . json_last_error());
            }

            return $body->d->results;

        
        } catch(RequestException $e) {
            // we have had a bad response
            $response = $e->getResponse();
            $body = json_decode($response->getBody()->getContents());

            return $companies;
        }
        
        return $companies;
    }

}


