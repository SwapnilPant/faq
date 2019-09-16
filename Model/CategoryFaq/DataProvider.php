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
namespace Etatvasoft\CategoryFaq\Model\CategoryFaq;

use Etatvasoft\CategoryFaq\Model\ResourceModel\CategoryFaq\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * Collection
     *
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection
     */
    protected $collection;

    /**
     * Data Persistor
     *
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * Loaddata
     *
     * @var array
     */
    protected $loadedData;

    /**
     * Storemanager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    public $storeManager;

    /**
     * Constructor DataProvider
     *
     * @param string                 $name                 name
     * @param string                 $primaryFieldName     Primaryfieldname
     * @param string                 $requestFieldName     Requestfieldname
     * @param CollectionFactory      $CategoryfaqCollectionFactory CategoryfaqCollectionFactory
     * @param StoreManagerInterface  $storeManager         StoreManager
     * @param DataPersistorInterface $dataPersistor        DataPersistor
     * @param array                  $meta                 Meta
     * @param array                  $data                 Data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $categoryfaqCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $categoryfaqCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager=$storeManager;
        
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $model->setData('categoryfaq_categories_ids',array_filter(explode(',',$model->getData()['categoryfaq_categories_ids'])));
            $this->loadedData[$model->getId()] = $model->getData();
        }

        $data = $this->dataPersistor->get('categoryfaqdata');
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('categoryfaqdata');
        }

        
        return $this->loadedData;
    }
}
