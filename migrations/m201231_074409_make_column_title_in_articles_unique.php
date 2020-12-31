<?php

use yii\db\Migration;

/**
 * Class m201231_074409_make_column_title_in_articles_unique
 */
class m201231_074409_make_column_title_in_articles_unique extends Migration
{
    public function up()
    {
        $this->alterColumn(
            'articles',
            'title',
            $this->string(50)->unique()
        );
    }

    public function down()
    {
        $this->dropIndex('title', 'articles');
    }
}
