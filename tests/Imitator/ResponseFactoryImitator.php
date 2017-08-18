<?php
namespace Tests\Imitator;

use PhpSolution\ApiResponseLib\Configuration\Configuration;
use PhpSolution\ApiResponseLib\Response\Factory\ResponseFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * ResponseFactoryImitator
 */
class ResponseFactoryImitator implements ResponseFactoryInterface
{
    /**
     * @param mixed         $data
     * @param Configuration $configuration
     *
     * @return Response
     */
    public function createResponse($data, Configuration $configuration): Response
    {
        if (array_key_exists('errors', $data)) {
            $errors = [];
            foreach ($data['errors'] as $error) {
                $errors[] = is_object($error)
                    ? (object) ['propertyPath' => $error->getPropertyPath(), 'message' => $error->getMessage()]
                    : $error;
            }
            $data['errors'] = $errors;
        }

        return new JsonResponse($data, $configuration->getStatus());
    }
}