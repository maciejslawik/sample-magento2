<?php
declare(strict_types=1);

/**
 * File: Subscriber.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Model\Amqp;

use MSlwk\Sample\Api\Amqp\MessageInterface;
use MSlwk\Sample\Api\Amqp\SubscriberInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Subscriber
 * @package MSlwk\Sample\Model\Amqp
 */
class Subscriber implements SubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Subscriber constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param MessageInterface $message
     * @return void
     */
    public function processMessage(MessageInterface $message): void
    {
        $this->logger->debug($message->getMessage());
    }
}
