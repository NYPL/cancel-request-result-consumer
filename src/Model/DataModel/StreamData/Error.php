<?php

namespace NYPL\HoldRequestResultConsumer\Model\DataModel\StreamData;

use NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData;

/**
 * Error message object found in Cancel Request Result
 * @package NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData
 */
class Error extends StreamData
{
    /**
     * Type of Error
     *
     * @var string
     */
    public $type = '';

    /**
     * Message in Error
     *
     * @var string
     */
    public $message = '';

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }
}
