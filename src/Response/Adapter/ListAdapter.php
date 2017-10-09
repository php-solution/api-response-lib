<?php

namespace PhpSolution\ApiResponseLib\Response\Adapter;

use PhpSolution\ApiResponseLib\Configuration\ListConfiguration;

/**
 * ListAdapter
 */
class ListAdapter
{
    /**
     * @var array
     */
    private $list;
    /**
     * @var ListConfiguration
     */
    private $configuration;

    /**
     * @param array $list
     * @param int   $page
     * @param int   $totalCount
     */
    public function __construct(array $list, int $page, int $totalCount)
    {
        $this->list = $list;
        $this->configuration = new ListConfiguration($page, $totalCount);
    }

    /**
     * @return array
     */
    public function getList(): array
    {
        return $this->list;
    }

    /**
     * @return ListConfiguration
     */
    public function getConfiguration(): ListConfiguration
    {
        return $this->configuration;
    }
}