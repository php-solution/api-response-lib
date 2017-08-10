<?php
namespace Tests;

use PhpSolution\ApiResponseLib\Configuration\ListConfiguration;
use PhpSolution\ApiResponseLib\TestCase\ResponseAssertTrait;
use PhpSolution\ApiResponseLib\Response\Decorator\ResponseDecoratorTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Tests\Imitator\ResponseDecoratorImitator;

/**
 * @see ResponseDecoratorTrait
 */
class ResponseDecoratorTest extends TestCase
{
    use ResponseAssertTrait;

    /**
     * @see ResponseDecoratorTrait::response()
     * @see ResponseDecoratorTrait::okResponse()
     */
    public function testOkResponse()
    {
        $data = [1, '2' => 3, 'a' => 'b'];

        $response = (new ResponseDecoratorImitator())->response($data);
        $response = $this->assertCorrectJsonResponse($response);
        $this->assertArraySubset($data, $response);
        $this->assertArraySubset($response, $data);
    }

    /**
     * @see ResponseDecoratorTrait::response()
     * @see ResponseDecoratorTrait::listResponse()
     */
    public function testListResponse()
    {
        $data = [1, '2' => 3, 'a' => 'b'];

        $response = (new ResponseDecoratorImitator())->response($data, new ListConfiguration(17));
        $response = $this->assertCorrectJsonResponse($response);
        $this->assertEquals(17, $response['count']);
        $this->assertArraySubset($data, $response['list']);
    }

    /**
     * @see ResponseDecoratorTrait::response()
     * @see ResponseDecoratorTrait::validationErrorResponse()
     */
    public function testValidationErrorResponse()
    {
        $errors = new ConstraintViolationList();
        $errors->add(new ConstraintViolation('Message', 'Template', [], null, 'email', null));

        $response = (new ResponseDecoratorImitator())->response($errors);
        $response = $this->assertErrorJsonResponse($response);
        $this->assertEquals('email', $response[0]['propertyPath']);
        $this->assertEquals('Message', $response[0]['message']);
    }
}