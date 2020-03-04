<?php

namespace App\SQBuilderTraits;

use LogicException;

/**
 * Trait SQBuilderTrait
 * @package App\SQBuilderTraits
 * @trait
 */
trait SQBuilderTrait
{
    /**
     * @return string
     */
    public function selectBuild(): string
    {
        $select = 'SELECT';

        if (!$this->isSelect()) {
            return $select . ' *';
        }

        $columns = [];
        foreach ($this->getSelect() as $alias => $column) {
            if (is_bool($column) && $column === false) {
                $columns[] = $alias;
                continue;
            }
            if (!is_int($alias)) {
                $columns[] = $this->quote($column) . ' AS ' . $alias;
                continue;
            }
            $columns[] = $this->quote($column);
        }

        return sprintf('%s %s', $select, $this->escape(implode(', ', $columns)));
    }

    /**
     * @return string
     */
    public function fromBuild(): string
    {
        if (!$this->isFrom()) {
            return '';
        }

        $tables = [];
        foreach ($this->getFrom() as $alias => $table) {
            if (!is_int($alias)) {
                $tables[] = $this->quote($table) . ' AS ' . $alias;
                continue;
            }
            $tables[] = $this->quote($table);
        }

        return 'FROM ' . $this->escape(implode(', ', $tables));
    }

    /**
     * @return string
     */
    public function whereBuild(): string
    {
        if (!$this->isWhere()) {
            return '';
        }

        $where = $this->conditionBuild($this->getWhere());

        return empty($where) ? '' : 'WHERE ' . $where;
    }

    /**
     * @return string
     */
    public function groupByBuild(): string
    {
        if (!$this->isGroupBy()) {
            return '';
        }

        return 'GROUP BY ' . implode(', ',
                array_map(fn($value): string => $this->quote($this->escape($value)), $this->getGroupBy()));
    }

    /**
     * @return string
     */
    public function havingBuild(): string
    {
        if (!$this->isHaving()) {
            return '';
        }

        $having = $this->conditionBuild($this->getHaving());

        return empty($having) ? '' : 'HAVING ' . $having;
    }

    /**
     * @return string
     */
    public function orderByBuild(): string
    {
        if (!$this->isOrderBy()) {
            return '';
        }

        $orders = [];
        foreach ($this->getOrderBy() as $sort => $column) {
            if (!is_int($sort)) {
                $sort = strtoupper($sort);
                if (!in_array($sort, self::SORT_TYPES)) {
                    throw new LogicException('Sort type not found');
                }

                $orders[] = $this->quote($column) . ' ' . $sort;
                continue;
            }
            $orders[] = $this->quote($column) . ' DESC';
        }

        return 'ORDER BY ' . $this->escape(implode(', ', $orders));
    }

    /**
     * @return string
     */
    public function limitBuild(): string
    {
        return $this->isLimit() ? 'LIMIT ' . $this->getLimit() : '';
    }

    /**
     * @return string
     */
    public function offsetBuild(): string
    {
        return $this->isOffset() ? 'OFFSET ' . $this->getOffset() : '';
    }

    /**
     * @param array $conditions
     * @param bool $subConditions
     * @return string
     */
    private function conditionBuild(array $conditions, bool $subConditions = false): string
    {
        $where = [];
        $typeCondition = 'AND';
        foreach ($conditions as $condition) {
            if (is_string($condition)) {
                $typeCondition = strtoupper($condition);
                if (!in_array($typeCondition, self::WHERE_TYPE_CONDITIONS)) {
                    throw new LogicException('Not found type condition');
                }
                continue;
            }

            if (!is_array($condition)) {
                throw new LogicException('Condition not array');
            }

            $operator = '=';
            if (count($condition) === 3) {
                [$operator, $field, $value] = $condition;
            } else {
                [$field, $value] = $condition;
            }

            if (in_array($operator, self::WHERE_TYPE_CONDITIONS)) {
                $where[] = $this->conditionBuild($condition, true);
                continue;
            }

            if (!in_array($operator, self::WHERE_OPERATORS)) {
                throw new LogicException('Operator not found');
            }

            if (is_array($value)) {
                $value = implode(', ', array_map(fn($value): string => sprintf('"%s"', $this->escape($value)), $value));
            } else {
                $value = sprintf('"%s"', $this->escape($value));
            }

            $where[] = sprintf('%s %s %s', $this->quote($this->escape($field)), $operator, $value);
        }

        if ($subConditions) {
            return empty($where) ? '' : '(' . implode(" $typeCondition ", $where) . ')';
        }

        return empty($where) ? '' : implode(" $typeCondition ", $where);
    }

    /**
     * @param string $string
     * @return string
     */
    private function quote(string $string): string
    {
        return sprintf('`%s`', $string);
    }

    /**
     * @param string $string
     * @return string
     */
    private function escape(string $string): string
    {
        return addslashes($string);
    }
}
