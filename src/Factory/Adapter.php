<?php
namespace CR0\HTTPClient\Factory;
use CR0\HTTPClient\Client;
use CR0\HTTPClient\Adapter\Curl;
class Adapter
{    
    /**
     * Fac
     *
     * @param  Client $client
     * @return void
     */
    public static function create(Client $client) : Curl{
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