<?php

namespace NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData;

use NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData;

/**
 * Class Description
 * @package NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData
 */
class Description extends StreamData
{
    /**
     * @var string | null
     */
    public $title;

    /**
     * @var string | null
     */
    public $author;

    /**
     * @var string | null
     */
    public $callNumber;

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return null|string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param null|string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return null|string
     */
    public function getCallNumber()
    {
        return $this->callNumber;
    }

    /**
     * @param null|string $callNumber
     */
    public function setCallNumber($callNumber)
    {
        $this->callNumber = $callNumber;
    }
}
