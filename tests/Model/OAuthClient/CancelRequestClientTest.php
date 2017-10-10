<?php

namespace NYPL\CancelRequestResultConsumer\Test;

use NYPL\CancelRequestResultConsumer\Model\Exception\NonRetryableException;
use NYPL\CancelRequestResultConsumer\OAuthClient\CancelRequestClient;
use PHPUnit\Framework\TestCase;

class CancelRequestClientTest extends TestCase
{
    public $fakeCancelRequestClient;

    public function setUp()
    {
        parent::setUp();

        $this->fakeCancelRequestClient = new class extends CancelRequestClient {
        };
    }

    /**
     * @expectedException NYPL\CancelRequestResultConsumer\Model\Exception\NonRetryableException
     * @covers NYPL\CancelRequestResultConsumer\OAuthClient\CancelRequestClient
     */
    public function testValidateRequestIdThrowsNonRetryableException()
    {
        $this->fakeCancelRequestClient::validateRequestId(-1);
    }

    /**
     * @expectedException NYPL\CancelRequestResultConsumer\Model\Exception\NonRetryableException
     * @covers NYPL\CancelRequestResultConsumer\OAuthClient\CancelRequestClient
     */
    public function testValidateProcessedThrowsNonRetryableException()
    {
        $this->fakeCancelRequestClient::validateProcessed(null);
    }

    /**
     * @expectedException NYPL\CancelRequestResultConsumer\Model\Exception\NonRetryableException
     * @covers NYPL\CancelRequestResultConsumer\OAuthClient\CancelRequestClient
     */
    public function testValidateSuccessThrowsNonRetryableException()
    {
        $this->fakeCancelRequestClient::validateSuccess(null);
    }
}
