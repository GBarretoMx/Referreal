<?php
declare(strict_types=1);
namespace WolfSellers\Referred\Model;

use Magento\Framework\Api\SearchResults;
use WolfSellers\Referred\Api\Data\ReferredSearchResultsInterface;

class ReferredSearchResults extends SearchResults implements ReferredSearchResultsInterface
{
}

