<?php

namespace Hendeavors\Http\Request\Resource;

use Hendeavors\Contracts\Auth\AccessInterface;
use Hendeavors\Contracts\ProviderInterface;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Hendeavors\HendeavorsProvider;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Hendeavors\Model\User as UserModel;

class User implements ResourceInterface
{
    private $token;

    private $provider;

    public function __construct(AccessTokenInterface $token, ProviderInterface $provider)
    {
        $this->token = $token;

        $this->provider = $provider;
    }

    public static function fromToken(AccessTokenInterface $token, ProviderInterface $provider = null)
    {
        if (null === $provider) {
            $provider = new HendeavorsProvider();
        }

        return new static($token, $provider);
    }

    public function first()
    {
        $all = $this->all();

        if (count($all) > 0) {

            return $all[0] ?? null;
        }

        return null;
    }

    public function all(): array
    {
        $users = json_decode($this->request(static::USERS));

        return array_map(function($item) {
            return new UserModel($item);
        }, (array)$users->data);
    }

    public function find(int $userid)
    {
        // find one user e.g. api/users/{user}
    }

    protected function request(string $url)
    {
        $response = $this->client()->get('/api/users', [
            'headers' => [
                'Authorization' => 'Bearer '.$this->token->getToken()
            ],
        ]);

        return (string)$response->getBody();
    }

    protected function client()
    {
        return new Client([
            'base_uri' => $this->provider->getApiPrefixUrl(),
            'headers' => [
                'Content-Type' => 'application/vnd.api+json',
                'Accept' => 'application/vnd.api+json'
            ]
        ]);
    }
}
