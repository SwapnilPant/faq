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
namespace Etatvasoft\CategoryFaq\Api;

use Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterface;

/**
 * Interface CategoryFaqRepositoryInterface
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
interface CategoryFaqRepositoryInterface
{
    /**
     * Save Data
     *
     * @param object $categoryfaq object
     *
     * @return \Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterface
     **/
    public function save(CategoryFaqInterface $categoryfaq);

    /**
     * Get Data By Id
     *
     * @param int $id Load Data by Id
     *
     * @return \Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterface
     **/
    public function getById($id);

    /**
     * Delete Object Data
     *
     * @param object $categoryfaq Object
     *
     * @return \Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterface
     **/
    public function delete(CategoryFaqInterface $categoryfaq);

    /**
     * Delete Data By ID
     *
     * @param int $id Delete Object By Id
     *
     * @return \Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterface
     **/
    public function deleteById($id);
}
