<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m231101_165936_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'body' => $this->text(),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'deleted_at' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_post_created_by',
            '{{%post}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_post_created_by', '{{%post}}');
        $this->dropTable('{{%post}}');
    }
}
