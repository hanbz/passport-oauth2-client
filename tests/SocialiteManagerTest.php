<?php

namespace hanbz\PassportClient\Tests;

use hanbz\PassportClient\Contracts\Factory;
use hanbz\PassportClient\SocialiteServiceProvider;
use hanbz\PassportClient\Two\GithubProvider;
use Orchestra\Testbench\TestCase;

class SocialiteManagerTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('services.github', [
            'client_id' => 'github-client-id',
            'client_secret' => 'github-client-secret',
            'redirect' => 'http://your-callback-url',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [SocialiteServiceProvider::class];
    }

    public function test_it_can_instantiate_the_github_driver()
    {
        $factory = $this->app->make(Factory::class);

        $provider = $factory->driver('github');

        $this->assertInstanceOf(GithubProvider::class, $provider);
    }
}
