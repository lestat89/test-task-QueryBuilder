<?php

namespace App\Tests\SimpleQuery;

use App\SimpleQuery;
use PHPUnit\Framework\TestCase;

/**
 * Class OffsetTest
 * @package App\Tests\SimpleQuery
 */
class OffsetTest extends TestCase
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
     *
     * @param SimpleQuery $simpleQuery
     */
    public function testOffsetFields(SimpleQuery $simpleQuery): void
    {
        $this->assertEquals('', $simpleQuery->offsetBuild());
        $this->assertEquals('OFFSET 1', $simpleQuery->offset(1)->offsetBuild());
    }
}
