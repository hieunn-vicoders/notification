<?php

namespace VCComponent\Laravel\Notification\Test;

use Cviebrock\EloquentSluggable\ServiceProvider;
use Dingo\Api\Provider\LaravelServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use VCComponent\Laravel\Notification\Providers\NotificationServiceProvider;
use VCComponent\Laravel\Notification\Test\Stub\Entities\User;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return HaiCS\Laravel\Generator\Providers\GeneratorServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [
            LaravelServiceProvider::class,
            NotificationServiceProvider::class,
            ServiceProvider::class,
            \Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
            \Illuminate\Auth\AuthServiceProvider::class
        ];
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(__DIR__ . '/Stub/Factories');
        $this->loadMigrationsFrom(__DIR__ . '/Stub/migrations');
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'base64:TEQ1o2POo+3dUuWXamjwGSBx/fsso+viCCg9iFaXNUA=');
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $app['config']->set('webpress-notification', [
            'namespace' => '',

            'models' => [
                'notifcation' => \VCComponent\Laravel\Notification\Entities\Notification::class,
                'notifcation-setting' => \VCComponent\Laravel\Notification\Entities\NotificationSetting::class,
                'template-variable' => \VCComponent\Laravel\Notification\Entities\TemplateVariable::class,
            ],

            'base_url' => env('WEBPRESS_NOTIFICATION_BASE_URL', 'https://api.dev.webpress.vn/communication'),

            'version'  => env('WEBPRESS_NOTIFICATION_VERSION', 'v1.0'),

            'auth_middleware' => [
                'admin'    => [
                    [
                        'middleware' => null,
                        'except'     => null,
                    ],
                ],
            ],
        ]);
        $app['config']->set('jwt.secret', '5jMwJkcDTUKlzcxEpdBRIbNIeJt1q5kmKWxa0QA2vlUEG6DRlxcgD7uErg51kbBl');
        $app['config']->set('auth.providers.users.model', User::class);
        $app['config']->set('repository.cache.enabled', false);
        $app['config']->set('api', [
            'standardsTree'      => 'x',
            'subtype'            => '',
            'version'            => 'v1',
            'prefix'             => 'api',
            'domain'             => null,
            'name'               => null,
            'conditionalRequest' => true,
            'strict'             => false,
            'debug'              => true,
            'errorFormat'        => [
                'message'     => ':message',
                'errors'      => ':errors',
                'code'        => ':code',
                'status_code' => ':status_code',
                'debug'       => ':debug',
            ],
            'middleware'         => [],
            'auth'               => [],
            'throttling'         => [],
            'transformer'        => \Dingo\Api\Transformer\Adapter\Fractal::class,
            'defaultFormat'      => 'json',
            'formats'            => [
                'json' => \Dingo\Api\Http\Response\Format\Json::class,
            ],
            'formatsOptions'     => [
                'json' => [
                    'pretty_print' => false,
                    'indent_style' => 'space',
                    'indent_size'  => 2,
                ],
            ],
        ]);
    }

    protected function assertResponsePagiated($response)
    {
        $response->assertJsonStructure([
            'meta' => [
                'pagination' => [
                    'total', 'count', 'per_page', 'current_page', 'total_pages', 'links' => [],
                ],
            ],
        ]);
    }

    protected function assertValidator($response, $field, $error_message)
    {
        $response->assertStatus(422);
        $response->assertJson([
            'message' => "The given data was invalid.",
            "errors" => [
                $field => [
                    $error_message,
                ],
            ],
        ]);
    }
}
