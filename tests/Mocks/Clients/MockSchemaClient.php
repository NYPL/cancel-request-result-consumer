<?php
/**
 * Created by PhpStorm.
 * User: holingpoon
 * Date: 10/5/17
 * Time: 4:59 PM
 */

namespace NYPL\CancelRequestResultConsumer\Test\Mocks\Clients;


use NYPL\Starter\APILogger;
use NYPL\Starter\AvroLoader;
use NYPL\Starter\Schema;

class MockSchemaClient
{
    /**
     * @var array
     */
    protected static $schemaCache = [];

    /**
     * @param string $schemaName
     *
     * @return Schema
     */
    public static function getSchema($schemaName = '')
    {
        if (isset(self::$schemaCache[$schemaName])) {
            return self::$schemaCache[$schemaName];
        }

        AvroLoader::load();

        $response = json_decode(
            file_get_contents(__DIR__ . '/../../data/test_schema.json'),
            true
        );

        $schema = new Schema(
            $schemaName,
            0,
            \AvroSchema::parse($response['data']['schema']),
            $response['data']['schemaObject']
        );

        self::$schemaCache[$schemaName] = $schema;

        APILogger::addDebug(
            'Got schema for ' . $schemaName,
            (array) $schema->getSchema()
        );

        return $schema;
    }
}
