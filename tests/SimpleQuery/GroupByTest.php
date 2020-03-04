<?php

namespace App\Tests\SimpleQuery;

use App\SimpleQuery;
use PHPUnit\Framework\TestCase;

/**
 * Class GroupByTest
 * @package App\Tests\SimpleQuery
 */
class GroupByTest extends TestCase
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
     * @dataProvider groupByFieldsProvider
     *
     * @param SimpleQuery $simpleQuery
     * @param string $expected
     * @param mixed $groupBy
     */
    public function testGroupByFields(string $expected, $groupBy, SimpleQuery $simpleQuery): void
    {
        $this->assertEquals($expected, $simpleQuery->groupBy($groupBy)->groupByBuild());
    }

    /**
     * @return array
     */
    public function groupByFieldsProvider(): array
    {
        return [
            ['GROUP BY `test`', ['test']],
            ['GROUP BY `test`', 'test'],
            ['GROUP BY `test`, `test2`', ['test', 'test2']],
        ];
    }
}
