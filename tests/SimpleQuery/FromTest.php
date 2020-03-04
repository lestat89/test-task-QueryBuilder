<?php

namespace App\Tests\SimpleQuery;

use App\SimpleQuery;
use PHPUnit\Framework\TestCase;

/**
 * Class FromTest
 * @package App\Tests\SimpleQuery
 */
class FromTest extends TestCase
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
     * @dataProvider fromFieldsProvider
     *
     * @param SimpleQuery $simpleQuery
     * @param string $expected
     * @param mixed $from
     */
    public function testFromFields(string $expected, $from, SimpleQuery $simpleQuery): void
    {
        $this->assertEquals($expected, $simpleQuery->from($from)->fromBuild());
    }

    /**
     * @return array
     */
    public function fromFieldsProvider(): array
    {
        return [
            ['FROM `test`', ['test']],
            ['FROM `test`', 'test'],
            ['FROM `test`, `test2`', ['test', 'test2']],
            ['FROM `test` AS alias_test', ['alias_test' => 'test']],
            ['FROM `test` AS alias_test, `test2`', ['alias_test' => 'test', 'test2']],
            ['FROM `test` AS alias_test, `test2`, `test3` AS at3', ['alias_test' => 'test', 'test2', 'at3' => 'test3']],
        ];
    }
}
