<?php

namespace backend\models\apple;

use Yii;

/**
 * This is the model class for table "colors".
 *
 * @property string $name code name of color
 * @property string|null $value style value
 * @property string|null $label Label to display
 *
 * @property Apple[] $apples
 */
class Color extends \yii\db\ActiveRecord
{
    /** @var Color[] $_colors models Color indexed by primary key */
    private static $_colors;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colors';
    }

    public static function getList() {
        return self::$_colors = self::$_colors === null ? self::find()->indexBy('name')->all() : self::$_colors;
    }

    /**
     * @return Color|null
     */
    public static function getRandom() {
        return self::getList()[array_rand(self::getList())];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'value', 'label'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'code name of color',
            'value' => 'style value',
            'label' => 'Color',
        ];
    }

    /**
     * Gets query for [[Apples]].
     *
     * @return \yii\db\ActiveQuery|AppleQuery
     */
    public function getApples()
    {
        return $this->hasMany(Apple::class, ['color_name' => 'name']);
    }

    /**
     * {@inheritdoc}
     * @return ColorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ColorQuery(get_called_class());
    }
}
