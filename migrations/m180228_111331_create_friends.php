<?php

use yii\db\Migration;

/**
 * Class m180228_111331_create_friends
 */
class m180228_111331_create_friends extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('friends', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(10)->notNull(),
            'friend_id' => $this->integer(10)->notNull(),
            'invite_time' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'remove_time' => $this->timestamp()->defaultValue(null),
            'is_deleted' => $this->boolean()->defaultValue(0),
        ]);

        // creates index for column `friends`
        $this->createIndex(
            'idx-friends-user_id',
            'friends',
            'user_id'
        );

        // add foreign key for table `friends`
        $this->addForeignKey(
            'fk-friends-user_id',
            'friends',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('friends');
        return false;
    }
}
