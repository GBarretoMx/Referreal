<?php

namespace WolfSellers\Referred\Block\Referrals;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session as CustomerSession;
use WolfSellers\Referred\Api\ReferredRepositoryInterface;
use WolfSellers\Referred\Model\ResourceModel\Referred\CollectionFactory as ReferredCollectionFactory;


class EditReferral extends Template
{

    /**
     * @var CustomerSession
     */
    protected CustomerSession $customerSession;

    /**
     * @var UrlInterface
     */
    protected UrlInterface $urlBuilder;

    /**
     * @var ReferredCollectionFactory
     */
    protected ReferredCollectionFactory $collectionFactory;

    /**
     * @var ReferredRepositoryInterface
     */
    protected ReferredRepositoryInterface $referredRepository;



    public function __construct(
        Template\Context $context,
        CustomerSession $customerSession,
        UrlInterface $urlBuilder,
        ReferredCollectionFactory $collectionFactory,
        ReferredRepositoryInterface $referredRepository,
        array $data = [])
    {
        $this->customerSession = $customerSession;
        $this->urlBuilder = $urlBuilder;
        $this->collectionFactory = $collectionFactory;
        $this->referredRepository = $referredRepository;
        parent::__construct($context, $data);
    }

    public function getReferralId()
    {
        return $this->getRequest()->getParam('referral_id');
    }
    public function getDataReferral()
    {
        $referralId = $this->getReferralId();
        if (empty($referralId) && !$this->customerSession->isLoggedIn()) {
            return false;
        }
        return $this->referredRepository->getById($referralId);
    }

}
