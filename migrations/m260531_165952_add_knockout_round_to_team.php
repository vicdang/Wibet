<?php

use yii\db\Migration;

/**
 * Class m260531_165952_add_knockout_round_to_team
 */
class m260531_165952_add_knockout_round_to_team extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('team', 'knockout_round', $this->string(50)->null()->after('group_name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260531_165952_add_knockout_round_to_team cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260531_165952_add_knockout_round_to_team cannot be reverted.\n";

        return false;
    }
    */
}
