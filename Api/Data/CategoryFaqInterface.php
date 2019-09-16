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
namespace Etatvasoft\CategoryFaq\Api\Data;

/**
 * Interface CategoryFaqInterface
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
interface CategoryFaqInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const FAQ_ID          = 'categoryfaq_id';
    const FAQCATEGORIES_IDS          = 'categoryfaq_categories_ids';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set ID
     *
     * @param int $id set categoryfaq id
     *
     * @return \Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterface
     */
    public function setId($id);

    /**
     * Get Stores
     *
     * @return array
     */
    public function getStores();
}
