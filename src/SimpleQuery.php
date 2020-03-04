<?php

namespace App;

use App\SQBuilderTraits\SimpleQueryPropertyTrait;
use App\SQBuilderTraits\SQBuilderTrait;

/**
 * Class SimpleQuery
 * @package App
 * @final
 */
final class SimpleQuery implements SimpleQueryBuilderInterface, SimpleQueryPropertyInterface
{
    use SimpleQueryPropertyTrait, SQBuilderTrait;

    /**
     * @inheritDoc
     */
    public function select($fields): self
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }
        $this->setSelect($fields);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function from($tables): self
    {
        if (!is_array($tables)) {
            $tables = [$tables];
        }
        $this->setFrom($tables);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function where($conditions): self
    {
        if (!is_array($conditions)) {
            $conditions = [$conditions];
        }
        $this->setWhere($conditions);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function groupBy($fields): self
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }
        $this->setGroupBy($fields);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function having($conditions): self
    {
        if (!is_array($conditions)) {
            $conditions = [$conditions];
        }
        $this->setHaving($conditions);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function orderBy($fields): self
    {
        if (!is_array($fields)) {
            $fields = [$fields];
        }
        $this->setOrderBy($fields);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function limit(int $limit): self
    {
        $this->setLimit($limit);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function offset(int $offset): self
    {
        $this->setOffset($offset);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function build(): string
    {
        return implode(' ', array_filter([
            $this->selectBuild(),
            $this->fromBuild(),
            $this->whereBuild(),
            $this->groupByBuild(),
            $this->havingBuild(),
            $this->orderByBuild(),
            $this->limitBuild(),
            $this->offsetBuild(),
        ]));
    }

    /**
     * @inheritDoc
     */
    public function buildCount(): string
    {
        $this->setSelect(['count(*)' => false]);
        return implode(' ', array_filter([
            $this->selectBuild(),
            $this->fromBuild(),
            $this->whereBuild(),
            $this->groupByBuild(),
            $this->havingBuild(),
            $this->limitBuild(),
            $this->offsetBuild(),
        ]));
    }
}
