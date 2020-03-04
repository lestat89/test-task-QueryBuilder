<?php

namespace App\Tests\SimpleQuery;

use App\SimpleQuery;
use PHPUnit\Framework\TestCase;

/**
 * Class HavingTest
 * @package App\Tests\SimpleQuery
 */
class HavingTest extends TestCase
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
     * @dataProvider havingFieldsProvider
     *
     * @param SimpleQuery $simpleQuery
     * @param string $expected
     * @param array $having
     */
    public function testHavingFields(string $expected, array $having, SimpleQuery $simpleQuery): void
    {
        $this->assertEquals($expected, $simpleQuery->having($having)->havingBuild());
    }

    /**
     * @return array
     */
    public function havingFieldsProvider(): array
    {
        return [
            ['HAVING `test` = "1"', [['test', 1]]],
            ['HAVING `test` > "1"', [['>', 'test', 1]]],
            ['HAVING `test` = "1" OR `test2` != "ttt"', ["OR", ['test', 1], ['!=', 'test2', 'ttt']]],
            [
                'HAVING (`test` = "1" AND `test` = "2") OR `test2` != "ttt"',
                ["OR", ["AND", ['test', 1], ['test', 2]], ['!=', 'test2', 'ttt']]
            ],
        ];
    }
}
