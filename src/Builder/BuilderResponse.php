<?php
/*
 * @software CR0 HTTP Client - Request library focused on practicality and simplicity
 * @author Bruno Venancio Alves <boteistem@gmail.com>
 * @copyrigh (c) 2024
 * @license  Free
 */
namespace CR0\HTTPClient\Builder;
use CR0\HTTPClient\Api\BuilderResponse as BuilderAPI;
use CR0\HTTPClient\Response\Response;
class BuilderResponse implements BuilderAPI
{
    private string $response;
    private int $statuscode;
    private array $headers;
    private array $cookies;    
    /**
     * setResponse
     *
     * @param  mixed $response
     * @return self
     */
    public function setResponse(string $response) : self{
        $this->response = $response;
        return $this;
    }    
    /**
     * setStatusCode
     *
     * @param  mixed $status
     * @return self
     */
    public function setStatusCode(int $status) : self{
        $this->statuscode = $status;
        return $this;
    }    
    /**
     * setHeaders
     *
     * @param  mixed $headers
     * @return self
     */
    public function setHeaders(array $headers = []) : self{
        $this->headers = $headers;
        return $this;
    }    
    /**
     * setCookies
     *
     * @param  mixed $cookies
     * @return self
     */
    public function setCookies(array $cookies) : self{
        $this->cookies = $cookies;
        return $this;
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
    /**
     * build
     *
     * @return Response
     */
    public function build() : Response{
        return new Response($this);
    }
}