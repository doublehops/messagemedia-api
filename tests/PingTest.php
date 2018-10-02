<?php

use PHPUnit\Framework\TestCase;

class PingTest extends TestCase
{
    public function testPing(array $stack)
    {
        $this->assert(in_array('Ping request received', $stack));
    }
}
