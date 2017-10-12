<?php

namespace NYPL\CancelRequestResultConsumer\Test;

use NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\Error;
use PHPUnit\Framework\TestCase;

class ErrorTest extends TestCase
{
    public $fakeError;

    public function setUp()
    {
        parent::setUp();
        $this->fakeError = new class extends Error {};
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\Error
     * @expectedException \TypeError
     */
    public function testTypeCannotBeNull()
    {
        $this->fakeError->setType(null);
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\Error
     */
    public function testTypeCanBeString()
    {
        $this->fakeError->setType('error');
        $this->assertEquals('error', $this->fakeError->getType());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\Error
     * @expectedException \TypeError
     */
    public function testMessageCannotBeNull()
    {
        $this->fakeError->setMessage(null);
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\Error
     */
    public function testMessageCanBeString()
    {
        $this->fakeError->setMessage('error message');
        $this->assertEquals('error message', $this->fakeError->getMessage());
    }
}
