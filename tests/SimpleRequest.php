<?php
require_once(__DIR__.'/../vendor/autoload.php');
use CR0\HTTPClient\Client;

$client = new Client("https://cat-fact.herokuapp.com");

$response = $client->addQuery('animal_type', 'cat')->addQuery('mount', '2')->setMethod('GET')->isJson()->send('/facts/random');
var_dump($response->getHeaders());