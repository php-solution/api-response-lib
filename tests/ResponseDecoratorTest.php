<?php

namespace Tests;

use PhpSolution\ApiResponseLib\Configuration\ListConfiguration;
use PhpSolution\ApiResponseLib\TestCase\ResponseAssertTrait;
use PhpSolution\ApiResponseLib\Response\Decorator\ResponseDecoratorTrait;
use PHPUnit\Framework\TestCase;
use Tests\Imitator\ResponseDecoratorImitator;

/**
 * @see ResponseDecoratorTrait
 */
class ResponseDecoratorTest extends TestCase
{
    use ResponseAssertTrait;

    /**
     * @see ResponseDecoratorTrait::response()
     * @see ResponseDecoratorTrait::listResponse()
     */
    public function testListResponse(): void
    {
        $data = [1, '2' => 3, 'a' => 'b'];

        $response = (new ResponseDecoratorImitator())->response($data, new ListConfiguration(0, 17));
        $response = $this->assertOkJsonResponse($response);
        $this->assertEquals(17, $response['count']);
        $this->assertArraySubset($data, $response['data']);
    }

    /**
     * @see ResponseDecoratorTrait::response()
     * @see ResponseDecoratorTrait::okResponse()
     */
    public function testOkResponse(): void
    {
        $data = [1, '2' => 3, 'a' => 'b'];

        $response = (new ResponseDecoratorImitator())->response($data);
        $response = $this->assertCorrectJsonResponse($response);
        $this->assertArraySubset($data, $response);
        $this->assertArraySubset($response, $data);
    }
}