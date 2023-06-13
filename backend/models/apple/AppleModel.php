<?php

namespace backend\models\apple;

use yii\base\ModelEvent;
use yii\data\ActiveDataProvider;

/**
 * @property AppleState $toState
 * @property AppleEat $toEat
 */
class AppleModel extends Apple
{
    public function search($params = []) {
        $this->load($params);
        return new ActiveDataProvider(['query' => $this->getQuery()]);
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['color_name', 'default', 'value' => Color::getRandom()->name],
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'toState.label' => 'State',
            'size_value' => 'Rest, %',
            'toEat.condition' => 'Condition',
        ]);
    }

    public function isFell() {
        return (bool)$this->fell_at;
    }

    public function apply() {
        $this->save();
        return $this;
    }

    public function getErr() {
        return current($this->getFirstErrors());
    }

    public function isOnTree() {
        return !$this->isFell();
    }

    protected function getQuery() {
        return self::find()->active()->alive()->joinWith('color');
    }

    public function getToEat() {
        $model = new AppleEat();
        self::populateRecord($model, $this->attributes);
        return $model;
    }

    public function getToState() {
        $model = new AppleState();
        self::populateRecord($model, $this->attributes);
        return $model;
    }
}