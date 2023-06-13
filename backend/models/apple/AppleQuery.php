<?php

namespace backend\models\apple;

/**
 * This is the ActiveQuery class for [[Apple]].
 *
 * @see Apple
 */
class AppleQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['active' => Apple::ACTIVE]);
    }

    public function alive() {
        return $this->andWhere(['>', 'size_value', 0]);
    }

    /**
     * {@inheritdoc}
     * @return Apple[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Apple|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
