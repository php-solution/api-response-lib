<?php
namespace PhpSolution\ApiResponseLib\Response\Decorator;

use PhpSolution\ApiResponseLib\Configuration\Configuration;
use PhpSolution\ApiResponseLib\Configuration\ListConfiguration;
use PhpSolution\ApiResponseLib\Response\Factory\ResponseFactoryInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * ResponseDecoratorTrait
 */
trait ResponseDecoratorTrait
{
    /**
     * @param mixed              $data
     * @param Configuration|null $configuration
     *
     * @return Response
     */
    public function response($data, Configuration $configuration = null): Response
    {
        switch (true) {
            case $data instanceof Form:
                return $this->formErrorResponse($data, $configuration);
            case $data instanceof ConstraintViolationListInterface:
                return $this->validationErrorResponse($data, $configuration);
            case is_array($data) && ($configuration instanceof ListConfiguration):
                return $this->listResponse($data, $configuration);
            default:
                return $this->okResponse($data, $configuration);
        }
    }

    /**
     * @param mixed              $data
     * @param Configuration|null $configuration
     *
     * @return Response
     */
    public function okResponse($data, Configuration $configuration = null): Response
    {
        $configuration = (null === $configuration) ? new Configuration() : $configuration;
        if (null === $configuration->getStatus()) {
            $configuration->setStatus(Response::HTTP_OK);
        }
        $fullData = $configuration->getData();
        $fullData['data'] = $data;

        return $this->getResponseFactory()->createResponse($fullData, $configuration);
    }

    /**
     * @param array                  $list
     * @param ListConfiguration|null $configuration
     *
     * @return Response
     */
    public function listResponse(array $list, ListConfiguration $configuration = null): Response
    {
        $configuration = (null === $configuration) ? new ListConfiguration() : $configuration;
        $data = [
            'count' => null === $configuration->getTotalCount() ? count($list) : $configuration->getTotalCount(),
            'list' => $list,
        ];

        return $this->okResponse($data, $configuration);
    }

    /**
     * @param mixed              $errors
     * @param Configuration|null $configuration
     *
     * @return Response
     */
    public function errorResponse($errors, Configuration $configuration = null): Response
    {
        $configuration = (null === $configuration) ? new Configuration() : $configuration;
        if (null === $configuration->getStatus()) {
            $configuration->setStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $fullData = $configuration->getData();
        $fullData['errors'] = $errors;

        return $this->getResponseFactory()->createResponse($fullData, $configuration);
    }

    /**
     * @param FormInterface      $form
     * @param Configuration|null $configuration
     *
     * @return Response
     */
    public function formErrorResponse(FormInterface $form, Configuration $configuration = null): Response
    {
        if ($form->isSubmitted()) {
            return $this->validationErrorResponse($form->getErrors(true), $configuration);
        }

        return $this->validationErrorResponse(['Expected values were not submitted'], $configuration);
    }

    /**
     * @param mixed              $errors
     * @param Configuration|null $configuration
     *
     * @return Response
     */
    public function validationErrorResponse($errors, Configuration $configuration = null): Response
    {
        $configuration = (null === $configuration) ? new Configuration() : $configuration;
        if (null === $configuration->getStatus()) {
            $configuration->setStatus(Response::HTTP_BAD_REQUEST);
        }

        return $this->errorResponse($errors, $configuration);
    }

    /**
     * @return ResponseFactoryInterface
     */
    abstract protected function getResponseFactory(): ResponseFactoryInterface;
}