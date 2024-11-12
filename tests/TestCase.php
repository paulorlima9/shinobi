<?php

namespace Caffeinated\Shinobi\Tests;

use Caffeinated\Shinobi\Facades\Shinobi;
use Caffeinated\Shinobi\ShinobiServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * Set up the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/factories');

        $this->loadLaravelMigrations(['--database' => 'testing']);
        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--path' => realpath(__DIR__.'/../migrations'),
        ]);

        View::addLocation(__DIR__.'/resources/views');
    }

    /**
     * Define the environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ShinobiServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Shinobi' => Shinobi::class,
        ];
    }

    /**
     * Render a blade view file to a string.
     *
     * @param  string  $path
     * @return string
     */
    protected function renderView($path)
    {
        $html = view($path)->render();

        return trim($html);
    }

    /**
     * Perform a middleware check against a mocked response.
     *
     * @param  string  $middleware
     * @param  array|string  $parameter
     * @return int
     */
    protected function middleware($middleware, $parameter)
    {
        return app()->make($middleware)->handle(new Request(), function () {
            return (new Response())->setContent('<html></html>');
        }, $parameter)->status();
    }
}
