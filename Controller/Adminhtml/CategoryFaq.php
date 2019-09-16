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
namespace Etatvasoft\CategoryFaq\Controller\Adminhtml;

/**
 * Class CategoryFaq
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
abstract class CategoryFaq extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;

    /**
     * CategoryFaq constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context      context
     * @param \Magento\Framework\Registry         $coreRegistry coreregistry
     */
    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry)
    {
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage Resultpage
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Etatvasoft_CategoryFaq::etatvasoft_categoryfaq')
            ->addBreadcrumb(__('Category FAQ'), __('Category FAQ'))
            ->addBreadcrumb(__('Items'), __(''));
        return $resultPage;
    }

    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Etatvasoft_CategoryFaq::etatvasoft_categoryfaq');
    }

    /**
     * InitAttachment
     *
     * @return mixed Attachnebtobject
     */
    protected function initCategoryFaqData()
    {

        $categoryfaqId = (int)$this->getRequest()->getParam('id');

        $categoryfaqId = $categoryfaqId ? $categoryfaqId : (int)$this->getRequest()->getParam('categoryfaq_id');

        $categoryfaqmodel = $this->_objectManager->create(\Etatvasoft\CategoryFaq\Model\CategoryFaq::class);

        if ($categoryfaqId) {
            $categoryfaqmodel->load($categoryfaqId);
        }

        $this->coreRegistry->register('currentCategoryFaq', $categoryfaqId);

        return $categoryfaqmodel;
    }
}
