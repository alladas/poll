<?php

namespace lslsoft\poll\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use lslsoft\poll\models\PollsResult;

/**
 * PollsResultSearch represents the model behind the search form about `backend\models\PollsResult`.
 */
class PollsResultSearch extends PollsResult
{

    /**
     * @inheritdoc
     */
    public $answer;

    public function rules()
    {
        return [
            [['num', 'id_poll', 'id_answer'], 'integer'],
            [['answer'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
//        $query = PollsResult::find()
//            ->select('id_answer, count(`id_answer`) as `res`')
//            ->joinWith('idAnswer')
//            ->groupBy(['id_answer'])
//            ->where(['polls_result.id_poll' => $params['id_poll']]);


        $query = PollsAnswers::find()
            ->select('polls_answers.answer,polls_answers.id, count(polls_result.id) as `res`')
            ->leftJoin('polls_result', 'id_answer = polls_answers.id')
            ->groupBy([PollsAnswers::tableName() . '.id'])
            ->where(['polls_answers.id_poll' => $params['id_poll']])->andWhere(['polls_answers.deleted_at' => null]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }

}
