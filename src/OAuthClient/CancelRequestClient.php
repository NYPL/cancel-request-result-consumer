<?php

namespace NYPL\CancelRequestResultConsumer\OAuthClient;

use NYPL\CancelRequestResultConsumer\Model\DataModel\CancelRequest;
use NYPL\Starter\APIClient;
use NYPL\Starter\APILogger;
use NYPL\Starter\Config;

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
     * @param int $cancelRequestId
     * @param bool $processed
     * @param bool $success
     * @return null|CancelRequest
     */
    public function patchCancelRequestById(int $cancelRequestId, bool $processed, bool $success)
    {
        $url = Config::get('API_CANCEL_REQUEST_URL') . '/' . $cancelRequestId;

        $body = ["processed" => $processed, "success" => $success];

        APILogger::addDebug('Patching Cancel Request By Id', array($url, $body));

        $clientHelper = new ClientHelper();

        $response = $clientHelper->patchResponse($url, $body, __FUNCTION__);

        $statusCode = $response->getStatusCode();

        $response = json_decode((string)$response->getBody(), true);

        APILogger::addDebug('Patched cancel request by Id', $response['data']);

        if ($statusCode === 200) {
            return new CancelRequest($response['data']);
        } else {
            APILogger::addError(
                'Failed',
                array('Failed to retrieve Cancel Request ', $cancelRequestId, $response['type'], $response['message'])
            );
            return null;
        }
    }

}
