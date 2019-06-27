<?php

namespace Hendeavors;

use Hendeavors\Contracts\ProviderInterface;

/**
 * Provide a simple healthendeavors provider definition
 */
class HendeavorsProvider implements ProviderInterface
{
    /**
     * The fully qualified resource to acquire a token
     * @return string
     */
    public function getTokenUrl(): string
    {
        return $this->getBaseUrl() . '/oauth/token';
    }

    /**
     * The fully qualified resource to authorize
     * @return string
     */
    public function getAuthorizationUrl(): string
    {
        return $this->getBaseUrl() . '/oauth/authorize';
    }

    /**
     * Get the full base url and prefix to make api requests
     * @return string the base url and prefix
     */
    public function getApiPrefixUrl(): string
    {
        return $this->getBaseUrl() . '/api';
    }

    protected function getBaseUrl()
    {
        return 'https://sandbox.healthendeavors.com';
    }
}
