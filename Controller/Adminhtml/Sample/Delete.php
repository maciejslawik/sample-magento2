<?php
/**
 * File: Delete.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Controller\Adminhtml\Sample;

use MSlwk\Sample\Api\Data\SampleRepositoryInterface;
use Magento\Backend\App\Action\Context;

//Controller for deleting an instance of sample. It uses the repository to
//delete the sample.

/**
 * Class Delete
 * @package MSlwk\Sample\Controller\Adminhtml\Sample
 */
class Delete extends AbstractController
{
    /**
     * @var SampleRepositoryInterface
     */
    private $sampleRepository;

    /**
     * Delete constructor.
     * @param SampleRepositoryInterface $sampleRepository
     * @param Context $context
     */
    public function __construct(
        SampleRepositoryInterface $sampleRepository,
        Context $context
    ) {
        parent::__construct($context);
        $this->sampleRepository = $sampleRepository;
    }

    /**
     * @return void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $this->sampleRepository->deleteById($id);

        $this->_redirect('*/*/');
    }
}
