<?php

namespace backend\models\apple;

use Yii;

/**
 * This is the model class for table "eats".
 *
 * @property int $id
 * @property int|null $apple_id
 * @property float|null $eat_value size that was eaten per time in percent
 * @property int|null $created_at
 * @property int|null $created_by
 *
 * @property Apple $apple
 */
class Eat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apple_id', 'created_at', 'created_by'], 'integer'],
            [['eat_value'], 'number'],
            [['apple_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apple::class, 'targetAttribute' => ['apple_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'apple_id' => 'Apple ID',
            'eat_value' => 'size that was eaten per time in percent',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Apple]].
     *
     * @return \yii\db\ActiveQuery|AppleQuery
     */
    public function getApple()
    {
        return $this->hasOne(Apple::class, ['id' => 'apple_id']);
    }

    /**
     * {@inheritdoc}
     * @return EatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EatQuery(get_called_class());
    }
}
