<?php
namespace CR0\HTTPClient\Adapter;
use CR0\HTTPClient\Api\DriverInterface;
use CR0\HTTPClient\Api\HttpResponse;
use CR0\HTTPClient\Api\ClientInterface;
use CR0\HTTPClient\Builder\BuilderResponse;
use CR0\HTTPClient\Response\CurlResponse;
class Curl implements DriverInterface
{
    public function __construct(
        protected ClientInterface $client
    ){
    }
    public function setHeader() : self{
        return $this;
    }
    public function setBody() : self{
        return $this;
    }
    public function execute(string $uri) : HttpResponse{
        return new CurlResponse(
            (new BuilderResponse())->setResponse('teste')->
            setStatusCode(200)->setHeaders([])->setCookies('aaaa')
        );
    }
}