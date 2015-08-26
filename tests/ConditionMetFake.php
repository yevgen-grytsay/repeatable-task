<?php
use YevgenGrytsay\RepeatableTask\RepeatCondition;

/**
 * Created by PhpStorm.
 * User: yevgen
 * Date: 26.08.15
 * Time: 10:31
 */
class ConditionMetFake extends RepeatCondition
{
    /**
     * @param $repeatCount
     * @param $result
     *
     * @return mixed
     */
    public function isSatisfying($repeatCount, $result)
    {
        return true;
    }
}