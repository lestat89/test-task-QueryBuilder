<?php

namespace App\Tests\SimpleQuery;

use App\SimpleQuery;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderByTest
 * @package App\Tests\SimpleQuery
 */
class OrderByTest extends TestCase
{
    /**
     * @return SimpleQuery
     */
    public function testSimpleQuery(): SimpleQuery
    {
        $simpleQuery = new SimpleQuery();
        $this->assertIsObject($simpleQuery);

        return $simpleQuery;
    }

    /**
     * @depends      testSimpleQuery
     * @dataProvider orderByFieldsProvider
     *
     * @param SimpleQuery $simpleQuery
     * @param string $expected
     * @param mixed $groupBy
     */
    public function testOrderByFields(string $expected, $groupBy, SimpleQuery $simpleQuery): void
    {
        $this->assertEquals($expected, $simpleQuery->orderBy($groupBy)->orderByBuild());
    }

    /**
     * @return array
     */
    public function orderByFieldsProvider(): array
    {
        return [
            ['ORDER BY `test` DESC', ['desc' => 'test']],
            ['ORDER BY `test` DESC', 'test'],
            ['ORDER BY `test` DESC, `test2` DESC', ['test', 'test2']],
            ['ORDER BY `test` ASC, `test2` DESC', ['asc' => 'test', 'test2']],
        ];
    }
}
