<?php

namespace App\Libraries\EcoNotts;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class EcoNottsService
{

    protected $endpoint;

    public function __construct(Client $guzzle)
    {
        $this->endpoint = "https://econotts-api.azurewebsites.net/api/";
        // $this->endpoint = "http://51f45d52.ngrok.io/api/";
        $this->guzzle = $guzzle;
    }

    public function percentage() {
        $percentage = file_get_contents($this->endpoint . 'Percentage');
        $percentage = json_decode($percentage);
    
        if(!empty($percentage) && !empty($percentage->percentage && $percentage->percentage != "NaN")) {
            return number_format($percentage->percentage, 2);
        } else {
            return 0;
        }
    }

    public function friends() {
        
        $friends = file_get_contents($this->endpoint . 'establishment/top');
        $friends = json_decode($friends);

        return $friends;

    }

    public function allWithRatings() {

        $all = file_get_contents($this->endpoint . 'establishment/all');
        $all = json_decode($all);
        
        return $all;

        return [
            (object)["id" => 1, "name" => "Burger King", "latitude" => 52.854783, "longitude" => -1.158109, "happyStraws" => 1, "sadStraws" => 4],
            (object)["id" => 2, "name" => "Five Guys", "latitude" => 52.754783, "longitude" => -1.158109, "happyStraws" => 9, "sadStraws" => 4],
            (object)["id" => 3, "name" => "MOD Pizza", "latitude" => 52.354783, "longitude" => -1.158109, "happyStraws" => 1, "sadStraws" => 4],
        ];
    }

    public function sendReport($params)
    {
        
        \Log::info('Submitting: ' . print_r($params, true));
        $path = "establishment/add";

        try {
           
            $data = [
                'form_params' => $params,
                'headers' => [],
            ];
            
            $url = $this->endpoint . $path;
            
            \Log::info(print_r($url, true));
            \Log::info(print_r($data, true));

            $response = $this->guzzle->post(
                $url,
                $data
            );
            
            $contentType = $response->getHeader('Content-Type');

            // get the body of the response
            
            // Ensure we successfully decoded the response
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \App\Exceptions\RequestException("Failed to decode JSON response: " . json_last_error());
            }

            return true;

        } catch (RequestException $e) {
            // we have had a bad response
            $response = $e->getResponse();
            $body = json_decode($response->getBody()->getContents());
            // dd($response, $body);
            // $body = json_decode($response->getBody()->getContents());
            
            return true;
        }

        return true;
    }

}
