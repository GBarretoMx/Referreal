<?php
declare(strict_types=1);
namespace WolfSellers\Referred\Controller\Referrals;

use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\Message\ManagerInterface;
use Psr\Log\LoggerInterface;
use WolfSellers\Referred\Api\ReferredRepositoryInterface;
use WolfSellers\Referred\Model\ReferredFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Customer\Model\Session as CustomerSession;
use WolfSellers\Referred\Api\Data\ReferredInterfaceFactory;
use WolfSellers\Referred\Model\ResourceModel\Referred\CollectionFactory as ReferredCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;


class AddReferral implements ActionInterface
{
    /**
     * @var ReferredFactory
     */
    protected ReferredFactory $referralFactory;

    /**
     * @var ReferredRepositoryInterface
     */
    protected ReferredRepositoryInterface $referralRepository;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var ManagerInterface
     */
    protected ManagerInterface $messageManager;

    /**
     * @var RedirectFactory
     */
    protected RedirectFactory $redirectFactory;

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @var CustomerSession
     */
    protected CustomerSession $customerSession;

    /**
     * @var ReferredInterfaceFactory
     */
    protected ReferredInterfaceFactory $referralDataFactory;

    /**
     * @var CustomerFactory
     */
    protected CustomerFactory $customerFactory;

    /**
     * @var ReferredCollectionFactory
     */
    protected ReferredCollectionFactory $referralCollectionFactory;

    protected StoreManagerInterface $storeManager;




    public function __construct(
        ReferredFactory $referralFactory,
        ReferredRepositoryInterface $referralRepository,
        LoggerInterface $logger,
        ManagerInterface $messageManager,
        RedirectFactory $redirectFactory,
        RequestInterface $request,
        CustomerSession $customerSession,
        ReferredInterfaceFactory $referralDataFactory,
        CustomerFactory $customerFactory,
        ReferredCollectionFactory $referralCollectionFactory,
        StoreManagerInterface $storeManager
    )
    {
        $this->referralFactory = $referralFactory;
        $this->referralRepository = $referralRepository;
        $this->logger = $logger;
        $this->messageManager = $messageManager;
        $this->redirectFactory = $redirectFactory;
        $this->request = $request;
        $this->customerSession = $customerSession;
        $this->referralDataFactory = $referralDataFactory;
        $this->customerFactory = $customerFactory;
        $this->referralCollectionFactory = $referralCollectionFactory;
        $this->storeManager = $storeManager;
    }

    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->redirectFactory->create();

        $firstName  = $this->request->getParam('referred_firstname');
        $lastName   = $this->request->getParam('referred_lastname');
        $email      = $this->request->getParam('referred_email');
        $phone      = $this->request->getParam('referred_phone');

        if (!($customerId = $this->customerSession->getCustomer()->getId())) {
            $this->messageManager->addErrorMessage(__('You need to log in first.'));
            return $resultRedirect->setPath('referral/referrals/index');
        }

        if ($this->getReferralByEmail($email)->getId()) {
            $this->messageManager->addNoticeMessage(__('The client has already been referred previously'));
            return $resultRedirect->setPath('referral/referrals/index');
        }

        try {

            $model = $this->referralFactory->create();
            $model->setFirstName($firstName);
            $model->setLastName($lastName);
            $model->setEmail($email);
            $model->setPhone($phone);
            if($this->getCustomerByEmail($email)) {
                $model->setStatus(false);
            }
            $model->setCustomerId((int)$customerId);
            $this->referralRepository->save($model);

            $this->messageManager->addSuccessMessage('Add New Referral');

        } catch (\Exception $exception) {
            $this->logger->debug("REFERRED", ['ERROR' => $exception->getMessage()]);
            $this->messageManager->addErrorMessage('try it later');
        }
        return $resultRedirect->setPath('referral/referrals/index');
    }


    /**
     * @param string $email
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCustomerByEmail(string $email)
    {
        $websiteID = $this->storeManager->getStore()->getWebsiteId();
        $loadCustomer = $this->customerFactory->create()->setWebsiteId($websiteID)->loadByEmail($email);
        if ($loadCustomer->getId()) {
            return true;
        }
        return false;
    }

    /**
     * @param string $email
     * @return \Magento\Framework\DataObject
     */
    public function getReferralByEmail(string $email)
    {
        return $this->referralCollectionFactory->create()
            ->addFieldToSelect('*')
            ->addFieldToFilter('email', ['eq' => $email])->getFirstItem();
    }

}


