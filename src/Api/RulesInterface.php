<?php
/*
 * @software CR0 HTTP Client - Request library focused on practicality and simplicity
 * @author Bruno Venancio Alves <boteistem@gmail.com>
 * @copyrigh (c) 2024
 * @license  Free
 */
namespace CR0\HTTPClient\Api;
use CR0\HTTPClient\Client;
interface RulesInterface
{       
    /**
     * __construct
     *
     * @param  ClientInterface $client
     * @return void
     */
    public function __construct(ClientInterface $client);    
    /**
     * execute
     *
     * @return bool
     */
    public function execute() : bool;
}