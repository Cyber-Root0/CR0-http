<?php
/*
 * @software CR0 HTTP Client - Request library focused on practicality and simplicity
 * @author Bruno Venancio Alves <boteistem@gmail.com>
 * @copyrigh (c) 2024
 * @license  Free
 */
namespace CR0\HTTPClient;
use CR0\HTTPClient\Api\ClientInterface;
use CR0\HTTPClient\Api\HttpResponse;
use CR0\HTTPClient\Validation\Rules;
use CR0\HTTPClient\Factory\Adapter;

final class Client implements ClientInterface 
{
    private Rules $validation;
    private array $options = [];
    private array $headers = [];
    private array $querys = [];
    private array $timeouts = [30, 30];
    private int $redirects = 0;
    private string $requestType = 'raw';
    private string $method = 'POST';
    private string $body = '';
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
    /**
     * reset values
     *
     * @return void
     */
    public function reset() : void{
        $this->body = '';
        $this->headers = [];
        $this->method = 'POST';
        $this->options = [];
        $this->querys = [];
        $this->requestType = 'raw';
        $this->redirects = 0;
    }
    /**
     * setMaxRedirect
     *
     * @param  int $max
     * @return self
     */
    public function setMaxRedirect(int $max = 1) : self{
        $this->redirects = $max;
        return $this;
    }   
    /**
     * getMaxRedirect
     *
     * @return int
     */
    public function getMaxRedirect() : int{
        return $this->redirects;
    }
    /**
     * send request and return body from response
     *
     * @return HttpResponse
     */ 
    /**
     * setTimeOut
     *
     * time in seconds
     * @param  int $timeout
     * @param  int $timeexpired
     * @return self
     */
    public function setTimeOut(int $timeout = 30, int $timeexpired = 30) : self{
        $this->timeouts = [
            $timeout, $timeexpired
        ];
        return $this;
    }  
    /**
     * get a array with 2 values: time out and timeoutexpired
     *
     * @return array
     */
    public function getTimeOut() : array{
        return $this->timeouts;
    }    
    /**
     * set request type to json
     *
     * @return self
     */
    public function isJson() : self{
        $this->requestType = 'json';
        return $this;
    }    
    /**
     * set request type to form
     *
     * @return self
     */
    public function isForm() : self{
        $this->requestType = 'form';
        return $this;
    }    
    /**
     * get request type
     *
     * @return string
     */
    public function getRequestType() : string{
        return $this->requestType;
    }    
    /**
     * get base url
     *
     * @return string
     */
    public function getBaseUrl() : string{
        return $this->baseurl;
    }    
    /**
     * send the request and return HttReponse
     *
     * @param string $uri
     * @return HttpResponse | \Exception
     */
    public function send(string $uri) : HttpResponse | \Exception{
        try{
            $validation = $this->validation->execute();
            if (!$validation){
                throw new \Exception('Validation Error');
            }
            $driver = Adapter::create($this);
            return $driver->execute($uri);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }    
    /**
     * verify if is empty
     *
     * @param  mixed $var
     * @return bool
     */
    private function isEmpty($var){
        return empty($var);
    }
}