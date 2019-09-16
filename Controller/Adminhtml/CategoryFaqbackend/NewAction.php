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

/**
 * Class NewAction
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
class NewAction extends \Etatvasoft\CategoryFaq\Controller\Adminhtml\CategoryFaq
{
    /**
     * ResultPageFactory
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * NewAction Class constructor
     *
     * @param \Magento\Backend\App\Action\Context        $context           Context
     * @param \Magento\Framework\Registry                $coreRegistry      Coreregistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory ResultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->getConfig()->getTitle()->prepend(__('Add New Category FAQ'));
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
