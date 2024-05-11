<?php

namespace amin3520\Anar\Tests;

use amin3520\Anar\AnarServiceProvider;
use Orchestra\Testbench\TestCase;


abstract class BaseTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }
    /**
     * Add the package provider.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getPackageProviders($app): array
    {
        return [AnarServiceProvider::class];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'test');
        $app['config']->set('database.connections.test', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
