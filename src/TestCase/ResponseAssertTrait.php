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
     * @param int|null $status
     */
    protected function assertCorrectResponse(Response $response, int $status = null)
    {
        if (null === $status) {
            $this->assertGreaterThanOrEqual(Response::HTTP_OK, $response->getStatusCode());
            $this->assertLessThan(Response::HTTP_MULTIPLE_CHOICES, $response->getStatusCode());
        } else {
            $this->assertEquals($status, $response->getStatusCode());
        }
    }

    /**
     * @param Response $response
     * @param int|null $status
     *
     * @return mixed
     */
    protected function assertOkJsonResponse(Response $response, int $status = null)
    {
        $this->assertCorrectResponse($response, $status);
        $responseData = json_decode($response->getContent(), true);

        return $responseData;
    }

    /**
     * @param Response $response
     * @param int|null $status
     *
     * @return mixed
     */
    protected function assertCorrectJsonResponse(Response $response, int $status = null)
    {
        return $this->assertOkJsonResponse($response, $status)['data'];
    }

    /**
     * @param Response $response
     * @param int|null $status
     */
    protected function assertErrorResponse(Response $response, int $status = null)
    {
        null === $status
            ? $this->assertGreaterThanOrEqual(Response::HTTP_BAD_REQUEST, $response->getStatusCode())
            : $this->assertEquals($status, $response->getStatusCode());
    }

    /**
     * @param Response $response
     * @param int|null $status
     *
     * @return mixed
     */
    protected function assertErrorJsonResponse(Response $response, int $status = null)
    {
        $this->assertErrorResponse($response, $status);
        $responseData = json_decode($response->getContent(), true);

        return $responseData['error'];
    }

    /**
     * @param Response $response
     *
     * @return mixed
     */
    protected function assertValidationErrorJsonResponse(Response $response)
    {
        return $this->assertErrorJsonResponse($response, Response::HTTP_BAD_REQUEST);
    }
}
