<?php
namespace CR0\HTTPClient\Api;
interface HttpResponse
{
    public function getResponse() : string;
    public function getStatusCode() : int;
    public function getHeaders() : array;
    public function getCookies() : string;
}