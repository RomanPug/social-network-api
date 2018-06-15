<?php

use yii\db\Migration;

/**
 * Class m180613_115811_tokens
 */
class m180613_115811_tokens extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tokens', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(10)->notNull(),
            'token' => $this->string(255)->notNull()->unique(),
            'time' => $this->integer()->notNull()
        ]);

        // creates index for column `friends`
        $this->createIndex(
            'idx-tokens-user_id',
            'tokens',
            'user_id'
        );

        // add foreign key for table `friends`
        $this->addForeignKey(
            'fk-tokens-user_id',
            'tokens',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tokens');
        return false;
    }
}
