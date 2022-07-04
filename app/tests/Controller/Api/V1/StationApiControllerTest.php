<?php

use PHPUnit\Framework\TestCase;


class StationApiControllerTest extends TestCase
{

    public function testGetStations(): Response
    {
        $client = new \GuzzleHttp\Client([
            'base_uri' => 'http://localhost:9000/',
            'timeout'         => 0,
            'allow_redirects' => false,
        ]);
        $response = $client->get('api/v1/stations', []);
        $this->assertEquals(200, $response->getStatusCode());
    }
} 