<?php
/**
 * Etatvasoft CategoryFaq
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
namespace Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq\Relation\Store;

use Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;

/**
 * Class ReadHandler
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
class ReadHandler implements ExtensionInterface
{
    /**
     * MetadataPool
     *
     * @var MetadataPool
     */
    protected $metadataPool;

    /**
     * ResourcePage
     *
     * @var Page
     */
    protected $resourcePage;

    /**
     * ReadHandler Class constructor
     *
     * @param \Magento\Framework\EntityManager\MetadataPool     $metadataPool metadataPool
     * @param \Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq $resourcePage resourcePage
     **/
    public function __construct(
        MetadataPool $metadataPool,
        CategoryFaq $resourcePage
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourcePage = $resourcePage;
    }

    /**
     * Set Storeids
     *
     * @param object $entity    entity
     * @param array  $arguments arguments
     *
     * @return object
     */
    public function execute($entity, $arguments = [])
    {
        if ($entity->getId()) {
            $stores = $this->resourcePage->lookupStoreIds((int)$entity->getId());
            $entity->setData('store_id', $stores);
        }
        return $entity;
    }
}
