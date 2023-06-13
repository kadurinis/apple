<?php

namespace backend\models\apple;

use Yii;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property int|null $active active after generate
 * @property string|null $color_name
 * @property float|null $size_value Apple size in percent
 * @property int|null $created_at unix timestamp of creating apple
 * @property int|null $created_by unix timestamp when apple created
 * @property int|null $fell_at timestamp when apple fell from tree
 *
 * @property Color $color
 * @property Eat[] $eats
 */
class Apple extends \yii\db\ActiveRecord
{
    const ACTIVE = 1;
    const DEAD = 0;

    const FULL_SIZE = 100;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'created_at', 'created_by', 'fell_at'], 'integer'],
            [['size_value'], 'number'],
            [['color_name'], 'string', 'max' => 64],
            [['color_name'], 'exist', 'skipOnError' => true, 'targetClass' => Color::class, 'targetAttribute' => ['color_name' => 'name']],
            [['active'], 'default', 'value' => self::ACTIVE],
            [['size_value'], 'default', 'value' => static::FULL_SIZE],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'active' => 'active after generate',
            'color_name' => 'Color Name',
            'size_value' => 'Apple size in percent',
            'created_at' => 'unix timestamp of creating apple',
            'created_by' => 'unix timestamp when apple created',
            'fell_at' => 'timestamp when apple fell from tree',
        ];
    }

    /**
     * Gets query for [[ColorName]].
     *
     * @return \yii\db\ActiveQuery|ColorQuery
     */
    public function getColor()
    {
        return $this->hasOne(Color::class, ['name' => 'color_name']);
    }

    /**
     * Gets query for [[Eats]].
     *
     * @return \yii\db\ActiveQuery|EatQuery
     */
    public function getEats()
    {
        return $this->hasMany(Eat::class, ['apple_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AppleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppleQuery(static::class);
    }
}
