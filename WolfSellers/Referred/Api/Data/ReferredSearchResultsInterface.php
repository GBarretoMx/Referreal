<?php

namespace WolfSellers\Referred\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ReferredSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get Referred list
     * @return \WolfSellers\Referred\Api\Data\ReferredInterface[]
     */
    public function getItems();

    /**
     * Set Refered Id List
     * @param \WolfSellers\Referred\Api\Data\ReferredInterface[] $items
     * @return ReferredSearchResultsInterface
     */
    public function setItems(array $items);

}
