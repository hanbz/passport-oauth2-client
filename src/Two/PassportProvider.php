<?php

namespace hanbz\PassportClient\Two;

use Illuminate\Support\Arr;

class PassportProvider extends AbstractProvider implements ProviderInterface
{
    protected $domain = '';

    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = ['*'];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase($this->domain . '/oauth/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return $this->domain . '/oauth/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get($this->domain . '/api/user', [
            'query' => [
                'prettyPrint' => 'false',
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        // Deprecated: Fields added to keep backwards compatibility in 4.0. These will be removed in 5.0
        $user['id'] = Arr::get($user, 'id');
        $user['verified_email'] = Arr::get($user, 'email_verified');
        $user['link'] = Arr::get($user, 'profile');

        return (new User)->setRaw($user)->map([
            'id' => Arr::get($user, 'id'),
            'nickname' => Arr::get($user, 'nickname'),
            'name' => Arr::get($user, 'name'),
            'email' => Arr::get($user, 'email'),
            'avatar' => $avatarUrl = Arr::get($user, 'picture'),
            'avatar_original' => $avatarUrl,
        ]);
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }
}
