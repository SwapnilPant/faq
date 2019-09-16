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
namespace Etatvasoft\CategoryFaq\Model;

use Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterface as Bi;

/**
 * Class CategoryFaq
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
class CategoryFaq extends \Magento\Framework\Model\AbstractModel implements Bi
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**
     * CategoryFaq Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq');
    }

    /**
     * Get Stores
     *
     * @return array
     */
    public function getStores()
    {
        return $this->hasData('stores') ? $this->getData('stores') : (array)$this->getData('store_id');
    }

    /**
     * Get Categoryfaq id
     *
     * @return int
     */
    public function getId()
    {
        return parent::getData(self::FAQ_ID);
    }

    /**
     * Set Categoryfaq id
     *
     * @param int $id CategoryFaqid
     *
     * @return void
     */
    public function setId($id)
    {
        return $this->setData(self::FAQ_ID, $id);
    }
    /**
     * Set Categoryfaq Categories
     *
     * @param Categories $Categories CategoryFaqid
     *
     * @return void
     */
    public function setCategoriesIds($Categories)
    {
        return $this->setData(self::FAQCATEGORIES_IDS, $Categories);
    }
    public function getCategoriesIds()
    {
        return parent::getData(self::FAQCATEGORIES_IDS);
    }
}
