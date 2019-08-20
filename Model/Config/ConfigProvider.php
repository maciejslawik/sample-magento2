<?php
/**
 * File: ConfigProvider.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Model\Config;

//Implementation of the config provider API
//It's good practise to create a consistent config provider for your configuration

use MSlwk\Sample\Api\ConfigProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class ConfigProvider
 * @package MSlwk\Sample\Model\Config
 */
class ConfigProvider implements ConfigProviderInterface
{
    //Paths to config values based on XML configuration

    /** @var string */
    public const XML_PATH_SAMPLE_GENERAL_BOOL = 'sample/general/bool';

    /** @var string */
    public const XML_PATH_SAMPLE_GENERAL_TEXT = 'sample/general/text';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * ConfigProvider constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function getBoolValue(): bool
    {
        return (bool) $this->scopeConfig->getValue(self::XML_PATH_SAMPLE_GENERAL_BOOL);
    }

    /**
     * @return string
     */
    public function getTextValue(): string
    {
        return (string) $this->scopeConfig->getValue(self::XML_PATH_SAMPLE_GENERAL_TEXT);
    }
}
