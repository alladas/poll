<?php

use yii\db\Migration;

class m171129_061747_add_user_interaction_related_columns_to_polls_related_tables extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%polls}}', 'deleted_at', $this->integer(11));
        $this->addColumn('{{%polls}}', 'deleted_by', $this->integer(11));
        $this->addColumn('{{%polls_answers}}', 'deleted_at', $this->integer(11));
        $this->addColumn('{{%polls_answers}}', 'deleted_by', $this->integer(11));
        $this->addColumn('{{%polls_result}}', 'deleted_at', $this->integer(11));
        $this->addColumn('{{%polls_result}}', 'deleted_by', $this->integer(11));
        $this->addColumn('{{%polls}}', 'created_at', $this->integer(11));
        $this->addColumn('{{%polls}}', 'created_by', $this->integer(11));
        $this->addColumn('{{%polls_answers}}', 'created_at', $this->integer(11));
        $this->addColumn('{{%polls_answers}}', 'created_by', $this->integer(11));
        $this->addColumn('{{%polls_result}}', 'created_at', $this->integer(11));
        $this->addColumn('{{%polls_result}}', 'created_by', $this->integer(11));
        $this->addColumn('{{%polls}}', 'updated_at', $this->integer(11));
        $this->addColumn('{{%polls}}', 'updated_by', $this->integer(11));
        $this->addColumn('{{%polls_answers}}', 'updated_at', $this->integer(11));
        $this->addColumn('{{%polls_answers}}', 'updated_by', $this->integer(11));
        $this->addColumn('{{%polls_result}}', 'updated_at', $this->integer(11));
        $this->addColumn('{{%polls_result}}', 'updated_by', $this->integer(11));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%polls_result}}','updated_by');
        $this->dropColumn('{{%polls_result}}','updated_at');
        $this->dropColumn('{{%polls_answers}}','updated_by');
        $this->dropColumn('{{%polls_answers}}','updated_at');
        $this->dropColumn('{{%polls}}','updated_by');
        $this->dropColumn('{{%polls}}','updated_at');
        $this->dropColumn('{{%polls_result}}','created_by');
        $this->dropColumn('{{%polls_result}}','created_at');
        $this->dropColumn('{{%polls_answers}}','created_by');
        $this->dropColumn('{{%polls_answers}}','created_at');
        $this->dropColumn('{{%polls}}','created_by');
        $this->dropColumn('{{%polls}}','created_at');
        $this->dropColumn('{{%polls_result}}', 'deleted_by');
        $this->dropColumn('{{%polls_result}}', 'deleted_at');
        $this->dropColumn('{{%polls_answers}}', 'deleted_by');
        $this->dropColumn('{{%polls_answers}}', 'deleted_at');
        $this->dropColumn('{{%polls}}', 'deleted_by');
        $this->dropColumn('{{%polls}}', 'deleted_at');
    }


}
