<?php

namespace lslsoft\poll\models;

use Yii;

/**
 * This is the model class for table "polls_answers".
 *
 * @property integer $id
 * @property integer $id_poll
 * @property string $answer
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * @property integer $deleted_at
 * @property integer $deleted_by
 *
 * @property Polls $idPoll
 */
class PollsAnswers extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     *
     *  working with polls
     */
    public static function tableName()
    {
        return 'polls_answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_poll', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'], 'integer'],
            [['answer'], 'required'],
            [['answer'], 'string'],
            [['id_poll'], 'exist', 'skipOnError' => true, 'targetClass' => Polls::className(), 'targetAttribute' => ['id_poll' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('polls', '№ answer'),
            'id_poll' => Yii::t('polls', '№ poll'),
            'answer' => Yii::t('polls', 'Answer'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPoll()
    {
        return $this->hasOne(Polls::className(), ['id' => 'id_poll']);
    }

    public function get

    /**
     * @inheritdoc
     * @return PollsAnswersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PollsAnswersQuery(get_called_class());
    }

    public function getAnswers()
    {
        return $this->hasMany(Polls::className(), ['id' => 'id_poll']);
    }


}
