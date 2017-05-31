<?php
/**
 * MageSpecialist
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@magespecialist.it so we can send you a copy immediately.
 *
 * @category   MSP
 * @package    MSP_SecuritySuiteCommon
 * @copyright  Copyright (c) 2017 Skeeller srl (http://www.magespecialist.it)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace MSP\SecuritySuiteCommon\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    private function setupTableLog(SchemaSetupInterface $setup)
    {
        $tableName = $setup->getTable('msp_securitysuite_log');
        $table = $setup->getConnection()
            ->newTable($tableName)
            ->addColumn('msp_securitysuite_log_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Entry ID'
            )
            ->addColumn('datetime',
                Table::TYPE_DATETIME,
                null,
                ['nullable' => false],
                'Date and Time'
            )
            ->addColumn('ip',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'IP'
            )
            ->addColumn('module',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Module'
            )
            ->addColumn('user',
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'User'
            )
            ->addColumn('message',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Message'
            )
            ->addColumn('url',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'URL'
            )
            ->addColumn('count',
                Table::TYPE_INTEGER,
                null,
                ['nullable' => false],
                'Count'
            )
            ->addColumn('action',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Action'
            )
            ->addColumn('additional',
                Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Additional Information'
            )
            ->addIndex(
                $setup->getIdxName(
                    $tableName,
                    ['module'],
                    AdapterInterface::INDEX_TYPE_INDEX
                ),
                [['name' => 'module', 'size' => 128]],
                ['type' => AdapterInterface::INDEX_TYPE_INDEX]
            )
            ->addIndex(
                $setup->getIdxName(
                    $tableName,
                    ['ip'],
                    AdapterInterface::INDEX_TYPE_INDEX
                ),
                [['name' => 'ip', 'size' => 128]],
                ['type' => AdapterInterface::INDEX_TYPE_INDEX]
            )
            ->addIndex(
                $setup->getIdxName(
                    $tableName,
                    ['datetime'],
                    AdapterInterface::INDEX_TYPE_INDEX
                ),
                ['datetime'],
                ['type' => AdapterInterface::INDEX_TYPE_INDEX]
            );

        $setup->getConnection()->createTable($table);
    }

    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        $this->setupTableLog($setup);

        $setup->endSetup();
    }
}