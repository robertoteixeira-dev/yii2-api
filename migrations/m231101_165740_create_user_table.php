<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m231101_165740_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull()->unique(),
            'password' => $this->string(60)->notNull(),
            'phone' => $this->string(15),
            'address' => $this->text(),
            'role_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_user_role_id',
            '{{%user}}',
            'role_id',
            '{{%roles}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_role_id', '{{%user}}');
        $this->dropTable('{{%user}}');
    }
}
