<?php
/*
 * @software CR0 HTTP Client - Request library focused on practicality and simplicity
 * @author Bruno Venancio Alves <boteistem@gmail.com>
 * @copyrigh (c) 2024
 * @license  Free
 */
namespace CR0\HTTPClient\Adapter;
use CR0\HTTPClient\Api\DriverInterface;
use CR0\HTTPClient\Api\HttpResponse;
use CR0\HTTPClient\Api\ClientInterface;
use CR0\HTTPClient\Builder\BuilderResponse;
/**
 * Curl Adapter
 */
class Curl implements DriverInterface
{
    protected $curl;
    private string $body;    
    /**
     * __construct
     *
     * @param ClientInterface $client
     * @return void
     */
    public function __construct(
        protected ClientInterface $client
    ){
        $this->curl = curl_init();
        $this->setHeader();
        $this->setBody();
        $this->prepare();
    }    
    /**
     * set header
     *
     * @return self
     */
    public function setHeader() : self{
        $clientHeaders = $this->client->getHeader();
        $headers = [];
        $requestType = $this->client->getRequestType();
        if ($requestType == 'json'){
            $headers[] = "Content-Type: application/json";
        }
        if ($requestType == 'form'){
            $headers[] = "Content-Type: multipart/form-data";
        }
       if (!empty($clientHeaders)){ 
            $headers = [];
            foreach($clientHeaders as $key => $header){
                $headers[] = "{$key}: {$header}";
            }
       }
       $this->addConfig(CURLOPT_HTTPHEADER, $headers);
       $this->addConfig(CURLOPT_HEADER, true);
       return $this;
    }    
    /**
     * setBody
     *
     * @return self
     */
    public function setBody() : self{
        $body = $this->client->getBody();
        $method = $this->client->getMethod();
        if (!empty($body) && $method != "GET"){
            $this->addConfig(CURLOPT_POSTFIELDS, $body);
        }
        return $this;
    }    
    /**
     * Main execute
     *
     * @param  string $uri
     * @return HttpResponse
     */
    public function execute(string $uri) : HttpResponse{
        $this->prepareUrl($uri);
        $response = curl_exec($this->curl);
        if ($response == null){
            throw new \Exception('Servidor remoto indisponivel');
        }
        return $this->buildResponse($response);
    }    
    /**
     * build Api http response
     *
     * @param  string $response
     * @return HttpResponse
     */
    private function buildResponse(string $response) : HttpResponse{
        $builder = new BuilderResponse();
        $builder->setResponse($response);
        $httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        $headers = $this->getHeaders($response);
        $cookies = $this->getCookies($response);
        $body = $this->getResponse();
        return $builder->setCookies($cookies)->setHeaders($headers)
            ->setResponse($body)->setStatusCode($httpCode)->build();
    }    
    /**
     * prepare request before execute
     *
     * @return void
     */
    public function prepare(){
        $method = $this->client->getMethod();
        $this->addConfig(CURLOPT_RETURNTRANSFER, true);
        $this->addConfig(CURLOPT_SSL_VERIFYPEER, false);
        if ($method!="POST"){
            $this->addConfig(CURLOPT_CUSTOMREQUEST, $method);
        }else{
            $this->addConfig(CURLOPT_POST, true);
        }
        $this->addConfig(CURLOPT_MAXREDIRS, $this->client->getMaxRedirect());
        
        $timeouts = $this->client->getTimeOut();
        $this->addConfig(CURLOPT_CONNECTTIMEOUT, $timeouts[0]);
        $this->addConfig(CURLOPT_TIMEOUT, $timeouts[1]);
        $this->addConfig(CURLOPT_USERAGENT, 'CR0\HttpClient 1.0 (PHP)');
    }
    private function addConfig(string $key, $valor){
        curl_setopt($this->curl, $key, $valor);
    }    
    /**
     * prepareUrl
     *
     * @param  string $uri
     * @return void
     */
    private function prepareUrl(string $uri){
        $method = $this->client->getMethod();
        $baseUrl = $this->client->getBaseUrl();
        $url = '';
        if ($method=="GET"){
            $querystrinng = http_build_query(
                $this->client->getQuery()
            );
            $url = $baseUrl.$uri."?".$querystrinng;
            $this->addConfig(CURLOPT_URL, $url);
        }else{
            $url = $baseUrl.$uri;
            $this->addConfig(CURLOPT_URL,$url);
        }
    }    
    /**
     * getHeaders
     *
     * @param  string $response
     * @return array
     */
    private function getHeaders(string $response){
        list($headers, $body) = explode("\r\n\r\n", $response, 2);
        $this->setResponse($body);
        $headers = explode("\n", $headers);
        unset($headers[0]);
        return $headers;
    }    
    /**
     * setResponse
     *
     * @param  mixed $body
     * @return void
     */
    private function setResponse(string $body){
        $this->body = $body;
    }    
    /**
     * getResponse
     *
     * @return string
     */
    private function getResponse(){
        return $this->body;
    }    
    /**
     * getCookies
     *
     * @param  string $response
     * @return array
     */
    private function getCookies(string $response){
        list($headers, $body) = explode("\r\n\r\n", $response, 2);
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $headers, $matches);
        $cookies = array();
        foreach ($matches[1] as $match) {
            parse_str($match, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }
        return !empty($cookies) ? $cookies : [];   
    }
}