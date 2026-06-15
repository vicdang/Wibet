<?php

use yii\db\Migration;

/**
 * Class m260615_041300_add_match_no_to_match
 */
class m260615_041300_add_match_no_to_match extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('match', 'match_no', $this->integer()->unsigned()->null()->after('id'));

        // Backfill existing matches with a sequential number starting from 1,
        // ordered by id (creation order)
        $rows = $this->db->createCommand('SELECT id FROM `match` ORDER BY id ASC')->queryAll();
        $matchNo = 1;
        foreach ($rows as $row) {
            $this->update('match', ['match_no' => $matchNo], ['id' => $row['id']]);
            $matchNo++;
        }

        $this->alterColumn('match', 'match_no', $this->integer()->unsigned()->notNull());
        $this->createIndex('idx-match-match_no', 'match', 'match_no', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-match-match_no', 'match');
        $this->dropColumn('match', 'match_no');
    }
}
