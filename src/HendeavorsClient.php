<?php

namespace Hendeavors;

use Hendeavors\Contracts\ClientInterface;
use Hendeavors\Contracts\ProviderInterface;
use Hendeavors\Contracts\Http\Request\TokenRequestInterface;
use League\OAuth2\Client\Provider\GenericProvider;

class HendeavorsClient implements ClientInterface
{
    private $provider;

    private $id;

    private $secret;

    private $redirectUri;

    public function __construct(ProviderInterface $provider, string $id, string $secret, string $redirectUri)
    {
        $this->provider = $provider;

        $this->id = $id;

        $this->secret = $secret;

        $this->redirectUri = $redirectUri;
    }

    public function getAccessToken(TokenRequestInterface $request)
    {
        return $request->getAccessToken();
    }

    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    public function getProvider()
    {
        return new GenericProvider([
            'clientId'                => $this->id,    // The client ID assigned to you by the provider
            'clientSecret'            => $this->secret,   // The client password assigned to you by the provider
            'redirectUri'             => $this->getRedirectUri(),
            'urlAuthorize'            => $this->provider->getAuthorizationUrl(),
            'urlAccessToken'          => $this->provider->getTokenUrl(),
            'urlResourceOwnerDetails' => 'http://brentertainment.com/oauth2/lockdin/resource'
        ]);
    }
}
