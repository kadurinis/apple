<?php

namespace backend\models\apple;

/**
 * This is the ActiveQuery class for [[Eat]].
 *
 * @see Eat
 */
class EatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Eat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Eat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
