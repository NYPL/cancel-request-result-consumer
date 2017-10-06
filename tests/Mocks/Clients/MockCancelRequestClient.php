<?php

namespace NYPL\CancelRequestResultConsumer\Test\Mocks\Clients;


use NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest;

class MockCancelRequestClient
{
    /**
     * @param int $cancelRequestId
     * @param bool $processed
     * @param bool $success
     * @return null|RecapHoldRequest
     */
    public function patchCancelRequestById(int $cancelRequestId, bool $processed, bool $success)
    {
        $response = json_decode(file_get_contents(__DIR__ . '/../../data/test_cancel_request.json'), true);
        $response['data']['success'] = $success;
        $response['data']['processed'] = $processed;

        if ($response['statusCode'] == 200) {
            return new RecapHoldRequest($response['data']);
        } else {
            return null;
        }
    }
}
