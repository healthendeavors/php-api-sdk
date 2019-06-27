<?php

namespace Hendeavors\Http\Request\Resource;

use Hendeavors\Contracts\Auth\AccessInterface;
use Hendeavors\Model\ExternalPlatformCallback as ExternalPlatformCallbackModel;

class ExternalPlatformCallback
{
    private $token;

    private $provider;

    private $oauthUserId;

    public function __construct(AccessTokenInterface $token, ProviderInterface $provider, int $oauthUserId)
    {
        $this->token = $token;

        $this->provider = $provider;

        $this->oauthUserId = $oauthUserId;
    }

    public static function fromToken(AccessTokenInterface $token, int $oauthUserId, ProviderInterface $provider = null)
    {
        if (null === $provider) {
            $provider = new HendeavorsProvider();
        }

        return new static($token, $provider, $oauthUserId);
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
        $users = json_decode($this->request());

        return array_map(function($item) {
            return new ExternalPlatformCallbackModel($item);
        }, (array)$users->data);
    }

    public function find(int $externalPlatformCallbackId)
    {
        // find one user e.g. api/users/{user}
    }

    protected function request()
    {
        $response = $this->client()->get('/api/users/' . $this->oauthUserId . '/callback-urls', [
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
