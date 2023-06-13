<?php

use yii\db\Migration;

/**
 * Class m230613_182302_insert_colors
 */
class m230613_182302_insert_colors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('colors', [
            'name', 'value', 'label'
        ], [
            ['green', 'green', 'Зеленый'],
            ['white', 'white', 'Белый'],
            ['red', 'red', 'Красный'],
            ['yellow', 'yellow', 'Желтый'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('colors');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230613_182302_insert_colors cannot be reverted.\n";

        return false;
    }
    */
}
