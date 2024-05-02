<?php
declare(strict_types=1);
namespace WolfSellers\Referred\Model\ResourceModel\Referred;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use WolfSellers\Referred\Model\ResourceModel\Referred as ReferredResource;
use WolfSellers\Referred\Model\Referred;

class Collection extends AbstractCollection
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Referred::class, ReferredResource::class);
    }

}
