<?php

namespace App\Libraries\EcoNotts;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class EcoNottsService
{

    protected $endpoint;

    public function __construct(Client $guzzle)
    {
        $this->endpoint = 'https://a8000c76.ngrok.io/api/';
        $this->guzzle = $guzzle;
    }

    public function sendReport($params)
    {
        
        \Log::info('Submitting: ' . print_r($params, true));
        $path = "Establishment/add";

        try {
           
            $data = [
                'body' => json_encode($params),
                'headers' => [],
            ];
            \Log::info($this->endpoint . $path);
            $response = $this->guzzle->post(
                $this->endpoint . $path,
                $data
            );

            $contentType = $response->getHeader('Content-Type');

            // get the body of the response
            $body = json_decode($response->getBody());
            dd($body);
            // Ensure we successfully decoded the response
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \App\Exceptions\RequestException("Failed to decode JSON response: " . json_last_error());
            }

            return true;

        } catch (RequestException $e) {
            // we have had a bad response
            $response = $e->getResponse();
            $body = json_decode($response->getBody()->getContents());
            dd($response, $body);
            // $body = json_decode($response->getBody()->getContents());
            
            return true;
        }

        return true;
    }

}
