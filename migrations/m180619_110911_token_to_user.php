<?php

use yii\db\Migration;

/**
 * Class m180619_110911_token_to_user
 */
class m180619_110911_token_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'token', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180619_110911_token_to_user cannot be reverted.\n";

        return false;
    }
}
