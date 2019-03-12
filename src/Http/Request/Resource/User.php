<?php

namespace Hendeavors\Http\Request\Resource;

use Hendeavors\Contracts\Auth\AccessInterface;

class User
{
    private $access;

    public function __construct(AccessInterface $access)
    {
        $this->access = $access;
    }

    public function all()
    {
        // guzzle
        new Client([
            'base_uri' => "https://sandbox.healthendeavors.com",
            'headers' => [
                'Content-Type' => 'application/vnd.api+json',
                'Accept' => 'application/vnd.api+json'
            ]
        ])
        $client->getHttpClient()->get('/api/users', [
        'headers' => $client->headers(),
        'query' => [
            'page' => request('page', 1),
            'per_page' => request('per_page', 15)
        ]
    ]);
    }
}
