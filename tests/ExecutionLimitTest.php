<?php
use YevgenGrytsay\RepeatableTask\Execution;
use YevgenGrytsay\RepeatableTask\TaskInterface;

/**
 * Created by PhpStorm.
 * User: yevgen
 * Date: 26.08.15
 * Time: 10:40
 */
class ExecutionLimitTest extends PHPUnit_Framework_TestCase
{
    public function testShouldRunOnceIfZeroLimit()
    {
        $task = $this->getMockBuilder(TaskInterface::class)
                     ->getMock();
        $task->expects($this->once())
             ->method('execute');

        $condition = new ConditionMetFake();
        $exec = new Execution($task, $condition, 0);

        $exec->start();
    }

    /**
     * @dataProvider limitProvider
     *
     * @param $limit
     */
    public function testShouldRepeatExactlyLimitTimes($limit)
    {
        $task = new TaskExecuteMock();
        $condition = new ConditionMetFake();
        $exec = new Execution($task, $condition, $limit);

        $exec->start();

        $this->assertEquals($limit, $task->getCount());
    }

    public function limitProvider()
    {
        return [
            [1],
            [2],
        ];
    }

    /**
     * @return TaskInterface
     */
    protected function _createDummyTask()
    {
        return $this->getMockBuilder(TaskInterface::class)->getMock();
    }
}