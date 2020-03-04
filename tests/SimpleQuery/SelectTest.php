<?php

namespace App\Tests\SimpleQuery;

use App\SimpleQuery;
use PHPUnit\Framework\TestCase;

/**
 * Class SelectTest
 * @package App\Tests\SimpleQuery
 */
class SelectTest extends TestCase
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
     * @depends testSimpleQuery
     * @param SimpleQuery $simpleQuery
     */
    public function testSelectAll(SimpleQuery $simpleQuery): void
    {
        $this->assertEquals('SELECT *', $simpleQuery->selectBuild());
    }

    /**
     * @depends      testSimpleQuery
     * @dataProvider selectFieldsProvider
     *
     * @param SimpleQuery $simpleQuery
     * @param string $expected
     * @param mixed $select
     */
    public function testSelectFields(string $expected, $select, SimpleQuery $simpleQuery): void
    {
        $this->assertEquals($expected, $simpleQuery->select($select)->selectBuild());
    }

    /**
     * @return array
     */
    public function selectFieldsProvider(): array
    {
        return [
            ['SELECT `test`', ['test']],
            ['SELECT `test`', 'test'],
            ['SELECT `test`, `test2`', ['test', 'test2']],
            ['SELECT `test` AS alias_test', ['alias_test' => 'test']],
            ['SELECT `test` AS alias_test, `test2`', ['alias_test' => 'test', 'test2']],
            ['SELECT `test` AS alias_test, `test2`, `test3` AS at3', ['alias_test' => 'test', 'test2', 'at3' => 'test3']],
        ];
    }
}
