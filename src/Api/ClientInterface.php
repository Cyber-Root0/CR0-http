<?php
namespace CR0\HTTPClient\Api;
use CR0\HTTPClient\Api\HttpResponse;
interface ClientInterface
{
    public function __construct(string $baseurl);    
    /**
     * insert request options, for request as timeout, timeoutexpired, etc.
     *
     * @param  array $options
     * @return self
     */
    public function setOptions(array $options) : self;     
    /**
     * replace all headers with collection headers in array
     * 
     * ex: [
     *  "key" => '9090',
     *  "public_key" => '89w789whd'
     * ]
     *
     * @param  array $headers
     * @return self
     */
    public function setHeader(array $headers) : self;    
    /**
     * add specific header for the request
     *
     * @param  string $key
     * @param  string $value
     * @return self
     */
    public function addHeader(string $key, string $value) : self;    
    /**
     * set specific request method
     *
     * @param string $method
     * @return self
     */
    public function setMethod(string $method) : self;    
    /**
     * add query string on complete url
     *
     * @param string $key
     * @param string $value
     * @return self
     */
    public function addQuery(string $key, string $value) : self;    
    /**
     * replace all querys with collection query in array
     * 
     * ex: [
     *  "key" => '9090',
     *  "public_key" => '89w789whd'
     * ]
     *
     * @param  array $querys
     * @return self
     */
    public function setQuery(array $querys) : self;    
    /**
     * set body to send data to the server
     *
     * @param  string $rawBody
     * @return self
     */
    public function setBody(string $rawBody) : self;    
    /**
     * reset all configurations
     *
     * @return void
     */    
    /**
     * getOptions
     *
     * @return array
     */
    public function getOptions() : array;    
    /**
     * getHeader
     *
     * @return array
     */
    public function getHeader() : array;    
    /**
     * getMethod
     *
     * @return string
     */
    public function getMethod() : string;    
    /**
     * getQuery
     *
     * @return array
     */
    public function getQuery() : array;    
    /**
     * getBody
     *
     * @return string
     */
    public function getBody() : string;
    public function reset() : void;    
    /**
     * send request and return body from response
     *
     * @return string
     */
    public function send(string $uri) : HttpResponse | \Exception;
}