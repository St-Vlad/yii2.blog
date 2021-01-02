<?php

use yii\db\Migration;

/**
 * Class m201230_081927_add_unique_attribute_for_name_field_in_tags
 */
class m201230_081927_add_unique_attribute_for_name_field_in_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->alterColumn(
            'tags',
            'name',
            $this->string(50)->unique()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropIndex('name', 'tags');
    }
}
