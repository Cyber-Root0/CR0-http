<?php
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
     * execute
     *
     * @return void
     */
    public function execute() : bool{
        return true;        
    }
}