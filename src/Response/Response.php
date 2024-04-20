<?php
/*
 * @software CR0 HTTP Client - Request library focused on practicality and simplicity
 * @author Bruno Venancio Alves <boteistem@gmail.com>
 * @copyrigh (c) 2024
 * @license  Free
 */
namespace CR0\HTTPClient\Response;
use CR0\HTTPClient\Api\HttpResponse;
use CR0\HTTPClient\Api\BuilderResponse;
class Response implements HttpResponse
{
    private string $response;
    private int $statuscode;
    private array $headers;
    private array $cookies;    
    /**
     * __construct
     * 
     * @param BuilderResponse $builderCurl
     * @return void
     */
    public function __construct(
        protected BuilderResponse $builderCurl
    ){
        $this->response = $this->builderCurl->getResponse();
        $this->statuscode = $this->builderCurl->getStatusCode();
        $this->headers = $this->builderCurl->getHeaders();
        $this->cookies = $this->builderCurl->getCookies();
        unset($this->builderCurl);
    }    
    /**
     * getResponse
     *
     * @return string
     */
    public function getResponse() : string{
        return $this->response;
    }    
    /**
     * getStatusCode
     *
     * @return int
     */
    public function getStatusCode() : int{
        return $this->statuscode;
    }    
    /**
     * getHeaders
     *
     * @return array
     */
    public function getHeaders() : array{
        return $this->headers;
    }    
    /**
     * getCookies
     *
     * @return array
     */
    public function getCookies() : array{
        return $this->cookies;
    }
}