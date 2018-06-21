<?php

use yii\db\Migration;

/**
 * Class m180621_162904_gender_to_user
 */
class m180621_162904_gender_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'gender', $this->string()->defaultValue(null)->after('surname'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'gender');
    }
}
