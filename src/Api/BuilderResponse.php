<?php
namespace CR0\HTTPClient\Api;
interface BuilderResponse
{
    public function setResponse(string $response) : self;
    public function setStatusCode(int $status): self;
    public function setHeaders(array $headers = []) : self;
    public function setCookies(string $cookies) : self;
    public function getResponse() : string;
    public function getStatusCode() : int;
    public function getHeaders() : array;
    public function getCookies() : string;
}