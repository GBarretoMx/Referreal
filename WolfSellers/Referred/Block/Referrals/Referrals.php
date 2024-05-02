<?php
declare(strict_types=1);
namespace WolfSellers\Referred\Block\Referrals;

use Magento\Customer\Model\Session;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use WolfSellers\Referred\Model\ResourceModel\Referred\CollectionFactory as ReferredCollectionFactory;
use WolfSellers\Referred\Model\ResourceModel\Referred\Collection;

class Referrals extends Template
{
    /**
     * @var ReferredCollectionFactory
     */
    protected ReferredCollectionFactory $referralCollectionFactory;

    /**
     * @var Session
     */
    protected Session $customerSession;

    /**
     * @var Collection
     */
    protected Collection $referrals;


    /**
     * @var UrlInterface
     */
    protected UrlInterface $urlBuilder;

    /** URL Path */
    const DELETE_REFERRAL_PATH = 'referral/referrals/delete';
    const EDIT_REFERRAL_PATH   = 'referral/referrals/edit';



    public function __construct(
        Template\Context $context,
        ReferredCollectionFactory $referralCollectionFactory,
        Session $customerSession,
        UrlInterface $urlBuilder,
        array $data = [])
    {
        $this->referralCollectionFactory = $referralCollectionFactory;
        $this->customerSession = $customerSession;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Get referreal by customer ID
     * @return false|Collection
     */
    public function getReferrals()
    {
        if (!($customerId = $this->customerSession->getCustomerId())) {
            return false;
        }
        $collection = $this->referralCollectionFactory->create()
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_id', ['eq' => $customerId]);
        return $collection;
    }

    public function getRedirectUrlDelete($referralId)
    {
        return $this->urlBuilder->getUrl(self::DELETE_REFERRAL_PATH, ['referral_id' => $referralId]);
    }

    public function getEditReferralUrl($referralId)
    {
        return $this->urlBuilder->getUrl(self::EDIT_REFERRAL_PATH, ['referral_id' => $referralId]);
    }


}
