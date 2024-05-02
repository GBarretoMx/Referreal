<?php
declare(strict_types=1);
namespace WolfSellers\Referred\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use WolfSellers\Referred\Model\ResourceModel\Referred\CollectionFactory as ReferredCollectionFactory;

class ReferredByCustomerId implements ResolverInterface
{
    /**
     * @var ReferredCollectionFactory
     */
    protected ReferredCollectionFactory $collectionFactory;

    /**
     * @param ReferredCollectionFactory $collectionFactory
     */
    public function __construct(
        ReferredCollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param Field $field
     * @param $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array[]
     * @throws GraphQlInputException
     * @throws GraphQlNoSuchEntityException
     */
    public function resolve(
                            Field $field,
                            $context,
                            ResolveInfo $info,
                            array $value = null,
                            array $args = null)
    {

        if (empty($args['customer_id'])) {
            throw new GraphQlInputException(__('Required parameter "customerId" missing'));
        }
        $collection = $this->collectionFactory->create()
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_id', ['eq' => $args['customer_id']])
            ->getData();

        if (empty($collection)) {
            throw new GraphQlNoSuchEntityException(__('Could not find referred by ID'));
        }
        try {
            $referred = [];
            foreach ($collection as $item) {

                $referred[] = [
                    'entity_id'   => $item['entity_id'],
                    'first_name'  => $item['first_name'],
                    'last_name'   => $item['last_name'],
                    'email'       => $item['email'],
                    'phone'       => $item['phone'],
                    'status'      => $item['status'],
                    'customer_id' => $item['customer_id'],
                ];
            }

            return ['referred' => $referred];

        } catch (\Exception $exception) {
            throw new GraphQlInputException(__($exception->getMessage()), $exception);
        }
    }

}
