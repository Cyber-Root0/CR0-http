<?php
/*
 * @software CR0 HTTP Client - Request library focused on practicality and simplicity
 * @author Bruno Venancio Alves <boteistem@gmail.com>
 * @copyrigh (c) 2024
 * @license  Free
 */
namespace CR0\HTTPClient\Api;
interface HttpResponse
{    
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
}