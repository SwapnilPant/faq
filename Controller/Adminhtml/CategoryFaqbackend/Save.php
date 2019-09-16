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
namespace Etatvasoft\CategoryFaq\Controller\Adminhtml\CategoryFaqbackend;

use Etatvasoft\CategoryFaq\Model\CategoryFaq;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Etatvasoft\CategoryFaq\Controller\Adminhtml\CategoryFaqbackend\PostDataProcessor;

/**
 * Class Save
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
class Save extends \Etatvasoft\CategoryFaq\Controller\Adminhtml\CategoryFaq
{
    /**
     * Admin Resource
     *
     * @param string
     */
    const ADMIN_RESOURCE = 'Etatvasoft_CategoryFaq::categoryfaq';

    /**
     * Data Processor
     *
     * @var \Etatvasoft\CategoryFaq\Controller\Adminhtml\CategoryFaqbackend\PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * Data Persostor
     *
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * Productattachment Model
     *
     * @var \Etatvasoft\CategoryFaq\Model\CategoryFaq
     */
    protected $model;

    /**
     * Save constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context       Context
     * @param PostDataProcessor                   $dataProcessor DataProcessor
     * @param CategoryFaq                            $model         CategoryFaqModel
     * @param DataPersistorInterface              $dataPersistor Data Persistor
     * @param \Magento\Framework\Registry         $coreRegistry  Coreregistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        PostDataProcessor $dataProcessor,
        CategoryFaq $CategoryFaqModel,
        DataPersistorInterface $dataPersistor,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        $this->CategoryFaqModel = $CategoryFaqModel;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Save action execute
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (!$this->dataProcessor->validate($data)) {
                return $resultRedirect->setPath('*/*/edit', ['id' => $CategoryFaqModel->getId(), '_current' => true]);
            }
            
            try {
                $data['store_id'] = json_encode($data['store_id']);
                $data['categoryfaq_categories_ids']=implode(",",array_unique($data['categoryfaq_categories_ids']));
                $this->CategoryFaqModel->setData($data);
                $this->CategoryFaqModel->save();

                $this->messageManager->addSuccess(__('Category FAQ is saved successfully.'));
                $this->dataPersistor->clear('categoryfaqdata');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath(
                        '*/*/edit',
                        ['id' => $this->CategoryFaqModel->getId(),
                         '_current' => true]
                    );
                }

                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Category Faq.'));
            }

            $this->dataPersistor->set('categoryfaqdata', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->CategoryFaqModel->getId()]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
