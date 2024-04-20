<?php
/*
 * @software CR0 HTTP Client - Request library focused on practicality and simplicity
 * @author Bruno Venancio Alves <boteistem@gmail.com>
 * @copyrigh (c) 2024
 * @license  Free
 */
namespace CR0\HTTPClient\Api;
use CR0\HTTPClient\Response\Response;
interface BuilderResponse
{    
    /**
     * setResponse
     *
     * @param  mixed $response
     * @return self
     */
    public function setResponse(string $response) : self;    
    /**
     * setStatusCode
     *
     * @param  mixed $status
     * @return self
     */
    public function setStatusCode(int $status): self;    
    /**
     * setHeaders
     *
     * @param  mixed $headers
     * @return self
     */
    public function setHeaders(array $headers = []) : self;    
    /**
     * setCookies
     *
     * @param  mixed $cookies
     * @return self
     */
    public function setCookies(array $cookies) : self;    
    /**
     * getResponse
     *
     * @return string
     */
    public function getResponse() : string;    
    /**
     * getStatusCode
     *
     * @return int
     */
    public function getStatusCode() : int;    
    /**
     * getHeaders
     *
     * @return array
     */
    public function getHeaders() : array;    
    /**
     * getCookies
     *
     * @return array
     */
    public function getCookies() : array;    
    /**
     * build
     *
     * @return Response
     */
    public function build() : Response;
}