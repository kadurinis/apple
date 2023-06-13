<?php

namespace backend\models\apple;

use yii\base\BaseObject;

class AppleGenerator extends BaseObject
{
    const MIN_VALUE = 1;
    const MAX_VALUE = 100;

    private $_err;

    /**
     * @param int $count count of apples
     * @param string $color color name, or null for default color
     * @param int|null $fellAt timestamp if you want to generate apples, which are fell; null - mean "on a tree"
     * @param bool $append if false, all active apples will be deleted; if true, all active apples will be appended by new apples
     * @param bool $interruptOnError if true, first caught error will interrupt generating process
     * @return int count of successfully generated apples
     */
    public function generate($count = 10, $color = null, $fellAt = null, $append = false, $interruptOnError = true) {
        if (!$append) {
            Apple::updateAll(['active' => 0]);
        }
        $count = mt_rand(self::MIN_VALUE, max(self::MIN_VALUE, min($count, self::MAX_VALUE)));
        $created = 0;
        for ($i = 0; $i < $count; $i++) {
            $model = new AppleModel([
                'color_name' => $color,
                'fell_at' => $fellAt,
            ]);
            if ($model->save()) {
                $created++;
            } else {
                $this->_err = current($model->getFirstErrors());
                if ($interruptOnError) {
                    break;
                }
            }
        }
        return $created;
    }

    public function getErr() {
        return $this->_err;
    }
}