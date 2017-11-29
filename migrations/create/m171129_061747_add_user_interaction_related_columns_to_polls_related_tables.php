<?php

use yii\db\Migration;

class m171129_061747_add_user_interaction_related_columns_to_polls_related_tables extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%polls}}', 'deleted_at', $this->integer(11));
        $this->addColumn('{{%polls_answers}}', 'deleted_at', $this->integer(11));
        $this->addColumn('{{%polls_result}}', 'deleted_at', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%polls_result}}', 'deleted_at');
        $this->dropColumn('{{%polls_answers}}', 'deleted_at');
        $this->dropColumn('{{%polls}}', 'deleted_at');
    }


}
