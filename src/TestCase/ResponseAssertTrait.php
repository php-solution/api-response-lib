<?php
namespace PhpSolution\ApiResponseLib\TestCase;

use Symfony\Component\HttpFoundation\Response;

/**
 * ResponseAssertTrait
 */
trait ResponseAssertTrait
{
    /**
     * @param Response $response
     */
    protected function assertCorrectResponse(Response $response)
    {
        $this->assertGreaterThanOrEqual(Response::HTTP_OK, $response->getStatusCode());
        $this->assertLessThan(Response::HTTP_MULTIPLE_CHOICES, $response->getStatusCode());
    }

    /**
     * @param Response $response
     *
     * @return array
     */
    protected function assertCorrectJsonResponse(Response $response)
    {
        $this->assertCorrectResponse($response);
        $responseData = json_decode($response->getContent(), true);

        return $responseData['data'];
    }

    /**
     * @param Response $response
     */
    protected function assertErrorResponse(Response $response)
    {
        $this->assertGreaterThanOrEqual(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    /**
     * @param Response $response
     *
     * @return mixed
     */
    protected function assertErrorJsonResponse(Response $response)
    {
        $this->assertErrorResponse($response);
        $responseData = json_decode($response->getContent(), true);

        return $responseData['errors'];
    }

    /**
     * @param Response $response
     *
     * @return mixed
     */
    protected function assertValidationErrorJsonResponse(Response $response)
    {
        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

        return $responseData['errors'];
    }
}