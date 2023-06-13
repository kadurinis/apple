<?php

namespace backend\models\apple;

class AppleState extends AppleModel
{
    public function canFall() {
        if ($this->isFell()) {
            $this->addError('fell_at', 'Apple already fell');
            return false;
        }
        return true;
    }

    public function fall() {
        if ($this->canFall()) {
            $this->fell_at = time();
        }
        return $this;
    }

    public function getLabel() {
        return $this->isOnTree() ? 'On a tree' : 'Fell at ' . \Yii::$app->formatter->asDatetime($this->fell_at);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'label' => 'State',
        ]);
    }
}