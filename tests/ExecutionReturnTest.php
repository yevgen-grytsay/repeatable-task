<?php
use YevgenGrytsay\RepeatableTask\Execution;
use YevgenGrytsay\RepeatableTask\TaskInterface;

/**
 * Created by PhpStorm.
 * User: yevgen
 * Date: 26.08.15
 * Time: 11:12
 */
class ExecutionReturnTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider conditionAndLimitProvider
     *
     * @param $condition
     * @param $limit
     * @param $expectedReturn
     */
    public function testShouldRunOnceIfZeroLimit($condition, $limit, $expectedReturn)
    {
        $task = $this->getMockBuilder(TaskInterface::class)
                     ->getMock();
        $task->expects($this->once())
             ->method('execute');
        $exec = new Execution($task, $condition, $limit);

        $return = $exec->start();

        $this->assertEquals($expectedReturn, $return);
    }

    public function conditionAndLimitProvider()
    {
        $trueCondition = new ConditionMetFake();
        $falseCondition = new ConditionNotMetFake();

        return [
            // lim, cond
            [$trueCondition, 1, [false, true]],
            [$falseCondition, 1, [false, false]],
            [$falseCondition, 2, [true, false]],
        ];
    }
}