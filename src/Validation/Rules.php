<?php
/*
 * @software CR0 HTTP Client - Request library focused on practicality and simplicity
 * @author Bruno Venancio Alves <boteistem@gmail.com>
 * @copyrigh (c) 2024
 * @license  Free
 */
namespace CR0\HTTPClient\Validation;
use CR0\HTTPClient\Api\RulesInterface;
use CR0\HTTPClient\Api\ClientInterface;
class Rules implements RulesInterface
{
    public function __construct(
        protected ClientInterface $client
    ){
    }    
    /**
     * create a custom rule for dont execute the request
     *
     * @return bool
     */
    public function execute() : bool{
        return true;        
    }
}