<?php

namespace App\Tests\SimpleQuery;

use App\SimpleQuery;
use PHPUnit\Framework\TestCase;

/**
 * Class LimitTest
 * @package App\Tests\SimpleQuery
 */
class LimitTest extends TestCase
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
    public function testLimitFields(SimpleQuery $simpleQuery): void
    {
        $this->assertEquals('', $simpleQuery->limitBuild());
        $this->assertEquals('LIMIT 1', $simpleQuery->limit(1)->limitBuild());
    }
}
