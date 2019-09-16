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
namespace Etatvasoft\CategoryFaq\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

 /**
  * Class CategoryFaq
  *
  * @category Etatvasoft
  * @package  Etatvasoft_CategoryFaq
  * @author   Etatvasoft <magento@etatvasoft.com>
  * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
  * @link     https://www.etatvasoft.com
  */
class CategoryFaq extends Template implements BlockInterface
{
    /**
     * CategoryFaq factory
     *
     * @var \Etatvasoft\CategoryFaq\Model\CategoryFaqFactory
     */
    protected $categoryfaqFactory;

    /**
     * CategoryFaq Item Collection Factory
     *
     * @var \Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq\CollectionFactory
     */
    protected $itemCollectionFactory;

    /**
     * CategoryFaq Items
     *
     * @var \Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq\Collection
     */
    protected $items;
    protected $categoryHelper;

    /**
     * CategoryFaq constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context Context
     * @param \Etatvasoft\CategoryFaq\Model\CategoryFaqFactory $categoryfaqFactory categoryfaqFactory
     * @param \Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq\CollectionFactory $itemCollectionFactory itemCollectionFactory
     * @param array $data Array Data
     */
    public function __construct(
        Template\Context $context,
        \Etatvasoft\CategoryFaq\Model\CategoryFaqFactory $categoryfaqFactory,
        \Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq\CollectionFactory $itemCollectionFactory,
        \Magento\Framework\Registry $categoryHelper,
        array $data = []
    ) {
        $this->categoryfaqFactory = $categoryfaqFactory;
        $this->itemCollectionFactory = $itemCollectionFactory;
        $this->categoryHelper = $categoryHelper;
        
        parent::__construct($context, $data);
    }

    /**
     * Get items
     *
     * @return bool|\Etatavsoft\CategoryFaq\Model\ResourceModel\CategoryFaq\Collection
     */
    public function getCategoryFaqItems()
    {
        if (!$this->items) {
            $this->items = $this->itemCollectionFactory->create()->addFieldToSelect(
                '*'
            )->addFieldToFilter(
                'is_active',
                ['eq' => \Etatvasoft\CategoryFaq\Model\CategoryFaq::STATUS_ENABLED]
            )->addStoreFilter($this->_storeManager->getStore()->getId())
                ->addOrder('sort_order', 'asc')
                ->addOrder('creation_time', 'desc');
        }
        return $this->items;
    }
    public function getCurrentCategory()
    {
        return $this->categoryHelper->registry('current_category')->getId();
    }
}
