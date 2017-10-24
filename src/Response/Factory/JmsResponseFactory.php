<?php

namespace PhpSolution\ApiResponseLib\Response\Factory;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use PhpSolution\ApiResponseLib\Configuration\Configuration;
use Symfony\Component\HttpFoundation\Response;

/**
 * JmsResponseFactory
 */
class JmsResponseFactory implements ResponseFactoryInterface
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function createResponse($data, Configuration $configuration): Response
    {
        $serializeContext = SerializationContext::create()
            ->setSerializeNull($configuration->isSerializeNull());
        if (!empty($groups = $configuration->getGroups())) {
            $serializeContext->setGroups($groups);
        }

        $content = $this->serializer->serialize($data, $configuration->getFormat()->getType(), $serializeContext);

        $headers = [
            'Content-Type' => $configuration->getFormat()->getContentType(),
        ];
        if ($configuration->isArchive()) {
            $content = gzencode($content);
            $headers['Content-Encoding'] = 'gzip';
        }

        return new Response($content, $configuration->getStatus(), $headers);
    }
}