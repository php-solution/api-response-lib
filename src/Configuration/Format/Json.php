<?php

namespace PhpSolution\ApiResponseLib\Configuration\Format;

/**
 * Json
 */
class Json implements FormatInterface
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return 'json';
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return 'application/json';
    }
}