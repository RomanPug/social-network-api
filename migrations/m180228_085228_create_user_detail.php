<?php

use yii\db\Migration;

/**
 * Class m180228_085228_create_user_detail
 */
class m180228_085228_create_user_detail extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('user_detail', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'country' => $this->string(3)->defaultValue(null),
            'city' => $this->string(20)->defaultValue(null),
            'favorite_books' => $this->text()->defaultValue(null),
            'favorite_music' => $this->text()->defaultValue(null),
            'favorite_films' => $this->text()->defaultValue(null),
            'favorite_recreation' => $this->text()->defaultValue(null),
            'birthday_year' => $this->date()->defaultValue(null),
            'birthday_month' => $this->smallInteger(2)->defaultValue(null),
            'birthday_day' => $this->smallInteger(2)->defaultValue(null),
            'family_status' => $this->string(50)->defaultValue(null),
            'mobile_phone' => $this->integer(14)->defaultValue(null),
            'skype' => $this->string(30)->defaultValue(null),
            'about' => $this->text()->defaultValue(null),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_detail-user_id',
            'user_detail',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_detail-user_id',
            'user_detail',
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
        $this->dropTable('user_detail');

        return true;
    }
}
