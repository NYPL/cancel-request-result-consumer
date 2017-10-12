<?php

namespace NYPL\CancelRequestResultConsumer\Test;

use NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest;
use PHPUnit\Framework\TestCase;

class RecapHoldRequestTest extends TestCase
{
    public $fakeRecapHoldRequest;

    public function setUp()
    {
        parent::setUp();
        $this->fakeRecapHoldRequest = new class extends RecapHoldRequest
        {
        };
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest
     * @expectedException \TypeError
     */
    public function testIdCannotBeNull()
    {
        $this->fakeRecapHoldRequest->setId(null);
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest
     * @expectedException \TypeError
     */
    public function testIdCannotBeString()
    {
        $this->fakeRecapHoldRequest->setId('yes');
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest
     */
    public function testIdCanBeInt()
    {
        $this->fakeRecapHoldRequest->setId(1);
        $this->assertEquals(1, $this->fakeRecapHoldRequest->getId());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest
     */
    public function testJobIdCanBeNull()
    {
        $this->fakeRecapHoldRequest->setJobId(null);
        $this->assertNull($this->fakeRecapHoldRequest->getJobId());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest
     */
    public function testJobIdCanBeString()
    {
        $this->fakeRecapHoldRequest->setJobId('hello');
        $this->assertEquals('hello', $this->fakeRecapHoldRequest->getJobId());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest
     */
    public function testCreatedDateCanBeNull()
    {
        $this->fakeRecapHoldRequest->setCreatedDate(null);
        $this->assertNull($this->fakeRecapHoldRequest->getCreatedDate());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest
     */
    public function testUpdatedDateCanBeNull()
    {
        $this->fakeRecapHoldRequest->setUpdatedDate(null);
        $this->assertNull($this->fakeRecapHoldRequest->getUpdatedDate());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest
     */
    public function testTrackingIdCanBeNull()
    {
        $this->fakeRecapHoldRequest->setTrackingId(null);
        $this->assertNull($this->fakeRecapHoldRequest->getTrackingId());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest
     */
    public function testItemBarcodeCanBeNull()
    {
        $this->fakeRecapHoldRequest->setItemBarcode(null);
        $this->assertNull($this->fakeRecapHoldRequest->getItemBarcode());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest
     */
    public function testPatronBarcodeCanBeNull()
    {
        $this->fakeRecapHoldRequest->setPatronBarcode(null);
        $this->assertNull($this->fakeRecapHoldRequest->getPatronBarcode());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest
     */
    public function testOwningInstitutionIdCanBeNull()
    {
        $this->fakeRecapHoldRequest->setOwningInstitutionId(null);
        $this->assertNull($this->fakeRecapHoldRequest->getOwningInstitutionId());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest
     */
    public function testDescriptionCanBeNull()
    {
        $this->fakeRecapHoldRequest->setDescription(null);
        $this->assertNull($this->fakeRecapHoldRequest->getDescription());
    }
}
