<?php

namespace Tests\Unit;

use App\Models\UuidModel;
use Tests\TestCase;

class UuidModelTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_Model()
    {
        $model = app(UuidModel::class);

        $this->assertObjectHasAttribute('incrementing', $model);
        $this->assertEquals('string', $model->getKeyType());
        $this->assertIsString($model->getKeyType());
    }
}
