<?php

use yii\db\Migration;

/**
 * Class m201229_175651_create_table_tag
 */
class m201229_175651_create_table_tag extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB';

        $this->createTable('{{%tags}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%tags}}');
    }
}
