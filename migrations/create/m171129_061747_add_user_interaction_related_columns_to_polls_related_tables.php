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

        $this->addForeignKey('fk_polls_deleted_by','{{%polls}}','deleted_by','{{%user}}}}',
            'id');
        $this->addForeignKey('fk_polls_answer_deleted_by','{{%polls_answer}}','deleted_by','{{%user}}}}',
            'id');
        $this->addForeignKey('fk_polls_result_deleted_by','{{%polls_result}','deleted_by','{{%user}}}}',
            'id');
        $this->addForeignKey('fk_polls_created_by','{{%polls}}','created_by','{{%user}}}}',
            'id');
        $this->addForeignKey('fk_polls_answer_created_by','{{%polls_answer}}','created_by','{{%user}}}}',
            'id');
        $this->addForeignKey('fk_polls_result_created_by','{{%polls_result}','created_by','{{%user}}}}',
            'id');
        $this->addForeignKey('fk_polls_updated_by','{{%polls}}','updated_by','{{%user}}}}',
            'id');
        $this->addForeignKey('fk_polls_answer_updated_by','{{%polls_answer}}','updated_by','{{%user}}}}',
            'id');
        $this->addForeignKey('fk_polls_result_updated_by','{{%polls_result}','updated_by','{{%user}}}}',
            'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_polls_result_updated_by','{{%polls_result}');
        $this->dropForeignKey('fk_polls_answer_updated_by','{{%polls_answer}}');
        $this->dropForeignKey('fk_polls_updated_by','{{%polls}}','updated_by');
        $this->dropForeignKey('fk_polls_result_created_by','{{%polls_result}');
        $this->dropForeignKey('fk_polls_answer_created_by','{{%polls_answer}}');
        $this->dropForeignKey('fk_polls_created_by','{{%polls}}','created_by');
        $this->dropForeignKey('fk_polls_result_deleted_by','{{%polls_result}');
        $this->dropForeignKey('fk_polls_answer_deleted_by','{{%polls_answer}}');
        $this->dropForeignKey('fk_polls_deleted_by','{{%polls}}');

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
