<?php

namespace WolfSellers\Referred\Controller\Referrals;

use Magento\Framework\App\Action\Action;
class Form extends Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }

}
