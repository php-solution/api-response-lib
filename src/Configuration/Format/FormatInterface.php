<?php

namespace PhpSolution\ApiResponseLib\Configuration\Format;

/**
 * FormatInterface
 */
interface FormatInterface
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getContentType(): string;
}