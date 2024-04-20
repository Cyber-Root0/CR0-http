<?php
namespace CR0\HTTPClient;
use CR0\HTTPClient\Api\ClientInterface;
use CR0\HTTPClient\Validation\Rules;
final class Client implements ClientInterface
{

    private Rules $validation;
    private array $options = [];
    private array $headers = [];
    private array $querys = [];
    private string $method;
    private string $body;
    public function __construct(
        private string $baseurl
    ){
        $this->validation = new Rules($this);
    }    
    /**
     * insert request options, for request as timeout, timeoutexpired, etc.
     *
     * @param  array $options
     * @return self
     */
    public function setOptions(array $options) : self{
        $this->options = $options;
        return $this;
    }
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
    public function setHeader(array $headers) : self{
        $this->headers = $headers;
        return $this;
    }   
    /**
     * add specific header for the request
     *
     * @param  string $key
     * @param  string $value
     * @return self
     */
    public function addHeader(string $key, string $value) : self{
        $this->headers[$key] = $value;
        return $this;
    }   
    /**
     * set specific request method
     *
     * @param string $method
     * @return self
     */
    public function setMethod(string $method) : self{
        $this->method = $method;
        return $this;
    }    
    /**
     * add query string on complete url
     *
     * @param string $key
     * @param string $value
     * @return self
     */
    public function addQuery(string $key, string $value) : self{
        $this->querys[$key] = $value;
        return $this;
    }
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
    public function setQuery(array $querys) : self{
        $this->querys = $querys;
        return $this;
    } 
    /**
     * set body to send data to the server
     *
     * @param  string $rawBody
     * @return self
     */
    public function setBody(string $rawBody) : self{
        $this->body = $rawBody;
        return $this;
    }
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
    public function getOptions() : array{
        return $this->isEmpty($this->options) ? [] : $this->options;
    }
    /**
     * getHeader
     *
     * @return array
     */
    public function getHeader() : array{
        return $this->isEmpty($this->headers) ? [] : $this->headers;
    }   
    /**
     * getMethod
     *
     * @return string
     */
    public function getMethod() : string{
        return $this->isEmpty($this->method) ? 'GET' : $this->method;
    }    
    /**
     * getQuery
     *
     * @return array
     */
    public function getQuery() : array{
        return $this->isEmpty($this->querys) ? [] : $this->querys;
    }
    /**
     * getBody
     *
     * @return string
     */
    public function getBody() : string{
        return $this->isEmpty($this->body) ? '' : $this->body;
    }
    public function reset() : void{
        $this->body = '';
        $this->headers = [];
        $this->method = '';
        $this->options = [];
        $this->querys = [];
    }
    /**
     * send request and return body from response
     *
     * @return string
     */
    public function send() : string{
        return '';
    }
    private function isEmpty($var){
        return empty($var);
    }
}