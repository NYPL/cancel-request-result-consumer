<?php

namespace NYPL\CancelRequestResultConsumer\Test;

use NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\CancelRequestResult;
use PHPUnit\Framework\TestCase;

class CancelRequestResultTest extends TestCase
{
    public $fakeCancelRequestResult;

    public function setUp()
    {
        parent::setUp();

        $this->fakeCancelRequestResult = new class extends CancelRequestResult { };
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\CancelRequestResult
     */
    public function testJobIdCanBeNull()
    {
        $this->fakeCancelRequestResult->setJobId(null);
        $this->assertEquals(null, $this->fakeCancelRequestResult->getJobId());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\CancelRequestResult
     */
    public function testJobIdCanBeAString()
    {
        $this->fakeCancelRequestResult->setJobId('jobid');
        $this->assertEquals('jobid', $this->fakeCancelRequestResult->getJobId());
    }

    /**
     * @expectedException \TypeError
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\CancelRequestResult
     */
    public function testCancelRequestIdCanNotBeNull()
    {
        $this->fakeCancelRequestResult->setCancelRequestId(null);
    }

    /**
     * @expectedException \TypeError
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\CancelRequestResult
     */
    public function testCancelRequestIdCanNotBeString()
    {
        $this->fakeCancelRequestResult->setCancelRequestId('hello');
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\CancelRequestResult
     */
    public function testCancelRequestIdCanOnlyBeInt()
    {
        $this->fakeCancelRequestResult->setCancelRequestId(4);
        $this->assertEquals(4, $this->fakeCancelRequestResult->getCancelRequestId());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\CancelRequestResult
     */
    public function testErrorCanBeNull()
    {
        $this->fakeCancelRequestResult->setError(null);
        $this->assertNull($this->fakeCancelRequestResult->getError());
    }
}
