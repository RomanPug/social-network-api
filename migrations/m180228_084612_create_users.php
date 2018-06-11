<?php

use yii\db\Migration;

/**
 * Class m180228_084612_create_users
 */
class m180228_084612_create_users extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'email' => $this->string(50)->notNull(),
            'password' => $this->string(50)->notNull(),
            'name' => $this->string(25)->notNull(),
            'surname' => $this->string(25)->defaultValue(null),
            'main_photo' => $this->string(100)->defaultValue(null),
            'title' => $this->string(20)->defaultValue(null),
            'last_visit' => $this->timestamp(),
            'create_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'is_blocked' => $this->boolean()->defaultValue(0),
            'is_deleted' => $this->boolean()->defaultValue(0),
        ]);

        // creates index for column `id`
        $this->createIndex(
            'idx-users-id',
            'users',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('users');
        return true;
    }
}
