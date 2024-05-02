<?php
declare(strict_types=1);

namespace WolfSellers\Referred\Model;

use Magento\Framework\Model\AbstractModel;
use WolfSellers\Referred\Api\Data\ReferredInterface;
use WolfSellers\Referred\Model\ResourceModel\Referred as ReferredResource;

class Referred extends AbstractModel implements ReferredInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ReferredResource::class);
    }


    /**
     * Get ID
     * @return int
     */
    public function getEntityId(): int
     {
         return (int)$this->_getData('entity_id');
     }

    /**
     * Get First Name
     * @return string
     */
    public function getFirstName(): string
    {
        return (string)$this->getData(self::FIRST_NAME);
    }

    /**
     * Get Last Name
     * @return string
     */
    public function getLastName(): string
    {
        return (string)$this->getData(self::LAST_NAME);
    }

    /**
     * Get Email
     * @return string
     */
    public function getEmail(): string
    {
        return (string)$this->getData(self::EMAIL);
    }

    /**
     * Get Phone
     * @return string
     */
    public function getPhone(): string
    {
        return (string)$this->getData(self::PHONE);
    }

    /**
     * Get Status
     * @return bool
     */
    public function getStatus(): bool
    {
        return (bool)$this->getData(self::STATUS);
    }

    /**
     * Get Customer ID
     * @return int
     */
    public function getCustomerId(): int
    {
        return (int)$this->getData(self::CUSTOMER_ID);
    }

    /**
     * Get Created At
     * @return string
     */
    public function getCreatedAt(): string
    {
        return (string)$this->getData(self::CREATED_AT);
    }

    /**
     * Set Updated At
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return (string)$this->getData(self::UPDATED_AT);
    }

    /**
     * Set entity Id
     *
     * @param int $value
     * @return $this
     */
    public function setEntityId($value)
    {
        return $this->setData('entity_id',(int) $value);
    }

    /**
     * Set First Name
     * @param string $firstName
     * @return ReferredInterface|Referred
     */
    public function setFirstName(string $firstName)
    {
        $this->setData(self::FIRST_NAME, $firstName);
    }

    /**
     * Set Last Name
     * @param string $lastName
     * @return ReferredInterface|Referred
     */
    public function setLastName(string $lastName)
    {
        $this->setData(self::LAST_NAME, $lastName);
    }

    /**
     * Set Email
     * @param string $email
     * @return ReferredInterface|Referred
     */
    public function setEmail(string $email)
    {
        $this->setData(self::EMAIL, $email);
    }

    /**
     * Set Phone
     * @param string $phone
     * @return ReferredInterface|Referred
     */
    public function setPhone(string $phone)
    {
        $this->setData(self::PHONE, $phone);
    }

    /***
     * Set Status
     * @param bool $status
     * @return ReferredInterface|Referred
     */
    public function setStatus(bool $status)
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * Set Customer ID
     * @param int $customerId
     * @return ReferredInterface|Referred
     */
    public function setCustomerId(int $customerId)
    {
        $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Set Created At
     * @param string $createdAt
     * @return ReferredInterface|Referred
     */
    public function setCreatedAt(string $createdAt)
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Set Update At
     * @param string $updatedAt
     * @return ReferredInterface|Referred
     */
    public function setUpdatedAt(string $updatedAt)
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }


}
