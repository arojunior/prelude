<?php

namespace Prelude\Tests;

use function Prelude\id;

class IdTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function shuldReturnSameValue()
    {
        $this->assertEquals('James', id('James'));
    }
}
