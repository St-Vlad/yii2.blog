<?php

use yii\db\Migration;

/**
 * Class m201223_204332_add_foreign_key_for_user
 */
class m201223_204332_add_foreign_key_for_user extends Migration
{
    public function up()
    {
        $this->alterColumn(
            '{{%auth_assignments}}',
            'user_id',
            $this->integer()->notNull()
        );

        $this->createIndex(
            '{{%idx-auth_assignments-user_id}}',
            '{{%auth_assignments}}',
            'user_id'
        );

        $this->addForeignKey(
            '{{%fk-auth_assignments-user_id}}',
            '{{%auth_assignments}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-auth_assignments-user_id}}', '{{%auth_assignments}}');

        $this->dropIndex('{{%idx-auth_assignments-user_id}}', '{{%auth_assignments}}');
    }
}
