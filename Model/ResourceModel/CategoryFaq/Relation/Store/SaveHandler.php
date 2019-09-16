<?php
/**
 * Etatvasoft CategoryFaq
 *
 * @category Etatvasoft
 * @package  Etatvasoft_Faq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
namespace Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq\Relation\Store;

use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterface;
use Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq;
use Magento\Framework\EntityManager\MetadataPool;

/**
 * Class SaveHandler
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
class SaveHandler implements ExtensionInterface
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
     * Save Storeids into database
     *
     * @param object $entity    entity
     * @param array  $arguments arguments
     *
     * @return object
     * @throws \Exception
     */
    public function execute($entity, $arguments = [])
    {
        $entityMetadata = $this->metadataPool->getMetadata(CategoryFaqInterface::class);
        $linkField = $entityMetadata->getLinkField();
        $connection = $entityMetadata->getEntityConnection();
        $oldStores = $this->resourcePage->lookupStoreIds((int)$entity->getId());
        $newStores = $entity->getStores();

        if (!empty($newStores)) {
            $newStores = json_decode($newStores[0]);
        }
        if (is_array($newStores) && is_array($oldStores)) {
            $table = $this->resourcePage->getTable('etatvasoft_categoryfaq_store');
            $delete = array_diff($oldStores, $newStores);
            if ($delete) {
                $where = [
                $linkField . ' = ?' => (int)$entity->getData($linkField),
                'store_id IN (?)' => $delete,
                ];
                $connection->delete($table, $where);
            }
            $insert = array_diff($newStores, $oldStores);
            if ($insert) {
                $data = [];
                foreach ($insert as $storeId) {
                    $data[] = [
                    $linkField => (int)$entity->getData($linkField),
                    'store_id' => (int)$storeId
                    ];
                }
                $connection->insertMultiple($table, $data);
            }
        }
        return $entity;
    }
}
