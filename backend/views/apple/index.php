<?php
/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $provider
 * @var \backend\models\apple\AppleModel $model
 */

use backend\models\apple\AppleModel;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$this->title = Yii::$app->name;
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <?= \yii\helpers\Html::a('Generate', ['apple/generate'], ['class' => 'btn btn-primary pull-right']) ?>
    </div>
    <div class="panel-body">
        <?= GridView::widget([
            'dataProvider' => $provider,
            //'filterModel' => $model,
            'columns' => [
                'id:text',
                [
                    'attribute' => 'color.label',
                    'contentOptions' => static function (\backend\models\apple\AppleModel $c) {
                        return $c->color ? ['style' => "background-color: {$c->color->value}"] : [];
                    }
                ],
                'size_value:text',
                'toState.label:text',
                'toEat.condition:text',
                [
                    'format' => 'raw',
                    'contentOptions' => ['style' => 'white-space: nowrap'],
                    'value' => static function ($model) {
                        return Yii::$app->view->render('_buttons', ['model' => $model]);
                    }
                ],
            ]
        ]) ?>
    </div>
</div>