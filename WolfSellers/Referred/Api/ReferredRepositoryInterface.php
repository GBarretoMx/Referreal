<?php
declare(strict_types=1);
namespace WolfSellers\Referred\Api;

use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Exception\NoSuchActionException;
use WolfSellers\Referred\Api\Data\ReferredInterface;
use WolfSellers\Referred\Api\Data\ReferredSearchResultsInterface;

interface ReferredRepositoryInterface
{
    /**
     * Save Referred
     * @param ReferredInterface $referred
     * @return ReferredInterface
     * @throws LocalizedException
     */
    public function save(ReferredInterface $referred);

    /**
     * Get Referred By ID
     * @param $id
     * @return ReferredInterface
     * @throws LocalizedException
     */
    public function getById($id);

    /**
     * Delete Referred
     * @param ReferredInterface $referred
     * @return void
     */
    public function delete(ReferredInterface $referred);

    /**
     * Delete Referred By Id
     * @param int $id
     * @return bool on success
     * @throws NoSuchActionException
     * @throws LocalizedException
     */
    public function deleteById($id);


    /**
     * Retrieve Referred matching the specified criteria
     * @param SearchCriteriaInterface $searchCriteria
     * @return ReferredSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

}
