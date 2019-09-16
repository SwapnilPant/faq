<?php
/**
 * Etatvasoft Faq Module
 *
 * @category Etatvasoft
 * @package  Etatvasoft_Faq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
namespace Etatvasoft\CategoryFaq\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * Class InstallSchema
 *
 * @category Etatvasoft
 * @package  Etatvasoft_Faq
 * @author   Etatvasoft <magento@etatvasoft.com>
 * @license  https://www.etatvasoft.com  Open Software License (OSL 3.0)
 * @link     https://www.etatvasoft.com
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Install table
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface   $setup   Setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context Context
     *
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();
       
        $table = $installer->getConnection()->newTable(
            $installer->getTable('etatvasoft_categoryfaq')
        )->addColumn(
            'categoryfaq_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            11,
            ['identity' => true, 'nullable' => false, 'primary' => true,'unsigned' => true],
            'Faq Id'
        )->addColumn(
            'categoryfaq_question',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false,'LENGTH' =>255],
            'Faq Question'
        )->addColumn(
            'categoryfaq_answer',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64K',
            ['nullable' => false,'LENGTH' =>255],
            'Faq Answer'
        )->addColumn(
            'categoryfaq_categories_ids',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => true,'LENGTH' =>255],
            'Faq Categories'
        )->addColumn(
            'is_active',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false, 'default' => '1'],
            'Is Faq Active'
        )->addColumn(
            'sort_order',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['default' => '0'],
            'Faq Sort Order'
        )->addColumn(
            'creation_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
            'Faq Created DateTime'
        )->addColumn(
            'update_time',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
            'Faq Modified DateTime'
        )
        ->setComment(
            'Etatvasoft FAQ Table'
        );
        $installer->getConnection()->createTable($table);


        $table = $installer->getConnection()->newTable(
            $installer->getTable('etatvasoft_categoryfaq_store')
        )->addColumn(
            'categoryfaq_store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true,'unsigned' => true],
            'Primary Key'
        )->addColumn(
            'categoryfaq_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['nullable' => false,'unsigned' => true],
            'Faq Id'
        )->addColumn(
            'store_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['nullable' => false,'unsigned' => true],
            'Store Id'
        )->addForeignKey(
            $installer->getFkName('etatvasoft_categoryfaq_key', 'categoryfaq_id', 'etatvasoft_categoryfaq', 'categoryfaq_id'),
            'categoryfaq_id',
            $installer->getTable('etatvasoft_categoryfaq'),
            'categoryfaq_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->addForeignKey(
            $installer->getFkName('etatva_categoryfaq_store_key', 'store_id', 'store', 'store_id'),
            'store_id',
            $installer->getTable('store'),
            'store_id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )
        ->setComment(
            'Etatvasoft FAQ Store Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}
