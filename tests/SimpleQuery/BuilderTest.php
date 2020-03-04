<?php

namespace App\Tests\SimpleQuery;

use App\SimpleQuery;
use PHPUnit\Framework\TestCase;

/**
 * Class BuilderTest
 * @package App\Tests\SimpleQuery
 */
class BuilderTest extends TestCase
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
        $this->assertEquals('SELECT *', $simpleQuery->build());
        $this->assertEquals('SELECT count(*)', $simpleQuery->buildCount());
    }

    /**
     * @depends      testSimpleQuery
     *
     * @param SimpleQuery $simpleQuery
     */
    public function testBuilderFields(SimpleQuery $simpleQuery): void
    {
        $query = $simpleQuery->select([
            'field1',
            'field2' => 'field'
        ])
            ->from(['table'])
            ->where([['!=', 'field', 'ttt']])
            ->limit(1);
        $this->assertEquals('SELECT `field1`, `field` AS field2 FROM `table` WHERE `field` != "ttt" LIMIT 1',
            $query->build());
        $this->assertEquals('SELECT count(*) FROM `table` WHERE `field` != "ttt" LIMIT 1', $query->buildCount());
    }
}
