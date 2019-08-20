<?php
/**
 * File: NewActionTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Test\Integration\Controller\Adminhtml\Sample;

use Magento\TestFramework\TestCase\AbstractBackendController;

/**
 * Class NewActionTest
 * @package MSlwk\Sample\Test\Integration\Controller\Adminhtml\Sample
 */
class NewActionTest extends AbstractBackendController
{
    /**
     * @var string
     */
    protected $resource = 'MSlwk_Sample::sample_manage';
    /**
     * @var string
     */
    protected $uri = 'backend/sample/sample/delete';
}
