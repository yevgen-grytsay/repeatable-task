<?php

/**
 * Created by PhpStorm.
 * User: yevgen
 * Date: 26.08.15
 * Time: 10:32
 */
class ConditionNotMetFake extends \YevgenGrytsay\RepeatableAction\RepeatCondition
{
    /**
     * @param $repeatCount
     * @param $result
     *
     * @return mixed
     */
    public function isSatisfying($repeatCount, $result)
    {
        return false;
    }
}