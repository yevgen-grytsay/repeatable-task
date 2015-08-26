<?php
/**
 * Created by PhpStorm.
 * User: yevgen
 * Date: 26.08.15
 * Time: 9:56
 */

namespace YevgenGrytsay\RepeatableAction;


class Execution
{
    /**
     * @var int
     */
    protected $repeatLimit;

    /**
     * @var RepeatCondition
     */
    protected $repeatCondition;

    /**
     * @var TaskInterface
     */
    protected $task;

    /**
     * Execution constructor.
     *
     * @param \YevgenGrytsay\RepeatableAction\TaskInterface $task
     * @param \YevgenGrytsay\RepeatableAction\RepeatCondition $repeatCondition
     * @param int $repeatLimit
     */
    public function __construct(TaskInterface $task, RepeatCondition $repeatCondition, $repeatLimit)
    {
        $this->task = $task;
        $this->repeatCondition = $repeatCondition;
        $this->repeatLimit = $repeatLimit;
    }

    /**
     * @return array A two-element array. Both elements are of boolean type.
     *               First element is false if repeat count exceeds limit.
     *               Otherwise - true.
     *               Second element is false if repeat condition is not met.
     *               Otherwise - true;
     */
    public function start()
    {
        $count = 0;
        do {
            $result = $this->task->execute();
            ++$count;

            $isInsideLimit = $this->_isInsideLimit($count);
            $repeat = $this->repeatCondition->isSatisfying($count, $result);
        } while ($isInsideLimit && $repeat);

        return [$isInsideLimit, $repeat];
    }

    /**
     * @param $count
     *
     * @return bool
     */
    protected function _isInsideLimit($count)
    {
        return $count < $this->repeatLimit;
    }
}