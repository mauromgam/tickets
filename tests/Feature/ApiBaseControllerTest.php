<?php

namespace Tests\Feature;

use App\Http\Controllers\Api\ApiBaseController;
use Tests\TestCase;

class ApiBaseControllerTest extends TestCase
{
    /**
     * @return void
     */
    public function test_EmptyResponse()
    {
        $controller = app(ApiBaseController::class);

        $response = $controller->sendResponse([], 'Test');
        $content  = json_decode($response->getContent(), true);

        $this->assertTrue($content['success']);
        $this->assertEquals('Test', $content['message']);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @return void
     */
    public function test_ErrorResponse()
    {
        $controller = app(ApiBaseController::class);

        $response = $controller->sendError('Test');
        $content  = json_decode($response->getContent(), true);

        $this->assertFalse($content['success']);
        $this->assertEquals('Test', $content['message']);
        $this->assertEquals(500, $response->getStatusCode());
    }
}
