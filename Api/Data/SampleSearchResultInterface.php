<?php
/**
 * File: SampleSearchResultInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

//This is an interface for getList results

/**
 * Interface SampleSearchResultInterface
 * @package MSlwk\Sample\Api\Data
 */
interface SampleSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \MSlwk\Sample\Api\Data\SampleInterface[]
     */
    public function getItems();

    /**
     * @param \MSlwk\Sample\Api\Data\SampleInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
