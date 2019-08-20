<?php
declare(strict_types=1);

/**
 * File: Message.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Model\Amqp;

use MSlwk\Sample\Api\Amqp\MessageInterface;

/**
 * Class Message
 * @package MSlwk\Sample\Model\Amqp
 */
class Message implements MessageInterface
{
    /**
     * @var string
     */
    private $message;

    /**
     * @param string $message
     * @return void
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
