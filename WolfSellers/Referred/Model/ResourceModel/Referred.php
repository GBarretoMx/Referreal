<?php
declare(strict_types=1);
namespace WolfSellers\Referred\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Referred extends AbstractDb
{
    /**#@+
     * Constants
     */
    private const TABLE_NAME = 'wolf_referred';
    private  const FIELD_NAME = 'entity_id';
    /**#@-*/

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME,
            self::FIELD_NAME);
    }

}
