<?php

namespace WolfSellers\Referred\Controller\Referrals;

class Edit extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
