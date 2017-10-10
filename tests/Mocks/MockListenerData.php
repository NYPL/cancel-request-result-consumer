<?php

namespace NYPL\CancelRequestResultConsumer\Test\Mocks;

use NYPL\CancelRequestResultConsumer\Test\Mocks\Clients\MockSchemaClient;
use NYPL\Starter\APILogger;
use NYPL\Starter\AvroDeserializer;
use NYPL\Starter\Listener\ListenerData;

class MockListenerData
{
    public static $mockListenerData;

    public static function setListenerData()
    {
        APILogger::addDebug(__CLASS__ . '::' . __FUNCTION__);
        self::$mockListenerData = new ListenerData(
            base64_decode("SDkwMWJkZDFkLWJkOGYtNDMxMC1iYTMxLTdmMTNhNTU4NzdmZAEAkgs=")
        );

        self::$mockListenerData->setSchemaName("CancelRequestResult");

        APILogger::addDebug(__CLASS__ . ': Decoding Avro data using ' . self::$mockListenerData->getSchemaName() . ' schema');

        self::$mockListenerData->setData(
            AvroDeserializer::deserializeWithSchema(
                MockSchemaClient::getSchema(self::$mockListenerData->getSchemaName()),
                self::$mockListenerData->getRawAvroData()
            )
        );
    }

    public static function getListenerData()
    {
        APILogger::addDebug(__CLASS__ . '::' . __FUNCTION__);
        self::setListenerData();
        return self::$mockListenerData;
    }
}
