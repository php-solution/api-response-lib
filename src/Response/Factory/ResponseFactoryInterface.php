<?php
namespace PhpSolution\ApiResponseLib\Response\Factory;

use PhpSolution\ApiResponseLib\Configuration\Configuration;
use Symfony\Component\HttpFoundation\Response;

/**
 * ResponseFactoryInterface
 */
interface ResponseFactoryInterface
{
    /**
     * @param mixed         $data
     * @param Configuration $configuration
     *
     * @return Response
     */
    public function createResponse($data, Configuration $configuration): Response;
}