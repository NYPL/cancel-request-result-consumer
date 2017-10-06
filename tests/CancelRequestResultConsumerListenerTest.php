<?php

namespace NYPL\CancelRequestResultConsumer\Test;

use NYPL\CancelRequestResultConsumer\CancelRequestResultConsumerListener;
use NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\CancelRequestResult;
use NYPL\CancelRequestResultConsumer\Test\Mocks\Clients\MockCancelRequestClient;
use NYPL\CancelRequestResultConsumer\Test\Mocks\MockConfig;
use NYPL\CancelRequestResultConsumer\Test\Mocks\MockListenerData;
use NYPL\Starter\APILogger;
use NYPL\Starter\Listener\ListenerEvent;
use NYPL\Starter\Listener\ListenerEvent\KinesisEvent;
use NYPL\Starter\Listener\ListenerEvents\KinesisEvents;
use PHPUnit\Framework\TestCase;

class CancelRequestResultConsumerListenerTest extends TestCase
{
    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        APILogger::addDebug(__CLASS__ . '::' . __FUNCTION__);
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public $fakeListenerData;

    public $fakeKinesisEvent;

    public $fakeKinesisEvents;

    public $fakeCancelRequestResultConsumerListener;

    public function setUp()
    {
        parent::setUp();

        MockConfig::initialize( __DIR__ . '/../../');

        $this->fakeListenerData = MockListenerData::getListenerData();

        $this->fakeKinesisEvent = new class (MockListenerData::getListenerData()) extends KinesisEvent {
        };

        $this->fakeKinesisEvent->setListenerData($this->fakeListenerData);

        $this->fakeKinesisEvents = new class extends KinesisEvents {
            public function getEvents()
            {
                APILogger::addDebug(__CLASS__ . '::' . __FUNCTION__);
                $this->addEvent(array(), '');
                return $this->events;
            }

            public function addEvent(array $record, $schemaName = '')
            {
                APILogger::addDebug(__CLASS__ . '::' . __FUNCTION__);
                $allRecords = json_decode(
                    file_get_contents(__DIR__ . '/../events/kinesis_cancel_request_success.json'),
                    true
                );
                $record = $allRecords['Records'][0];
                $schemaName = 'CancelRequestResult';
            }
        };

        $this->fakeKinesisEvents->setEventSourceARN(
            "arn:aws:kinesis:us-east-1:224280085904:stream/CancelRequestResult-development"
        );

        $this->fakeCancelRequestResultConsumerListener = new class extends CancelRequestResultConsumerListener
        {
            public function __construct()
            {
                parent::__construct();
            }

            protected function patchCancelRequestService(CancelRequestResult $cancelRequestResult)
            {
                $mockCancelRequestClient = new MockCancelRequestClient();

                $mockCancelRequestService = $mockCancelRequestClient->patchCancelRequestById
                (
                    $cancelRequestResult->getCancelRequestId(),
                    true,
                    $cancelRequestResult->isSuccess()
                );
                APILogger::addDebug(__FUNCTION__ . ' patched', (array) $mockCancelRequestService);
            }

        };
    }

    public function tearDown()
    {
        unset($this->fakeKinesisEvent);
        unset($this->fakeKinesisEvents);
        unset($this->fakeListenerData);
        unset($this->fakeCancelRequestResultConsumerListener);
        parent::tearDown();
    }

    public function testProcessListenerEvents()
    {
        $this->invokeMethod(
            $this->fakeCancelRequestResultConsumerListener,
            'setListenerEvents',
            array($this->fakeKinesisEvents)
        );
        $this->assertInstanceOf(
            'NYPL\Starter\Listener\ListenerResult',
            $this->invokeMethod(
                $this->fakeCancelRequestResultConsumerListener,
                'processListenerEvents'
            )
        );
    }
}
