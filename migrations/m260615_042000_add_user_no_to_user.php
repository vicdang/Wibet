<?php

use yii\db\Migration;

/**
 * Class m260615_042000_add_user_no_to_user
 */
class m260615_042000_add_user_no_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'user_no', $this->integer()->unsigned()->null()->after('id'));

        // Backfill existing users with a sequential number starting from 1,
        // ordered by id (creation order)
        $rows = $this->db->createCommand('SELECT id FROM `user` ORDER BY id ASC')->queryAll();
        $userNo = 1;
        foreach ($rows as $row) {
            $this->update('user', ['user_no' => $userNo], ['id' => $row['id']]);
            $userNo++;
        }

        $this->alterColumn('user', 'user_no', $this->integer()->unsigned()->notNull());
        $this->createIndex('idx-user-user_no', 'user', 'user_no', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-user-user_no', 'user');
        $this->dropColumn('user', 'user_no');
    }
}
