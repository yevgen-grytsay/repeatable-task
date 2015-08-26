<?php
use YevgenGrytsay\RepeatableAction\TaskInterface;

/**
 * Created by PhpStorm.
 * User: yevgen
 * Date: 26.08.15
 * Time: 10:42
 */
class TaskExecuteMock implements TaskInterface
{
    protected $count = 0;

    /**
     * @returns mixed
     */
    public function execute()
    {
        ++$this->count;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}