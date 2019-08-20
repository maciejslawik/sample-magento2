<?php
/**
 * File: BackButton.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Block\Adminhtml\Sample\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

//Button for submitting sample edit form.

/**
 * Class SaveButton
 * @package MSlwk\Sample\Block\Adminhtml\Sample\Edit
 */
class SaveButton extends AbstractButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Sample'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
