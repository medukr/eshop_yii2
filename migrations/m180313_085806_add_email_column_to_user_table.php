<?php

use yii\db\Migration;

/**
 * Handles adding email to table `user`.
 */
class m180313_085806_add_email_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'email', $this->string());
        $this->addColumn('user', 'name', $this->string());
        $this->addColumn('user', 'address', $this->string());
        $this->addColumn('user', 'phone', $this->integer());
        $this->addColumn('user', 'create_at', $this->timestamp());
        $this->addColumn('user', 'update_at', $this->timestamp());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'update_at');
        $this->dropColumn('user', 'create_at');
        $this->dropColumn('user', 'phone');
        $this->dropColumn('user', 'address');
        $this->dropColumn('user', 'name');
        $this->dropColumn('user', 'email');

    }
}
