<?php
/**
 * Created by PhpStorm.
 * User: yevgen
 * Date: 26.08.15
 * Time: 9:57
 */

namespace YevgenGrytsay\RepeatableTask;


interface TaskInterface
{
    /**
     * @returns mixed
     */
    public function execute();
}