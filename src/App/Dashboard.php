<?php

namespace App;

use Github\Client;

class Dashboard
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function all()
    {
        return array_merge(
            [],
            $this->client->api('issue')->org('KnpLabs', ['state' => 'open'])
        );
    }
}
