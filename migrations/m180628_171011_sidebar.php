<?php

use yii\db\Migration;

/**
 * Class m180628_171011_sidebar
 */
class m180628_171011_sidebar extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sidebar', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->defaultValue('Новая строка'),
            'url' => $this->string(100)->notNull()->defaultValue(''),
            'icon_url' => $this->string(100)->defaultValue(null),
            'create_at' => 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'is_blocked' => $this->tinyInteger()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sidebar');
    }
}
