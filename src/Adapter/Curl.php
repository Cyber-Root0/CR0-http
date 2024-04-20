<?php
namespace CR0\HTTPClient\Adapter;
use CR0\HTTPClient\Client;
class Curl
{
    public function __construct(
        protected Client $client
    ){

    }
}