<?php
namespace CR0\HTTPClient\Response;
use CR0\HTTPClient\Api\HttpResponse;
use CR0\HTTPClient\Api\BuilderResponse;
class CurlResponse implements HttpResponse
{
    private string $response;
    private int $statuscode;
    private array $headers;
    private string $cookies;
    public function __construct(
        protected BuilderResponse $builderCurl
    ){
        $this->response = $this->builderCurl->getResponse();
        $this->statuscode = $this->builderCurl->getStatusCode();
        $this->headers = $this->builderCurl->getHeaders();
        $this->cookies = $this->builderCurl->getCookies();
        unset($this->builderCurl);
    }
    public function getResponse() : string{
        return $this->response;
    }
    public function getStatusCode() : int{
        return $this->statuscode;
    }
    public function getHeaders() : array{
        return $this->headers;
    }
    public function getCookies() : string{
        return $this->cookies;
    }
}