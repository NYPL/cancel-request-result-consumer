<?php

namespace NYPL\CancelRequestResultConsumer;

use NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\CancelRequestResult;
use NYPL\CancelRequestResultConsumer\Model\Exception\NonRetryableException;
use NYPL\CancelRequestResultConsumer\Model\Exception\RetryableException;
use NYPL\Starter\APILogger;
use NYPL\Starter\Listener\Listener;
use NYPL\Starter\Listener\ListenerEvent;
use NYPL\Starter\Listener\ListenerResult;
use NYPL\Starter\Model\Response\ErrorResponse;

class CancelRequestResultConsumerListener extends Listener
{
    /**
     * @param ListenerEvent $listenerEvent
     * @return CancelRequestResult
     * @throws NonRetryableException
     */
    protected function getCancelRequestResult(ListenerEvent $listenerEvent)
    {
        $listenerData = $listenerEvent->getListenerData();

        if ($listenerData === null) {
            throw new NonRetryableException(
                'Not Acceptable: No listener data',
                array($listenerEvent),
                406,
                null,
                406,
                new ErrorResponse(406, 'no-listener-data', 'Not Acceptable: No listener data')
            );
        }

        $data = $listenerData->getData();

        APILogger::addDebug('data', $data);

        if ($data === null) {
            throw new NonRetryableException(
                'Not Acceptable: No data from listener data',
                array($listenerData),
                406,
                null,
                406,
                new ErrorResponse(406, 'no-data-from-listener-data', 'Not Acceptable: No data from listener data')
            );
        }

        $cancelRequestResult = new CancelRequestResult($data);

        APILogger::addDebug('CancelRequestResult', (array) $cancelRequestResult);

        return $cancelRequestResult;
    }

    /**
     * @param CancelRequestResult $cancelRequestResult
     */
    protected function patchCancelRequestService(CancelRequestResult $cancelRequestResult)
    {
        $cancelRequestService = CancelRequestClient::patchCancelRequestById(
            $cancelRequestResult->getCancelRequestId(),
            true,
            $cancelRequestResult->isSuccess()
        );
        APILogger::addDebug('Cancel Request Service patched', (array)$cancelRequestService);
    }

    protected function processListenerEvents()
    {
        /**
         * @var ListenerEvent $listenerEvent
         */
        foreach ($this->getListenerEvents()->getEvents() as $listenerEvent) {

            try {
                $cancelRequestResult = $this->getCancelRequestResult($listenerEvent);
                $this->patchCancelRequestService($cancelRequestResult);
            } catch (RetryableException $exception) {
                APILogger::addError(
                    'RetryableException thrown: ' . $exception->getMessage() .
                    ', Error code: ' . $exception->getCode()
                );
                return new ListenerResult(
                    false,
                    'Retrying process'
                );
            } catch (NonRetryableException $exception) {
                APILogger::addError(
                    'NonRetryableException thrown: ' . $exception->getMessage() .
                    ', Error code: ' . $exception->getCode()
                );
            } catch (\Exception $exception) {
                APILogger::addError(
                    'Exception thrown: ' . $exception->getMessage() .
                    ', Error code: ' . $exception->getCode()
                );
            } catch (\Throwable $exception) {
                APILogger::addError(
                    'Throwable thrown: ' . $exception->getMessage()
                );
            }
        }

        return new ListenerResult(
            true,
            'Successfully processed event'
        );
    }
}
