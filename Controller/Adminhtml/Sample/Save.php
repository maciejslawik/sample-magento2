<?php
/**
 * File: Save.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Controller\Adminhtml\Sample;

use MSlwk\Sample\Api\Data\SampleInterface;
use MSlwk\Sample\Api\Data\SampleInterfaceFactory;
use MSlwk\Sample\Api\Data\SampleRepositoryInterface;
use Magento\Backend\App\Action\Context;

//The controller handles saving a new sample or updating an existing one using a repository.

/**
 * Class Save
 * @package MSlwk\Sample\Controller\Adminhtml\Sample
 */
class Save extends AbstractController
{
    /**
     * @var SampleRepositoryInterface
     */
    private $sampleRepository;

    /**
     * @var SampleInterfaceFactory
     */
    private $sampleFactory;

    /**
     * Save constructor.
     * @param SampleRepositoryInterface $sampleRepository
     * @param SampleInterfaceFactory $sampleFactory
     * @param Context $context
     */
    public function __construct(
        SampleRepositoryInterface $sampleRepository,
        SampleInterfaceFactory $sampleFactory,
        Context $context
    ) {
        parent::__construct($context);
        $this->sampleRepository = $sampleRepository;
        $this->sampleFactory = $sampleFactory;
    }

    /**
     * @return void
     */
    public function execute()
    {
        $sampleData = $this->getRequest()->getParam('sample');
        if (isset($sampleData['entity_id'])) {
            /** @var SampleInterface $sample */
            $sample = $this->sampleRepository->getById($sampleData);
        } else {
            /** @var SampleInterface $sample */
            $sample = $this->sampleFactory->create();
        }
        $sample->setTitle($sampleData['title']);
        $sample->setDescription($sampleData['description']);
        $this->sampleRepository->save($sample);

        $this->_redirect('*/*/');
    }
}
