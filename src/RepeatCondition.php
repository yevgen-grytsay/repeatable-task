<?php
/**
 * Created by PhpStorm.
 * User: yevgen
 * Date: 26.08.15
 * Time: 9:57
 */

namespace YevgenGrytsay\RepeatableAction;


abstract class RepeatCondition
{
    /**
     * @param $repeatCount
     * @param $result
     *
     * @return bool
     */
    abstract public function isSatisfying($repeatCount, $result);
}