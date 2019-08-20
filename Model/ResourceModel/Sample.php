<?php
/**
 * File: Sample.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

//This is the CRUD ResourceModel

/**
 * Class Sample
 * @package MSlwk\Sample\Model\ResourceModel
 */
class Sample extends AbstractDb
{
    /**
     * This method is responsible for telling Magento which table should be used
     * for model persistence and which column is the ID.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mslwk_sample', 'entity_id');
    }
}
