<?php

use yii\db\Expression;
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
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'title' => $this->string(50)->notNull(),
            'description' => $this->string(250)->notNull(),
            'text' => $this->string(1500)->notNull()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-article_id-user_id',
            'articles',
            'user_id',
            'users',
            'id',
            'RESTRICT',
            'CASCADE',
        );

        $this->addForeignKey(
            'fk-article_id-category_id',
            'articles',
            'category_id',
            'categories',
            'id',
            'RESTRICT',
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
