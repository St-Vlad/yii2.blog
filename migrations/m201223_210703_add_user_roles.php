<?php

use yii\db\Migration;

/**
 * Class m201223_210703_add_user_roles
 */
class m201223_210703_add_user_roles extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%auth_items}}', ['type', 'name', 'description'], [
            [1, 'user', 'User'],
            [1, 'admin', 'Admin'],
        ]);

        $this->batchInsert('{{%auth_item_children}}', ['parent', 'child'], [
            ['user', 'admin'],
        ]);
    }

    public function down()
    {
        $this->delete('{{%auth_items}}', ['name' => ['user', 'admin']]);
    }
}
