<?php

use yii\db\Migration;

/**
 * Class m180228_090117_create_users_chats
 */
class m180228_090117_create_users_chats extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('users_chats', [
            'id' => $this->primaryKey()->notNull(),
            'chat_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'is_deleted' => $this->boolean()->defaultValue(0),
        ]);

        $this->createTable('chats', [
            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'create_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'is_deleted' => $this->boolean()->defaultValue(0),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-users_chats-user_id',
            'users_chats',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-users_chats-user_id',
            'users_chats',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        // creates index for column `chat_id`
        $this->createIndex(
            'idx-users_chats-chat_id',
            'users_chats',
            'chat_id'
        );

        // add foreign key for table `chats`
        $this->addForeignKey(
            'fk-users_chats-chat_id',
            'users_chats',
            'chat_id',
            'chats',
            'id',
            'CASCADE'
        );

        //---------------------------------------------------------------------------------

        $this->createTable('messages', [
            'id' => $this->primaryKey()->notNull(),
            'user_id_from' => $this->integer(11)->notNull(),
            'chat_id' => $this->integer(11)->notNull(),
            'message_text' => $this->text()->notNull(),
            'create_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'likes' => $this->integer(7)->defaultValue(0),
            'dislikes' => $this->integer(7)->defaultValue(0),
            'is_deleted' => $this->boolean()->defaultValue(0),
        ]);

        // creates index for column `chats`
        $this->createIndex(
            'idx-messages-chat_id',
            'messages',
            'chat_id'
        );

        // add foreign key for table `chats`
        $this->addForeignKey(
            'fk-messages-chat_id',
            'messages',
            'chat_id',
            'chats',
            'id',
            'CASCADE'
        );

        //---------------------------------------------------------------------------------

        $this->createTable('message_attachment', [
            'id' => $this->primaryKey()->notNull(),
            'message_id' => $this->integer(11)->notNull(),
            'type' => "ENUM('photo', 'video', 'music', 'file')",
            'attach' => $this->string(100),
        ]);

        // creates index for column `chats`
        $this->createIndex(
            'idx-message_attachment-message_id',
            'message_attachment',
            'message_id'
        );

        // add foreign key for table `chats`
        $this->addForeignKey(
            'fk-message_attachment-message_id',
            'message_attachment',
            'message_id',
            'messages',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo 'Uncomment this (file: m180228_090117_create_users_chats.php) 
        if you want to delete this tables (for reliability), and return true';

//        $this->dropTable('users_chats');
//        $this->dropTable('chats');
//        $this->dropTable('messages');
//        $this->dropTable('message_attachment');

        return false;
    }
}
