<?php
/**
 * File: CartCounterSection.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\CustomerData;

use Magento\Checkout\Model\Session;
use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class CartCounterSection
 * @package MSlwk\Sample\CustomerData
 */
class CartCounterSection implements SectionSourceInterface
{
    /**
     * @var Session
     */
    private $session;

    /**
     * CartCounterSection constructor.
     * @param Session $session
     */
    public function __construct(
        Session $session
    ) {
        $this->session = $session;
    }

    /**
     * @return array
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getSectionData()
    {
        $counter = 0;

        foreach ($this->session->getQuote()->getAllVisibleItems() as $item) {
            $counter += $item->getQty();
        }
        return [
            'count' => $counter
        ];
    }
}
