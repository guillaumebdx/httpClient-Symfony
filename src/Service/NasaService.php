<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NasaService
{
    private $client;
    
    private $params;
    
    public function __construct(HttpClientInterface $client, ParameterBagInterface $params)
    {
        $this->client = $client;
        $this->params = $params;
    }
    
    public function getPicture() : array
    {
        $url      = 'https://api.nasa.gov/planetary/apod';
        $response = $this->client->request('GET', $url, [
            'query' => [
                'api_key' => $this->params->get('api_key'),
                'date'    => '2019-01-01',
            ]
            
        ]);
        
        return $response->toArray();
        
    }
}