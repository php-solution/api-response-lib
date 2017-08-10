<?php
namespace PhpSolution\ApiResponseLib\Configuration;

/**
 * ListConfiguration
 */
class ListConfiguration extends Configuration
{
    /**
     * @var int
     */
    private $totalCount;

    /**
     * @param int|null $totalCount
     */
    public function __construct(int $totalCount = null)
    {
        parent::__construct();
        $this->totalCount = $totalCount;
    }

    /**
     * @return int|null
     */
    public function getTotalCount():? int
    {
        return $this->totalCount;
    }

    /**
     * @param int $totalCount
     *
     * @return self
     */
    public function setTotalCount(int $totalCount)
    {
        $this->totalCount = $totalCount;

        return $this;
    }
}