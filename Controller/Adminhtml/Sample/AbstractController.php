<?php
/**
 * File: AbstractController.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action;

//Abstract controller for all sample-related controllers. Ensures all controllers
//are behind the ACL resource defined in this class.

/**
 * Class AbstractController
 * @package MSlwk\Sample\Controller\Adminhtml\Sample
 */
abstract class AbstractController extends Action
{
    /** @var string */
    public const ADMIN_RESOURCE = 'MSlwk_Sample::sample_manage';
}
