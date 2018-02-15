<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        // lets disable exception handling by default
        $this->withoutExceptionHandling();
    }

    /**
     * Generates attributes for a model
     * @param  array $overrides Manual overrides when making an attribute
     * @return array
     */
    protected function attributes($model, $overrides = [])
    {
        return factory('App\\' . $model)->make($overrides)->toArray();
    }

    /**
     * Creates a model
     * @param  string $model
     * @param  array  $attributes
     * @param  int $total The number of records to create
     * @return \Illuminate\Database\Eloquent\FactoryBuilder
     */
    protected function create($model, $attributes = [], $total = 1)
    {
        if ($total > 1)  {
            return factory('App\\' . $model, $total)->create($attributes);
        }

        return factory('App\\' . $model)->create($attributes);
    }
}
