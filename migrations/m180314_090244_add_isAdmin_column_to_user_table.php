<?php

use yii\db\Migration;

/**
 * Handles adding isAdmin to table `user`.
 */
class m180314_090244_add_isAdmin_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'isAdmin', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'isAdmin');
    }
}
