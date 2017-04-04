<?php

use Pwnz22\Taggz\TaggzServiceProvider;

abstract class TestCase extends Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [TaggzServiceProvider::class];
    }

    public function setUp()
    {
        parent::setUp();

        Illuminate\Database\Eloquent\Model::unguard();

        $this->loadLaravelMigrations(['--database' => 'testbench']);
    }

    public function tearDown()
    {
        \Schema::drop('lessons');
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');

        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        \Schema::create('lessons', function ($table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    }
}