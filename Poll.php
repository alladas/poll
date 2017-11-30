<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace lslsoft\poll;

use lslsoft\poll\models\Polls;
use lslsoft\poll\models\PollsResult;
use lslsoft\poll\models\PollsResultSearch;
use Yii;
use yii\base\Widget;

class Poll extends Widget
{

    /**
     * Model for poll results
     * @var type
     */
    private $model;

    /**
     * Define id_poll which poll will be questioned
     * @var integer
     */
    public $idPoll;

    /**
     * Define how to show results: chart or table
     * @var type string
     */
    public $resultView;

    /**
     * Contain poll for which voting will be organized
     * @var type Polls
     */
    private $pollsProvider;

    public function init()
    {
        parent::init();
    }

    /**
     * Creates a new PollsResult model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    private function createResult()
    {
        $modelsaved = false;
        $answers = $this->model->id_answer;
        foreach ($answers as $id_answer) {
            $modelMulti = new PollsResult();
//			$modelMulti->id_user = $this->model->id_user;
            $modelMulti->id_poll = $this->model->id_poll;
            $modelMulti->num = $this->model->num;
//			$modelMulti->create_at = $this->model->create_at;
            $modelMulti->ip = $this->model->ip;
            $modelMulti->host = $this->model->host;
            $modelMulti->id_answer = $id_answer;

            if (!$modelMulti->save()) {
                $modelsaved = false;
                print_r($modelMulti->errors);
                return false;
            } else {
                $modelsaved = true;
            }
        }
        return $modelsaved;
    }

    /**
     * set $model properties
     * @param type $model
     * @return type $model - PollsResult
     */
    private function setModel()
    {
        $this->model->id_poll = $this->pollsProvider->id;
        $this->model->num = PollsResult::getMaxNum($this->pollsProvider->id);
        if (!isset($this->model->num)) {
            $this->model->num = 1;
        } else {
            $this->model->num++;
        }
//		$this->model->create_at = date( "Y-m-d H:i:s" );
        $this->model->ip = Yii::$app->request->getUserIP();
        $this->model->host = Yii::$app->request->getUserHost();
        if ($this->pollsProvider->anonymous) {
            $this->model->scenario = PollsResult::SCENARIO_ANONYMOUS;
            $this->model->id_user = 0;
        } else {
            if (!Yii::$app->user->isGuest) {
                $this->model->id_user = Yii::$app->user->getId();
            }
        }
    }

    /**
     * Return poll for voting
     * @return type Polls
     */
    public function getProvider()
    {
        if (isset($this->idPoll)) {
            return Polls::getIdPoll($this->idPoll);
        } else {
            $pollVote = Polls::getPollToday();
            if (isset($pollVote)) {
                $this->idPoll = $pollVote->id;
            }
            return $pollVote;
        }
    }

    /**
     *
     * @return type
     */
    public function run()
    {
        // Register AssetBundle
// Register AssetBundle
        //  PollAsset::register($this->getView());
        $this->model = new PollsResult();
        $this->pollsProvider = $this->getProvider();//barbaric of course
        if (!isset($this->pollsProvider)) {
            return;
        }
        $modelsaved = false;
        if ($this->model->load(Yii::$app->request->post())) {
            $this->setModel();
            Yii::$app->session->set('poll-' . $this->idPoll, true);
            /**
             * @todo I need do something with guest user. now i have user with ID=0;
             */
            if (is_array($this->model->id_answer)) {
                $modelsaved = $this->createResult();
            } else {
                $modelsaved = $this->model->save();
                redirect('/');
            }
            if (!$modelsaved) {
                return $this->render('@vendor/lslsoft/yii2-poll/views/create', [
                    'model' => $this->model,
                    'pollsProvider' => $this->pollsProvider,]);

            }
        }

        if (!$this->pollsProvider->show_vote) {
            return; //if show result wasn't allowed nothing would happen
        }
        $searchModel = new PollsResultSearch();
        $dataProvider = $searchModel->search(['id_poll' => $this->idPoll]);
        if ($dataProvider->count && Yii::$app->session->get('poll-'.$this->idPoll)) {
            if (!isset($this->resultView)) {
                return $this->render('@vendor/lslsoft/yii2-poll/views/chart', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                    'question' => $this->pollsProvider->question,
                    'sumRes' => $this->model->num
                ]);

            }
            return $this->render('@vendor/lslsoft/yii2-poll/views/table', ['dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'question' => $this->pollsProvider->question,
                'sumRes' => $this->model->num]);

        } else {
//            Yii::$app->session->set('poll-' . $this->idPoll, true);
            return $this->render('@vendor/lslsoft/yii2-poll/views/create', [
                'model' => $this->model,
                'pollsProvider' => $this->pollsProvider,]);


        }

    }

}
