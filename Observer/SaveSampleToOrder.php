<?php
/**
 * File: SaveSampleToOrder.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Observer;

use Exception;
use MSlwk\Sample\Api\Data\SampleRepositoryInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Model\Order;
use Magento\Sales\Api\Data\OrderExtensionFactory;

/**
 * Class SaveSampleToOrder
 * @package MSlwk\Sample\Observer
 */
class SaveSampleToOrder implements ObserverInterface
{
    /**
     * @var SampleRepositoryInterface
     */
    private $sampleRepository;

    /**
     * @var OrderExtensionFactory
     */
    private $extensionFactory;

    /**
     * SaveSampleToOrder constructor.
     * @param SampleRepositoryInterface $sampleRepository
     * @param OrderExtensionFactory $extensionFactory
     */
    public function __construct(
        SampleRepositoryInterface $sampleRepository,
        OrderExtensionFactory $extensionFactory
    ) {
        $this->sampleRepository = $sampleRepository;
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var Order $order */
        $order = $observer->getEvent()->getOrder();
        /** @var Quote $quote */
        $quote = $observer->getEvent()->getQuote();
        try {
            $sample = $this->sampleRepository->getByQuoteId((int)$quote->getId());
            $extensionAttributes = $order->getExtensionAttributes() ?? $this->extensionFactory->create();

            $extensionAttributes->setSample($sample);
            $order->setExtensionAttributes($extensionAttributes);
        } catch (Exception $e) {
        }
    }
}
