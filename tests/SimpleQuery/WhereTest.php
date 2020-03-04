<?php

namespace App\Tests\SimpleQuery;

use App\SimpleQuery;
use PHPUnit\Framework\TestCase;

/**
 * Class WhereTest
 * @package App\Tests\SimpleQuery
 */
class WhereTest extends TestCase
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
     * @dataProvider whereFieldsProvider
     *
     * @param SimpleQuery $simpleQuery
     * @param string $expected
     * @param array $where
     */
    public function testWhereFields(string $expected, array $where, SimpleQuery $simpleQuery): void
    {
        $this->assertEquals($expected, $simpleQuery->where($where)->whereBuild());
    }

    /**
     * @return array
     */
    public function whereFieldsProvider(): array
    {
        return [
            ['WHERE `test` = "1"', [['test', 1]]],
            ['WHERE `test` > "1"', [['>', 'test', 1]]],
            ['WHERE `test` = "1" OR `test2` != "ttt"', ["OR", ['test', 1], ['!=', 'test2', 'ttt']]],
            [
                'WHERE (`test` = "1" AND `test` = "2") OR `test2` != "ttt"',
                ["OR", ["AND", ['test', 1], ['test', 2]], ['!=', 'test2', 'ttt']]
            ],
        ];
    }
}
