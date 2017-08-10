<?php
namespace Tests\Imitator;

use PhpSolution\ApiResponseLib\Response\Decorator\ResponseDecoratorTrait;
use PhpSolution\ApiResponseLib\Response\Factory\ResponseFactoryInterface;

/**
 * ResponseDecoratorImitator
 */
class ResponseDecoratorImitator
{
    use ResponseDecoratorTrait;

    /**
     * {@inheritdoc}
     */
    protected function getResponseFactory(): ResponseFactoryInterface
    {
        return new ResponseFactoryImitator();
    }
}