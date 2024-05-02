<?php
declare(strict_types=1);
namespace WolfSellers\Referred\Controller\Referrals;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Message\ManagerInterface;
use Psr\Log\LoggerInterface;
use WolfSellers\Referred\Api\ReferredRepositoryInterface;
use WolfSellers\Referred\Model\ReferredFactory as ReferredModelFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\App\Request\Http;
use Magento\Customer\Model\Session as CustomerSession;

class SaveEdit implements ActionInterface
{
    /**
     * @var ManagerInterface
     */
    protected ManagerInterface $messageManager;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var ReferredRepositoryInterface
     */
    protected ReferredRepositoryInterface $referralRepository;

    /**
     * @var ReferredModelFactory
     */
    private ReferredModelFactory $referralsModelFactory;

    /**
     * @var RedirectFactory
     */
    protected RedirectFactory $redirectFactory;

    /**
     * @var Http
     */
    protected Http $request;

    /**
     * @var CustomerSession
     */
    protected CustomerSession $customerSession;



    public function __construct(
        ManagerInterface $messageManager,
        LoggerInterface $logger,
        ReferredRepositoryInterface $referralRepository,
        ReferredModelFactory $referralsModelFactory,
        RedirectFactory $redirectFactory,
        Http $request,
        CustomerSession $customerSession,
    )
    {
        $this->messageManager = $messageManager;
        $this->logger = $logger;
        $this->referralsModelFactory = $referralsModelFactory;
        $this->referralRepository = $referralRepository;
        $this->redirectFactory = $redirectFactory;
        $this->request = $request;
        $this->customerSession = $customerSession;
    }

    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->redirectFactory->create();
         $referralId = $this->request->getParam("referred_edit_id");
         $firstname = $this->request->getParam("referred_edit_firstname");
         $lastname = $this->request->getParam("referred_edit_lastname");
         $email = $this->request->getParam("referred_edit_email");
         $phone = $this->request->getParam("referred_edit_phone");


         if ($referralId && $this->customerSession->isLoggedIn()) {
             $referral = $this->referralRepository->getById($referralId);
             if ($firstname) {
                 $referral->setFirstName($firstname);
             }
             if ($lastname) {
                 $referral->setLastName($lastname);
             }
             if ($email) {
                 $referral->setEmail($email);
             }
             if ($phone) {
                 $referral->setPhone($phone);
             }
             $this->referralRepository->save($referral);

             $this->messageManager->addSuccessMessage(__('Successfully updated referral information.'));
         } else {
             $this->messageManager->addErrorMessage(__('You are not authorized to perform this action.'));
         }


        return $resultRedirect->setPath('referral/referrals/index');
    }

}
