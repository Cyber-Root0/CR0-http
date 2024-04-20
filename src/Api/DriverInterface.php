<?php
namespace CR0\HTTPClient\Api;
use CR0\HTTPClient\Api\HttpResponse;
use CR0\HTTPClient\Api\ClientInterface;
interface DriverInterface
{
    public function __construct(ClientInterface $client);
    public function setHeader();
    public function setBody();
    public function execute(string $uri) : HttpResponse;
}