<?php

use yii\db\Migration;

/**
 * Class m180217_143723_test_table
 */
class m180217_143723_test_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('test_table', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'description' => $this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('test_table');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180217_143723_test_table cannot be reverted.\n";

        return false;
    }
    */
}
