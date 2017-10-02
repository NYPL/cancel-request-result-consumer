<?php

namespace NYPL\CancelRequestResultConsumer\OAuthClient;

use NYPL\CancelRequestResultConsumer\Model\DataModel\RecapHoldRequest;
use NYPL\CancelRequestResultConsumer\Model\Exception\NonRetryableException;
use NYPL\Starter\APIClient;
use NYPL\Starter\APILogger;
use NYPL\Starter\Config;
use NYPL\Starter\Model\Response\ErrorResponse;

class CancelRequestClient extends APIClient
{
    /**
     * Implements NYPL\Starter\APIClient::isRequiresAuth()
     *
     * @return bool
     */
    protected function isRequiresAuth()
    {
        return true;
    }

    /**
     * Implements NYPL\Starter\APIClient::isRequiresJSON()
     *
     * @return bool
     */
    protected function isRequiresJSON()
    {
        return true;
    }

    /**
     * @param int $cancelRequestId
     * @return bool
     * @throws NonRetryableException
     */
    public static function validateRequestId(int $cancelRequestId)
    {
        if (!isset($cancelRequestId) || !is_numeric($cancelRequestId) || $cancelRequestId < 1) {
            throw new NonRetryableException(
                'Not Acceptable: Invalid cancel request id: ' . $cancelRequestId,
                'Not Acceptable: Invalid cancel request id: ' . $cancelRequestId,
                406,
                null,
                406,
                new ErrorResponse(406, 'invalid-cancel-request-id', 'Invalid cancel request id: ' . $cancelRequestId)
            );
        }

        return true;
    }

    /**
     * @param $processed
     * @return bool
     * @throws NonRetryableException
     */
    public static function validateProcessed($processed)
    {
        if (!isset($processed)) {
            throw new NonRetryableException(
                'Not Acceptable: Processed flag not set',
                'Not Acceptable: Processed flag is not set.',
                406,
                null,
                406,
                new ErrorResponse(406, 'processed-flag-not-set', '406 Not Acceptable: Processed flag is not set.')
            );
        }

        return true;
    }

    /**
     * @param $success
     * @return bool
     * @throws NonRetryableException
     */
    public static function validateSuccess($success)
    {
        if (!isset($success)) {
            throw new NonRetryableException(
                'Not Acceptable: Success flag not set',
                'Not Acceptable: Success flag is not set.',
                406,
                null,
                406,
                new ErrorResponse(406, 'success-flag-not-set', '406 Not Acceptable: Success flag is not set.')
            );
        }

        return true;
    }

    /**
     * @param int $cancelRequestId
     * @param bool $processed
     * @param bool $success
     * @return null|RecapHoldRequest
     */
    public function patchCancelRequestById(int $cancelRequestId, bool $processed, bool $success)
    {
        self::validateRequestId($cancelRequestId);
        self::validateProcessed($processed);
        self::validateSuccess($success);

        $url = Config::get('API_CANCEL_REQUEST_URL') . '/' . $cancelRequestId;

        $body = ["processed" => $processed, "success" => $success];

        APILogger::addDebug('Patching Cancel Request By Id', array($url, $body));

        $clientHelper = new ClientHelper();

        $response = $clientHelper->patchResponse($url, $body, __FUNCTION__);

        $statusCode = $response->getStatusCode();

        $response = json_decode((string)$response->getBody(), true);

        APILogger::addDebug('Patched cancel request by Id', $response['data']);

        if ($statusCode === 200) {
            return new RecapHoldRequest($response['data']);
        } else {
            APILogger::addError(
                'Failed',
                array('Failed to retrieve Cancel Request ', $cancelRequestId, $response['type'], $response['message'])
            );
            return null;
        }
    }

}
