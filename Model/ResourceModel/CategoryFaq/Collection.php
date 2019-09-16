<?php
/**
 * Etatvasoft CategoryFaq Module
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
namespace Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq;

use Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterface;
use Etatvasoft\CategoryFaq\Model\ResourceModel\AbstractCollection;

/**
 * Class Collection
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
class Collection extends AbstractCollection
{
    /**
     * Primary fieldname
     *
     * @var string
     */
    protected $_idFieldName = 'categoryfaq_id';

    /**
     * Load data for preview flag
     *
     * @var bool
     */
    protected $_previewFlag;

    /**
     * Collection Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Etatvasoft\CategoryFaq\Model\CategoryFaq', 'Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq');
        $this->_map['fields']['categoryfaq_id'] = 'main_table.categoryfaq_id';
        $this->_map['fields']['store'] = 'store_table.store_id';
    }

    /**
     * Add filter by store
     *
     * @param int|array|\Magento\Store\Model\Store $store     storeid
     * @param bool                                 $withAdmin isadmin
     *
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        if (!$this->getFlag('store_filter_added')) {
            $this->performAddStoreFilter($store, $withAdmin);
        }
        return $this;
    }

    /**
     * Set first store flag
     *
     * @param bool $flag flag
     *
     * @return $this
     */
    public function setFirstStoreFlag($flag = false)
    {
        $this->_previewFlag = $flag;
        return $this;
    }

    /**
     * Perform operations after collection load
     *
     * @return $this
     */
    protected function _afterLoad()
    {
        $entityMetadata = $this->metadataPool->getMetadata(CategoryFaqInterface::class);
        $this->performAfterLoad('etatvasoft_categoryfaq_store', $entityMetadata->getLinkField());
        $this->_previewFlag = false;

        return parent::_afterLoad();
    }

    /**
     * Perform operations before rendering filters
     *
     * @return void
     */
    protected function _renderFiltersBefore()
    {
        $entityMetadata = $this->metadataPool->getMetadata(CategoryFaqInterface::class);
        $this->joinStoreRelationTable('etatvasoft_categoryfaq_store', $entityMetadata->getLinkField());
    }
}
