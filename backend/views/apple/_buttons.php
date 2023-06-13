<?php
/**
 * @var \backend\models\apple\AppleModel $model
 */

use kartik\form\ActiveForm;
use yii\helpers\Html;

$eat = $model->toEat;
?>
<div>
    <?php $form = ActiveForm::begin(['action' => \yii\helpers\Url::to(['apple/eat', 'id' => $model->id]), 'method' => 'post', 'type' => ActiveForm::TYPE_INLINE,
        'tooltipStyleFeedback' => true, // shows tooltip styled validation error feedback
        'fieldConfig' => ['options' => ['class' => 'form-group mr-2 me-2']], // spacing field groups
        'formConfig' => ['showErrors' => true],
        'options' => ['style' => 'align-items: flex-start']])
    ?>
    <?= $form->field($eat, 'eat_value')->textInput(['style' => 'width: 5em']) ?>
    <?= Html::submitButton('Eat', ['class' => 'btn btn-primary']) ?>
    &nbsp;
    <?= Html::a('Fall', ['apple/fall', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    <?php ActiveForm::end() ?>

</div>
