<?php

use yii\db\Migration;

/**
 * Class m230613_154556_init_apple_tables
 */
class m230613_154556_init_apple_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('apple', [
            'id' => $this->primaryKey(),
            'active' => $this->boolean()->defaultValue(1)->comment('active after generate'),
            'color_name' => $this->string(64),
            'size_value' => $this->float(2)->defaultValue(100)->comment('Apple size in percent'),
            'created_at' => $this->integer()->comment('unix timestamp of creating apple'),
            'created_by' => $this->integer()->comment('unix timestamp when apple created'),
            'fell_at' => $this->integer()->comment('timestamp when apple fell from tree'),
        ], $tableOptions);

        $this->createTable('colors', [
            'name' => $this->string(64)->comment('code name of color'),
            'value' => $this->string(64)->comment('style value'),
            'label' => $this->string(64)->comment('Label to display'),
        ], $tableOptions);

        $this->createTable('eats', [
            'id' => $this->primaryKey(),
            'apple_id' => $this->integer(),
            'eat_value' => $this->float(2)->comment('size that was eaten per time in percent'),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
        ], $tableOptions);

        $this->addPrimaryKey('PK_color', 'colors', 'name');
        $this->addForeignKey('FK_apple_color', 'apple', 'color_name', 'colors', 'name');
        $this->addForeignKey('FK_eat_apple', 'eats', 'apple_id', 'apple', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_eat_apple', 'eats');
        $this->dropForeignKey('FK_apple_color', 'apple');
        $this->dropPrimaryKey('PK_color', 'colors');

        $this->dropTable('eats');
        $this->dropTable('colors');
        $this->dropTable('apple');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230613_154556_init_apple_tables cannot be reverted.\n";

        return false;
    }
    */
}
