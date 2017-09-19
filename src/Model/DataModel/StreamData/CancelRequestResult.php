<?php

namespace NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData;

use NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData;
use NYPL\HoldRequestResultConsumer\Model\DataModel\StreamData\Error;

/**
 * Class CancelRequestResult
 * @package NYPL\CancelRequestResultConsumer\Model\Data\StreamData
 */
class CancelRequestResult extends StreamData
{
    /**
     * @var string
     */
    public $jobId = '';

    /**
     * @var bool
     */
    public $success;

    /**
     * @var int
     */
    public $cancelRequestId;

    /**
     * @var null|Error
     */
    public $error;

    /**
     * @return string
     */
    public function getJobId(): string
    {
        return $this->jobId;
    }

    /**
     * @param string $jobId
     */
    public function setJobId(string $jobId)
    {
        $this->jobId = $jobId;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success)
    {
        $this->success = $success;
    }

    /**
     * @return int
     */
    public function getCancelRequestId(): int
    {
        return $this->cancelRequestId;
    }

    /**
     * @param int $cancelRequestId
     */
    public function setCancelRequestId(int $cancelRequestId)
    {
        $this->cancelRequestId = $cancelRequestId;
    }

    /**
     * @return null|Error
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param null|Error $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }
}
