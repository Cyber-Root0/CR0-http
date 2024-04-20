<?php
namespace CR0\HTTPClient\Builder;
use CR0\HTTPClient\Api\BuilderResponse as BuilderAPI;
class BuilderResponse implements BuilderAPI
{
    private string $response;
    private int $statuscode;
    private array $headers;
    private string $cookies;
    public function setResponse(string $response) : self{
        $this->response = $response;
        return $this;
    }
    public function setStatusCode(int $status) : self{
        $this->statuscode = $status;
        return $this;
    }
    public function setHeaders(array $headers = []) : self{
        $this->headers = [];
        return $this;
    }
    public function setCookies(string $cookies) : self{
        $this->cookies = $cookies;
        return $this;
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