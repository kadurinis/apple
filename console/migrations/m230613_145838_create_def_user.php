<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m230613_145838_create_def_user
 */
class m230613_145838_create_def_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new User();
        $user->username = 'user';
        $user->email = 'user@test.com';
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword('user');
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        User::deleteAll(['username' => 'user']);
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230613_145838_create_def_user cannot be reverted.\n";

        return false;
    }
    */
}
