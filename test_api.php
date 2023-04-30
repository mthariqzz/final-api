<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$response = $client->request('GET', 'http://belajar-api.test/api/hpl', [
    'headers' => [
        'Authorization' => 'Bearer 5|zSeb4eNk0lnP42QPlbe6FQeqXe5ZbGrYNOYNuX30',
        'Accept' => 'application/json',
    ],
]);

$data = json_decode($response->getBody(), true);
print_r($data);
