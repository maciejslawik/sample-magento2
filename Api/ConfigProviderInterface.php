<?php
/**
 * File: ConfigProviderInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Api;

//Module API for providing data from the configuration of the module

/**
 * Interface ConfigProviderInterface
 * @package MSlwk\Sample\Api
 */
interface ConfigProviderInterface
{
    /**
     * @return bool
     */
    public function getBoolValue(): bool;

    /**
     * @return string
     */
    public function getTextValue(): string;
}
