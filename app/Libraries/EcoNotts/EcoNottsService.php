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
