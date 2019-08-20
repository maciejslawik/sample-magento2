<?php
/**
 * File: InstallSchema.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\Sample\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Zend_Db_Exception;

//InstallSchema script is  run when module is enabled.
//It is responsible for creating required database tables.
//
//If you need to insert custom data when installing your module
//you should create another script, InstallData.

/**
 * Class InstallSchema
 * @package MSlwk\Sample\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        //Creating a custom table
        $table = $installer->getConnection()->newTable(
            $installer->getTable('mslwk_sample')
        )->addColumn(
            'entity_id',
            Table::TYPE_INTEGER,
            100,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Entity id'
        )->addColumn(
            'title',
            Table::TYPE_TEXT,
            32,
            ['nullable' => true],
            'Title'
        )->addColumn(
            'description',
            Table::TYPE_TEXT,
            1000,
            ['nullable' => true],
            'Description'
        )->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
            'Create date'
        )->addColumn(
            'quote_id',
            Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => true],
            'Entity id'
        )->addColumn(
            'order_id',
            Table::TYPE_INTEGER,
            null,
            ['unsigned' => true, 'nullable' => true],
            'Entity id'
        )->addForeignKey(
            $installer->getFkName(
                'mslwk_sample',
                'quote_id',
                'quote',
                'entity_id'
            ),
            'quote_id',
            $installer->getTable('quote'),
            'entity_id',
            Table::ACTION_SET_NULL
        )->addForeignKey(
            $installer->getFkName(
                'mslwk_sample',
                'order_id',
                'sales_order',
                'entity_id'
            ),
            'order_id',
            $installer->getTable('sales_order'),
            'entity_id',
            Table::ACTION_SET_NULL
        )->setComment(
            'MSlwk_Sample table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
