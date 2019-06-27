<?php

namespace Hendeavors\Http\Request\Resource;

use Hendeavors\Contracts\Auth\AccessInterface;
use Hendeavors\Http\Request\Headers;

abstract class Resource
{
    abstract protected function headers() : Headers;

    abstract protected function endPoint() : string;

    protected function request()
    {
        // guzzle
        $client = new Client([
            'base_uri' => "https://sandbox.healthendeavors.com",
            'headers' => $this->headers()->toArray()
        ]);

        $client->getHttpClient()->get($this->endPoint(), [
            'headers' => $client->headers(),
            'query' => [
                'page' => request('page', 1),
                'per_page' => request('per_page', 15)
            ]
        ]);
    }
}
