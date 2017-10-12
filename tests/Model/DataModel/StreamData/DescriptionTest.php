<?php

namespace NYPL\CancelRequestResultConsumer\Test;

use NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\Description;
use PHPUnit\Framework\TestCase;

class DescriptionTest extends TestCase
{
    public $fakeDescription;

    public function setUp()
    {
        parent::setUp();
        $this->fakeDescription = new class extends Description { };
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\Description
     */
    public function testTitleCanBeNull()
    {
        $this->fakeDescription->setTitle(null);
        $this->assertNull($this->fakeDescription->getTitle());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\Description
     */
    public function testAuthorCanBeNull()
    {
        $this->fakeDescription->setAuthor(null);
        $this->assertNull($this->fakeDescription->getAuthor());
    }

    /**
     * @covers \NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\Description
     */
    public function testCallNumberCanBeNull()
    {
        $this->fakeDescription->setCallNumber(null);
        $this->assertNull($this->fakeDescription->getCallNumber());
    }
}
