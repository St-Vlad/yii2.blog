<?php

use yii\db\Migration;

/**
 * Class m201220_104345_create_table_articles
 */
class m201220_104345_create_table_articles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB';

        $this->createTable('{{%articles}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'category_id' => $this->integer(),
            'title' => $this->string(32)->notNull(),
            'description' => $this->string(100)->notNull(),
            'text' => $this->string()->notNull()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-article_id-user_id',
            'articles',
            'user_id',
            'users',
            'id',
            'SET NULL',
            'CASCADE',
        );

        $this->addForeignKey(
            'fk-article_id-category_id',
            'articles',
            'category_id',
            'categories',
            'id',
            'SET NULL',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-article_id-user_id',
            'articles'
        );

        $this->dropForeignKey(
            'fk-article_id-category_id',
            'articles'
        );

        $this->dropTable('{{%articles}}');
    }
}
