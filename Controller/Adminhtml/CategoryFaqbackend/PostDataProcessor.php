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
 * Class PostDataProcessor
 *
 * @category Etatvasoft
 * @package  Etatvasoft_CategoryFaq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
class PostDataProcessor
{
    /**
     * Date Filter
     *
     * @var \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    protected $dateFilter;

    /**
     * Validation Factory
     *
     * @var \Magento\Framework\View\Model\Layout\Update\ValidatorFactory
     */
    protected $validatorFactory;

    /**
     * Message Manager
     *
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * PostDataProcessor Class constructor
     *
     * @param \Magento\Framework\Stdlib\DateTime\Filter\Date               $dateFilter       DateFiletr
     * @param \Magento\Framework\Message\ManagerInterface                  $messageManager   MessageManager
     * @param \Magento\Framework\View\Model\Layout\Update\ValidatorFactory $validatorFactory ValidationFactory
     */
    public function __construct(
        \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\View\Model\Layout\Update\ValidatorFactory $validatorFactory
    ) {
        $this->dateFilter = $dateFilter;
        $this->messageManager = $messageManager;
        $this->validatorFactory = $validatorFactory;
    }

    /**
     * Validate post data
     *
     * @param array $data Datapost
     *
     * @return bool
     */
    public function validate($data)
    {
        $errorNo = true;
        $errorNo = $this->validateRequireEntry($data);
        
        if ($errorNo) {
            if (!in_array($data['is_active'], [0,1]) || $data['is_active'] == '' || is_null($data['is_active'])) {
                $errorNo = false;
                $this->messageManager->addError(
                    __("Please enter valid status.")
                );
            }
        }

        return $errorNo;
    }

    /**
     * Check if required fields is not empty
     *
     * @param array $data RequireFields
     *
     * @return bool
     */
    public function validateRequireEntry(array $data)
    {
        $requiredFields = [
            'categoryfaq_question' => __('Question'),
            'is_active' => __('Status'),
            'categoryfaq_answer' => __('Answer'),
            'store_id' => __('Storeview')
        ];
        $errorNo = true;
        foreach ($data as $field => $value) {
            if (in_array($field, array_keys($requiredFields)) && $value == '') {
                $errorNo = false;
                $this->messageManager->addError(
                    __('To apply changes you should fill valid value to required "%1" field', $requiredFields[$field])
                );
            }
        }
        return $errorNo;
    }
}
