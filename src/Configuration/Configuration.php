<?php

namespace PhpSolution\ApiResponseLib\Configuration;

use PhpSolution\ApiResponseLib\Configuration\Format\FormatInterface;
use PhpSolution\ApiResponseLib\Configuration\Format\Json;

/**
 * Configuration
 */
class Configuration
{
    /**
     * @var array
     */
    private $data = [];
    /**
     * @var int|null
     */
    private $status;
    /**
     * @var FormatInterface
     */
    private $format;
    /**
     * @var bool
     */
    private $serializeNull = true;
    /**
     * @var bool
     */
    private $archive = false;
    /**
     * @var array
     */
    private $groups = ['Default'];

    /**
     * @param FormatInterface|null $format
     */
    public function __construct(FormatInterface $format = null)
    {
        $this->format = $format ?: new Json();
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus():? int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return self
     */
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return FormatInterface
     */
    public function getFormat(): FormatInterface
    {
        return $this->format;
    }

    /**
     * @param FormatInterface $format
     *
     * @return self
     */
    public function setFormat(FormatInterface $format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSerializeNull(): bool
    {
        return $this->serializeNull;
    }

    /**
     * @param bool $serializeNull
     *
     * @return self
     */
    public function setSerializeNull($serializeNull)
    {
        $this->serializeNull = $serializeNull;

        return $this;
    }

    /**
     * @return bool
     */
    public function isArchive(): bool
    {
        return $this->archive;
    }

    /**
     * @param bool $archive
     *
     * @return self
     */
    public function setArchive($archive)
    {
        $this->archive = (bool) $archive;

        return $this;
    }

    /**
     * @return array
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * @param array $groups
     *
     * @return self
     */
    public function setGroups(array $groups)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * @param string $group
     *
     * @return self
     */
    public function addGroup(string $group)
    {
        if (!$this->hasGroup($group)) {
            $this->groups[] = $group;
        }

        return $this;
    }

    /**
     * @param string $group
     *
     * @return self
     */
    public function removeGroup(string $group)
    {
        if (!$this->hasGroup($group)) {
            unset($this->groups[array_search($group, $this->groups)]);
        }

        return $this;
    }

    /**
     * @param string $group
     *
     * @return bool
     */
    public function hasGroup(string $group): bool
    {
        return in_array($group, $this->groups);
    }
}