<?php
declare(strict_types=1);
namespace WolfSellers\Referred\Model;

use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\TemporaryState\CouldNotSaveException;
use WolfSellers\Referred\Api\Data\ReferredInterface;
use WolfSellers\Referred\Api\Data\ReferredSearchResultsInterfaceFactory;
use WolfSellers\Referred\Api\ReferredRepositoryInterface;
use WolfSellers\Referred\Model\ResourceModel\Referred as ReferredResource;
use WolfSellers\Referred\Model\ReferredFactory;
use WolfSellers\Referred\Model\ResourceModel\Referred\CollectionFactory as ReferredCollectionFactory;

class ReferredRepository implements ReferredRepositoryInterface
{

    /**
     * @var ReferredResource
     */
    protected ReferredResource $resource;

    /**
     * @var \WolfSellers\Referred\Model\ReferredFactory
     */
    protected ReferredFactory $referredFactory;

    /**
     * @var ReferredCollectionFactory
     */
    protected ReferredCollectionFactory $referredCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected CollectionProcessorInterface $collectionProcessor;

    /**
     * @var ReferredSearchResultsInterfaceFactory
     */
    protected ReferredSearchResultsInterfaceFactory $searchResultsFactory;


    public function __construct(
        ReferredResource $resource,
        ReferredFactory $referredFactory,
        ReferredCollectionFactory $referredCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        ReferredSearchResultsInterfaceFactory $searchResultsFactory,
    )
    {
        $this->resource        = $resource;
        $this->referredFactory = $referredFactory;
        $this->referredCollectionFactory = $referredCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @param ReferredInterface $referred
     * @return Referred
     * @throws CouldNotSaveException
     */
    public function save(ReferredInterface $referred)
    {
        try {
            $this->resource->save($referred);
        } catch (LocalizedException $exception) {
            throw new CouldNotSaveException(__(
                'Could not save referred: %1',
                $exception->getMessage()
            ));
        }
    }

    /**
     * Load Referred by given  Referred Identity
     * @param $id
     * @return ReferredInterface
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $referred = $this->referredFactory->create();
        $this->resource->load($referred, $id);
        if (!$referred->getEntityId()) {
            throw new NoSuchEntityException(__(
                'Referred with id "%1" does not exist.',
                $id
            ));
        }
        return $referred;
    }

    /**
     * Delete Referred
     * @param ReferredInterface $referred
     * @return true
     * @throws CouldNotDeleteException
     */
    public function delete(ReferredInterface $referred)
    {
        try {
            $this->resource->delete($referred);

        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Referred: %1',
                $exception->getMessage()
            ));
        }
    }


    /**
     * Delete Referred By ID
     * @param $id
     * @return true
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }


    /**
     * Load Referred data collection by given search criteria
     * @param SearchCriteriaInterface $searchCriteria
     * @return \WolfSellers\Referred\Api\Data\ReferredSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->referredCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;

    }
}
