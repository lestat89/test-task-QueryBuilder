<?php

namespace App\SQBuilderTraits;

/**
 * Class SimpleQueryBuilderProperty
 * @package App\SQBuilderTraits
 * @trait
 */
trait SimpleQueryPropertyTrait
{
    /**
     * @var array
     */
    private array $select = [];

    /**
     * @var array
     */
    private array $from = [];

    /**
     * @var array
     */
    private array $where = [];

    /**
     * @var array
     */
    private array $groupBy = [];

    /**
     * @var array
     */
    private array $having = [];

    /**
     * @var array
     */
    private array $orderBy = [];

    /**
     * @var int|null
     */
    private ?int $limit = null;

    /**
     * @var int|null
     */
    private ?int $offset = null;

    /**
     * @return bool
     */
    private function isSelect(): bool
    {
        return !empty($this->select);
    }

    /**
     * @return array
     */
    private function getSelect(): array
    {
        return $this->select;
    }

    /**
     * @param array $select
     */
    private function setSelect(array $select): void
    {
        $this->select = $select;
    }

    /**
     * @return bool
     */
    private function isFrom(): bool
    {
        return !empty($this->from);
    }

    /**
     * @return array
     */
    private function getFrom(): array
    {
        return $this->from;
    }

    /**
     * @param array $from
     */
    private function setFrom(array $from): void
    {
        $this->from = $from;
    }

    /**
     * @return bool
     */
    private function isWhere(): bool
    {
        return !empty($this->where);
    }

    /**
     * @return array
     */
    private function getWhere(): array
    {
        return $this->where;
    }

    /**
     * @param array $where
     */
    private function setWhere(array $where): void
    {
        $this->where = $where;
    }

    /**
     * @return bool
     */
    private function isGroupBy(): bool
    {
        return !empty($this->groupBy);
    }

    /**
     * @return array
     */
    private function getGroupBy(): array
    {
        return $this->groupBy;
    }

    /**
     * @param array $groupBy
     */
    private function setGroupBy(array $groupBy): void
    {
        $this->groupBy = $groupBy;
    }

    /**
     * @return bool
     */
    private function isHaving(): bool
    {
        return !empty($this->having);
    }

    /**
     * @return array
     */
    private function getHaving(): array
    {
        return $this->having;
    }

    /**
     * @param array $having
     */
    private function setHaving(array $having): void
    {
        $this->having = $having;
    }

    private function isOrderBy(): bool
    {
        return !empty($this->orderBy);
    }

    /**
     * @return array
     */
    private function getOrderBy(): array
    {
        return $this->orderBy;
    }

    /**
     * @param array $orderBy
     */
    private function setOrderBy(array $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    /**
     * @return bool
     */
    private function isLimit(): bool
    {
        return $this->limit !== null;
    }

    /**
     * @return int|null
     */
    private function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    private function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return bool
     */
    private function isOffset(): bool
    {
        return $this->offset !== null;
    }

    /**
     * @return int|null
     */
    private function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * @param int|null $offset
     */
    private function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }
}