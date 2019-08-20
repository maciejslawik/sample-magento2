<?php
declare(strict_types=1);

/**
 * File: SubscriberInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Api\Amqp;

/**
 * Interface SubscriberInterface
 * @package MSlwk\Sample\Api\Amqp
 */
interface SubscriberInterface
{
    /**
     * @param MessageInterface $message
     * @return void
     */
    public function processMessage(MessageInterface $message): void;
}
