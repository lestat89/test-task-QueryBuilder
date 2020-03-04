<?php
declare(strict_types=1);

namespace App;

use LogicException;

/**
 * Interface SimpleQueryBuilderInterface
 * @package App
 */
interface SimpleQueryBuilderInterface
{
    /**
     * @param array|string $fields
     * @return SimpleQueryBuilderInterface
     */
    public function select($fields): SimpleQueryBuilderInterface;

    /**
     * @param string|SimpleQueryBuilderInterface|array<string|SimpleQueryBuilderInterface> $tables
     * @return SimpleQueryBuilderInterface
     */
    public function from($tables): SimpleQueryBuilderInterface;

    /**
     * @param string|array $conditions
     * @return SimpleQueryBuilderInterface
     */
    public function where($conditions): SimpleQueryBuilderInterface;

    /**
     * @param string|array $fields
     * @return SimpleQueryBuilderInterface
     */
    public function groupBy($fields): SimpleQueryBuilderInterface;

    /**
     * @param string|array $conditions
     * @return SimpleQueryBuilderInterface
     */
    public function having($conditions): SimpleQueryBuilderInterface;

    /**
     * @param string|array $fields
     * @return SimpleQueryBuilderInterface
     */
    public function orderBy($fields): SimpleQueryBuilderInterface;

    /**
     * @param int $limit
     * @return SimpleQueryBuilderInterface
     */
    public function limit(int $limit): SimpleQueryBuilderInterface;

    /**
     * @param int $offset
     * @return SimpleQueryBuilderInterface
     */
    public function offset(int $offset): SimpleQueryBuilderInterface;

    /**
     * @return string
     * @throws LogicException
     */
    public function build(): string;

    /**
     * @return string
     * @throws LogicException
     */
    public function buildCount(): string;
}
