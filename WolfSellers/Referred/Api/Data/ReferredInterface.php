<?php
declare(strict_types=1);
namespace WolfSellers\Referred\Api\Data;

interface ReferredInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ENTITY_ID   = 'entity_id';
    const FIRST_NAME  = 'first_name';
    const LAST_NAME   = 'last_name';
    const EMAIL       = 'email';
    const PHONE       = 'phone';
    const STATUS      = 'status';
    const CUSTOMER_ID = 'customer_id';
    const CREATED_AT  = 'created_at';
    const UPDATED_AT  = 'updated_at';
    /**#@-*/

    /**
     * Get entity ID
     * @return int
     */
    public function getEntityId() : int;

    /**
     * Get First Name
     * @return string
     */
    public function getFirstName():string;

    /**
     * Get last Name
     * @return string
     */
    public function getLastName():string;

    /**
     * Get Email
     * @return string
     */
    public function getEmail():string;

    /**
     * Get Phone
     * @return string
     */
    public function getPhone():string;

    /**
     * Get  Status
     * @return bool
     */
    public function getStatus():bool;

    /**
     * Get Customer ID
     * @return int
     */
    public function getCustomerId():int;

    /**
     * Get Created At
     * @return string
     */
    public function getCreatedAt():string;

    /**
     * Get Updated At
     * @return string
     */
    public function getUpdatedAt():string;


    /**
     * @param int $entityId
     * @return ReferredInterface
     */
    public function setEntityId(int $entityId);


    /**
     * Set First Name
     * @param string $firstName
     * @return ReferredInterface
     */
    public function setFirstName(string $firstName);

    /**
     * Set Last Name
     * @param string $lastName
     * @return ReferredInterface
     */
    public function setLastName(string $lastName);

    /**
     * Set Email
     * @param string $email
     * @return ReferredInterface
     */
    public function setEmail(string $email);

    /**
     * Set Phone
     * @param string $phone
     * @return ReferredInterface
     */
    public function setPhone(string $phone);

    /**
     * Set Status
     * @param bool $status
     * @return ReferredInterface
     */
    public function setStatus(bool $status);


    /**
     * Set CustomerID
     * @param int $customerId
     * @return ReferredInterface
     */
    public function setCustomerId(int $customerId);
    /**
     * Set Created At
     * @param string $createdAt
     * @return ReferredInterface
     */
    public function setCreatedAt(string $createdAt);

    /**
     * Set Updated At
     * @param string $updatedAt
     * @return ReferredInterface
     */
    public function setUpdatedAt(string $updatedAt);

}
