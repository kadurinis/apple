<?php

namespace backend\models\apple;

class AppleEat extends AppleModel
{
    public $eat_value;

    /**
     * Bad timeout is 5 hours
     * @return float|int
     */
    public function getBadTime() {
        return 60 * 60 * 5;
    }

    public function isBad() {
        return $this->isFell() && ($this->fell_at < time() - $this->getBadTime());
    }

    public function isAte() {
        return $this->size_value <= 0;
    }

    public function canEat() {
        if (!$this->validate()) {
            return false;
        }
        if ($this->isOnTree()) {
            $this->addError('fell_at', 'You can not to eat apple that is on a tree');
            return false;
        }
        if ($this->isBad()) {
            $this->addError('fell_at', 'The apple is bad');
            return false;
        }
        if ($this->isAte()) {
            $this->addError('size_value', 'The apple is already eaten');
            return false;
        }
        return true;
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['eat_value', 'integer', 'min' => 1, 'max' => 100],
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'eat_value' => '100',
        ]);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!$this->size_value) {
            \Yii::$app->session->setFlash('success', "You ate apple #{$this->id}");
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function eat() {
        if ($this->canEat()) {
            $size = $this->size_value;
            $value = $this->eat_value ?: 100;
            $value = min($value, $size);
            $this->size_value -= $value;
        }
        return $this;
    }

    public function getCondition() {
        return $this->isBad() ? 'Bad' : 'Good';
    }
}