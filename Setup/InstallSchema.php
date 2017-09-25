<?php
/**
 * @author    Created by Stanislav Chertilin.
 * @copyright Test task for Maven.
 */

namespace Maven\Test\Setup;

use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    ) {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable('maven_test_manufacturer')
        )
            ->addColumn(
                'id',
                Table::TYPE_INTEGER,
                null,
                [
                    'unsigned' => true,
                    'primary' => true,
                    'nullable' => false,
                    'auto_increment' => true
                ],
                'Manufacturer Id'
            )
            ->addColumn(
                'name',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable => false'
                ],
                'Manufacturer Name'
            )
            ->addColumn(
                'code',
                Table::TYPE_TEXT,
                255,
                [
                    'nullable => false'
                ],
                'Manufacturer Code'
            )
            ->addColumn(
                'description',
                Table::TYPE_TEXT,
                null,
                [],
                'Manufacturer Description'
            )
            ->addColumn(
                'image',
                Table::TYPE_BLOB,
                '3M',
                [],
                'Manufacturer Image'
            )
            ->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                [],
                'Manufacturer Created At'
            )
            ->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                [],
                'Manufacturer Updated At'
            )
            ->addIndex('name', 'name')
            ->addIndex('code', 'code');

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}