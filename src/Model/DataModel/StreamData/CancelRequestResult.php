<?php

namespace NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData;

use NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData;

/**
 * Class CancelRequestResult
 * @package NYPL\CancelRequestResultConsumer\Model\Data\StreamData
 */
class CancelRequestResult extends StreamData
{
    /**
     * @var string | null
     */
    public $jobId;

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
     * @return null|string
     */
    public function getJobId()
    {
        return $this->jobId;
    }

    /**
     * @param null|string $jobId
     */
    public function setJobId($jobId)
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

    /**
     * @param $data
     * @return null|Error
     */
    public function translateError($data)
    {
        return new Error($data, true);
    }
}
