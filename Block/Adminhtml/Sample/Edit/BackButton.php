<?php
/**
 * File: BackButton.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Block\Adminhtml\Sample\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

//Button for going back to referer URL from sample edit.

/**
 * Class BackButton
 * @package MSlwk\Sample\Block\Adminhtml\Sample\Edit
 */
class BackButton extends AbstractButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }
}
