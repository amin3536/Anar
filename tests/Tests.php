<?php

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Artisan;

/**
 * Created by PhpStorm.
 * User: amin
 * Date: 3/22/19
 * Time: 11:25 PM.
 */
class Tests extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * Create  Service provider.
     * @return void
     */
    public function testCreateRepoServiceProvider()
    {
        Artisan::call('make:repositoryServiceProvider', [
            'name' => 'RepositoryServiceProvider',
        ]);
        $this->assertTrue(true);
    }
}
