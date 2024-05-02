<?php
declare(strict_types=1);
namespace WolfSellers\Referred\Controller\Referrals;

use Magento\Framework\App\Action\Action;
class index extends  Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }

}
