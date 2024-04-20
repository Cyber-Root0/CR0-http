<?php
namespace CR0\HTTPClient\Factory;
use CR0\HTTPClient\Client;
use CR0\HTTPClient\Api\DriverInterface;
use CR0\HTTPClient\Adapter\Curl;
class Adapter
{    
    /**
     * Factory to create a Custom Driver for init the request
     *
     * @param  Client $client
     * @return Driverinterface
     */
    public static function create(Client $client) : DriverInterface{
        $options = $client->getOptions();
        if (isset($options['driver'])){
            $driver = $options['driver'];
            return match($driver){
                'curl' => new Curl($client),
                default => new Curl($client)
            };
        }
        return new Curl($client);
    }
}