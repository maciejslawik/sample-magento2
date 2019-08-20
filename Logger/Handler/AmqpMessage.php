<?php
/**
 * File: AmqpMessage.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Logger\Handler;

use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

/**
 * Class AmqpMessage
 * @package MSlwk\Sample\Logger\Handler
 */
class AmqpMessage extends Base
{
    /**
     * @var string
     */
    protected $fileName = '/var/log/mslwk/amqp.log';

    /**
     * @var int
     */
    protected $loggerType = Logger::INFO;
}
