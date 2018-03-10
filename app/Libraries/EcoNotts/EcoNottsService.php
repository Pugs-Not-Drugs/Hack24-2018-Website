<?php

namespace App\Libraries\EcoNotts;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class EcoNottsService
{

    protected $endpoint;

    public function __construct(Client $guzzle)
    {
        $this->endpoint = 'https: //econotts-api.azurewebsites.net/api/';
        $this->guzzle = $guzzle;

    }

    public function sendReport($data)
    {
        $path = "straws/report";

        try {
           
            $data = [
                'body' => json_encode($data),
                'headers' => [],
            ];

            $response = $this->guzzle->post(
                $this->endpoint . $path,
                $data
            );

            $contentType = $response->getHeader('Content-Type');

            // get the body of the response
            $body = json_decode($response->getBody());

            // Ensure we successfully decoded the response
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \App\Exceptions\RequestException("Failed to decode JSON response: " . json_last_error());
            }

            return true;

        } catch (RequestException $e) {
            // we have had a bad response
            $response = $e->getResponse();
            \Log::info(print_r($response, true));
            // $body = json_decode($response->getBody()->getContents());

            return true;
        }

        return true;
    }

}
