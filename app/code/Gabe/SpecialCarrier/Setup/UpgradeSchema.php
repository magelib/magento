<?php

namespace Gabe\SpecialCarrier\Setup;

class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface
{
    /**
     * install tables
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface   $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @return void
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            /**
             * Create table 'sales_order'
             */
            $installer->getConnection()->addColumn(
                    $installer->getTable('quote'),
                    'selected_carrier_data',
                    array(
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'length' => 100000,
                        'comment' => 'selected_carrier_data'
                    )
                );
            $installer->getConnection()->addColumn(
                $installer->getTable('sales_order'),
                'selected_carrier_data',
                array(
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 100000,
                    'comment' => 'selected_carrier_data'
                )
            );
        }
        $installer->endSetup();
    }
}
