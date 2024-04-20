<?php
namespace CR0\HTTPClient\Api;
use CR0\HTTPClient\Client;
interface RulesInterface
{   
    public function __construct(ClientInterface $client);
    public function execute() : bool;
}