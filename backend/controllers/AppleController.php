<?php

namespace backend\controllers;

use backend\models\apple\AppleEat;
use backend\models\apple\AppleGenerator;
use backend\models\apple\AppleModel;
use backend\models\apple\AppleState;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class AppleController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index', [
            'model' => ($model = new AppleModel()),
            'provider' => $model->search(\Yii::$app->request->get())
        ]);
    }

    public function actionGenerate() {
        $model = new AppleGenerator();
        $model->generate();
        if ($model->getErr()) {
            \Yii::$app->session->setFlash('error', $model->getErr());
        }
        return $this->redirect(['apple/index']);
    }

    public function actionEat() {
        $model = $this->findApple(\Yii::$app->request->get('id'))->toEat;
        $model->load(\Yii::$app->request->post());
        if ($model->eat()->hasErrors()) {
            \Yii::$app->session->setFlash('error', $model->getErr());
        }
        $model->apply();
        return $this->redirect(['apple/index']);
    }

    public function actionFall() {
        $model = $this->findApple(\Yii::$app->request->get('id'))->toState;
        if ($model->fall()->hasErrors()) {
            \Yii::$app->session->setFlash('error', $model->getErr());
        }
        $model->apply();
        return $this->redirect(['apple/index']);
    }

    /**
     * @param $id
     * @param $class
     * @return AppleModel|AppleEat
     * @throws BadRequestHttpException
     */
    protected function findApple($id, $class = AppleModel::class) {
        if ($model = $class::findOne($id)) {
            return $model;
        }
        throw new BadRequestHttpException("Apple {$id} not found");
    }
}