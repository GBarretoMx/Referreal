<?php
declare(strict_types=1);
namespace WolfSellers\Referred\Controller\Referrals;

use Magento\Framework\App\ActionInterface;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface;
use Psr\Log\LoggerInterface;
use WolfSellers\Referred\Api\ReferredRepositoryInterface;


class Delete implements ActionInterface
{

    /**
     * @var CustomerSession
     */
    protected CustomerSession $customerSession;

    /**
     * @var ReferredRepositoryInterface
     */
    protected ReferredRepositoryInterface $referralRepository;

    /**
     * @var Http
     */
    protected Http $request;

    /**
     * @var ManagerInterface
     */
    protected ManagerInterface $messageManager;

    /**
     * @var RedirectFactory
     */
    protected RedirectFactory $redirectFactory;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param CustomerSession $customerSession
     * @param ReferredRepositoryInterface $referralRepository
     * @param Http $request
     * @param ManagerInterface $messageManager
     * @param RedirectFactory $redirectFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        CustomerSession $customerSession,
        ReferredRepositoryInterface $referralRepository,
        Http $request,
        ManagerInterface $messageManager,
        RedirectFactory $redirectFactory,
        LoggerInterface $logger,
    )
    {
        $this->customerSession = $customerSession;
        $this->referralRepository = $referralRepository;
        $this->request = $request;
        $this->messageManager = $messageManager;
        $this->redirectFactory = $redirectFactory;
        $this->logger = $logger;
    }

    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->redirectFactory->create();

       $referralId = $this->request->getParam('referral_id', null) ?? '';

       if (!empty($referralId) && $this->customerSession->isLoggedIn()) {
           try {
               $this->referralRepository->deleteById((int)$referralId);
               $this->messageManager->addSuccessMessage(__('Delete Referral Successfully'));
           } catch (\Exception $exception){
               $this->logger->debug('DELETE_REFERRAL', ['exception' => $exception]);
               $this->messageManager->addErrorMessage(__('You are not allowed to delete this referral.'));
           }
       }
        return $resultRedirect->setPath('referral/referrals/index');
    }
}
