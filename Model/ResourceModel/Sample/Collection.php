<?php
/**
 * File: Collection.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Model\ResourceModel\Sample;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

//This is the CRUD Collection

/**
 * Class Collection
 * @package MSlwk\Sample\Model\ResourceModel
 */
class Collection extends AbstractCollection
{
    /**
     * This function is responsible for telling Magento about the model
     * and resource model for the collection class.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'MSlwk\Sample\Model\Sample',
            'MSlwk\Sample\Model\ResourceModel\Sample'
        );
    }
}
