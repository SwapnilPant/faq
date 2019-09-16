<?php
/**
 * Etatvasoft Faq Module
 *
 * @category Etatvasoft
 * @package  Etatvasoft_Faq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
namespace Etatvasoft\CategoryFaq\Model;

use Etatvasoft\CategoryFaq\Api\CategoryFaqRepositoryInterface;
use Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterface;
use Etatvasoft\CategoryFaq\Model\CategoryFaqFactory;
use Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq\CollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\SearchResultsInterfaceFactory;

/**
 * Class FaqRepository
 *
 * @category Etatvasoft
 * @package  Etatvasoft_Faq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
class CategoryFaqRepository implements CategoryFaqRepositoryInterface
{
    /**
     * ObjectFactory
     *
     * @var \Etatvasoft\CategoryFaq\Model\CategoryFaqFactory
     */
    protected $objectFactory;

    /**
     * DataPageFactory
     *
     * @var \Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterfaceFactory
     */
    protected $dataPageFactory;

    /**
     * DataObjectHelper
     *
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * DataObjectProcessor
     *
     * @var \Magento\Framework\Reflection\DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * CollectionFactory
     *
     * @var \Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Constructor CategoryFaqRepository
     *
     * @param CategoryFaqFactory               $objectFactory        objectFactory
     * @param CollectionFactory             $collectionFactory    collectionFactory
     * @param DataObjectHelper              $dataObjectHelper     dataObjectHelper
     * @param DataObjectProcessor           $dataObjectProcessor  dataObjectProcessor
     * @param CategoryFaqInterfaceFactory      $dataPageFactory      dataPageFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory searchResultsFactory
     */
    public function __construct(
        CategoryFaqFactory $objectFactory,
        CollectionFactory $collectionFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        \Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterfaceFactory $dataPageFactory,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->objectFactory        = $objectFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPageFactory = $dataPageFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->collectionFactory    = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save CategoryFaqData
     *
     * @param object $object \Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterface
     *
     * @return object
     * @throws Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(CategoryFaqInterface $object)
    {
        if (empty($object->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $object->setStoreId($storeId);
        }
        try {
            $this->resource->save($object);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __(
                    'Could not save the brand: %1',
                    $e->getMessage()
                )
            );
        }
        return $object;
    }

    /**
     * Get CategoryFaq By Id
     *
     * @param int $id Categoryfaqid
     *
     * @return object
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id)
    {
        $object = $this->objectFactory->create();
        $object->load($id);
        if (!$object->getId()) {
            throw new NoSuchEntityException(__('Object with id "%1" does not exist.', $id));
        }
        return $object;
    }

    /**
     * Delete CategoryFaq
     *
     * @param object $object \Etatvasoft\CategoryFaq\Api\Data\CategoryFaqInterface
     *
     * @return boolean
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(CategoryFaqInterface $object)
    {
        try {
            $object->delete();
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }
        return true;
    }
     
    /**
     * Delete CategoryFaq By Id
     *
     * @param int $id categoryfaqid
     *
     * @return void
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
}
