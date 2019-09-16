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
namespace Etatvasoft\CategoryFaq\Controller\Adminhtml\CategoryFaqbackend;

/**
 * Class Edit
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
class Edit extends \Magento\Backend\App\Action
{
    /**
     * Result Page Factory
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * CategoryFaq Model
     *
     * @param array
     */
    protected $model;

    /**
     * Edit Constructor
     *
     * @param \Magento\Backend\App\Action\Context        $context           context
     * @param \Magento\Framework\Registry                $coreRegistry      Registry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory ResultpageFactory
     * @param \Etatvasoft\CategoryFaq\Model\CategoryFaq        $model             CategoryFaqModel
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Etatvasoft\CategoryFaq\Model\CategoryFaq $model
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->model = $model;
        $this->_coreRegistry = $coreRegistry;

        parent::__construct($context);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $resultPage = $this->resultPageFactory->create();
        $id = $this->getRequest()->getParam('id');
        $this->model->load($id);
        $this->_coreRegistry->register('currentCategoryFaq', $this->model);
        $this->initPage($resultPage)->getConfig()->getTitle()->prepend(__('Edit Category FAQ'));
        $resultPage->setActiveMenu('Magento_Backend::categoryfaq_settings');
        return $resultPage;
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage resultpage
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
         $resultPage->setActiveMenu('Etatvasoft_CategoryFaq::categoryfaq')
             ->addBreadcrumb(__('FAQ'), __('Manage Category FAQ'))
             ->addBreadcrumb(__('FAQ'), __('Manage Category FAQ'));

         return $resultPage;
    }

    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Etatvasoft_CategoryFaq::categoryfaq');
    }
}
