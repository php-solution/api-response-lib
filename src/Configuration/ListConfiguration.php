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
    private $page;
    /**
     * @var int
     */
    private $totalCount;

    /**
     * @param int      $page
     * @param int|null $totalCount
     */
    public function __construct(int $page, int $totalCount)
    {
        parent::__construct();
        $this->page = $page;
        $this->totalCount = $totalCount;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     *
     * @return self
     */
    public function setPage(int $page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
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

    /**
     * @return array
     */
    public function getData(): array
    {
        $data =  parent::getData();
        $data['page'] = $this->getPage();
        $data['total'] = $this->getTotalCount();

        return $data;
    }
}