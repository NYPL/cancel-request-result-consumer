<?php

namespace NYPL\CancelRequestResultConsumer\Model\DataModel;

use NYPL\CancelRequestResultConsumer\Model\DataModel;
use NYPL\CancelRequestResultConsumer\Model\DataModel\StreamData\Description;

class RecapHoldRequest extends DataModel
{
    /**
     * Id associated with a processed cancel recap request.
     *
     * @var int
     */
    public $id;

    /**
     * Tracking Id associated with a processed hold request.
     *
     * @var string | null
     */
    public $jobId;

    /**
     * Date processed hold request created.
     *
     * @var string | null
     */
    public $createdDate;

    /**
     * Date processed hold request updated.
     *
     * @var string | null
     */
    public $updatedDate;

    /**
     * @var bool
     */
    public $success = false;

    /**
     * @var bool
     */
    public $processed = false;

    /**
     * @var string | null
     */
    public $trackingId;

    /**
     * @var string | null
     */
    public $itemBarcode;

    /**
     * @var string | null
     */
    public $patronBarcode;

    /**
     * @var string | null
     */
    public $owningInstitutionId;

    /**
     * @var Description | null
     */
    public $description;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

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
     * @return null|string
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param null|string $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return null|string
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * @param null|string $updatedDate
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = $updatedDate;
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
     * @return bool
     */
    public function isProcessed(): bool
    {
        return $this->processed;
    }

    /**
     * @param bool $processed
     */
    public function setProcessed(bool $processed)
    {
        $this->processed = $processed;
    }

    /**
     * @return null|string
     */
    public function getTrackingId()
    {
        return $this->trackingId;
    }

    /**
     * @param null|string $trackingId
     */
    public function setTrackingId($trackingId)
    {
        $this->trackingId = $trackingId;
    }

    /**
     * @return null|string
     */
    public function getItemBarcode()
    {
        return $this->itemBarcode;
    }

    /**
     * @param null|string $itemBarcode
     */
    public function setItemBarcode($itemBarcode)
    {
        $this->itemBarcode = $itemBarcode;
    }

    /**
     * @return null|string
     */
    public function getPatronBarcode()
    {
        return $this->patronBarcode;
    }

    /**
     * @param null|string $patronBarcode
     */
    public function setPatronBarcode($patronBarcode)
    {
        $this->patronBarcode = $patronBarcode;
    }

    /**
     * @return null|string
     */
    public function getOwningInstitutionId()
    {
        return $this->owningInstitutionId;
    }

    /**
     * @param null|string $owningInstitutionId
     */
    public function setOwningInstitutionId($owningInstitutionId)
    {
        $this->owningInstitutionId = $owningInstitutionId;
    }

    /**
     * @return null|Description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null|Description $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


    /**
     * @param $data
     * @return Description
     */
    public function translateDescription($data)
    {
        return new Description($data, true);
    }

}
