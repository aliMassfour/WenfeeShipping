<?php


namespace App\Services;




use App\Exceptions\GeocodingException;
use function Symfony\Component\String\length;

/**
 * Class GeocodingService
 * @package App\Services
 */

class GeocodingService
{
    /**
     * @param String $destination
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws GeocodingException
     */
    public function getLatLng(String $destination) :array
    {
        $api_key = env('GOOGLE_MAP_KEY');
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json', [
            'query' => [
                'address' => $destination,
                'key' => $api_key
            ]
        ]);


        if (empty(json_decode($response->getBody())->results)) {
            throw GeocodingException::badDestination();
        }
        $responseBody = json_decode($response->getBody())->results[0];
        return [
            'lat' => $responseBody->geometry->location->lat,
            'lng' => $responseBody->geometry->location->lng
        ];

    }
}
