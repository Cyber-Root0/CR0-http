<?php
/*
 * @software CR0 HTTP Client - Request library focused on practicality and simplicity
 * @author Bruno Venancio Alves <boteistem@gmail.com>
 * @copyrigh (c) 2024
 * @license  Free
 */
namespace CR0\HTTPClient\Api;
use CR0\HTTPClient\Api\HttpResponse;
use CR0\HTTPClient\Api\ClientInterface;
interface DriverInterface
{    
    /**
     * __construct
     *
     * @param  mixed $client
     * @return void
     */
    public function __construct(ClientInterface $client);    
    /**
     * setHeader
     *
     * @return void
     */
    public function setHeader();    
    /**
     * setBody
     *
     * @return void
     */
    public function setBody();    
    /**
     * execute
     *
     * @param  mixed $uri
     * @return HttpResponse
     */
    public function execute(string $uri) : HttpResponse;
}