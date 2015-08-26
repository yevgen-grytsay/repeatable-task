<?php
use YevgenGrytsay\RepeatableTask\Execution;
use YevgenGrytsay\RepeatableTask\RepeatCondition;
use YevgenGrytsay\RepeatableTask\TaskInterface;

/**
 * Created by PhpStorm.
 * User: yevgen
 * Date: 26.08.15
 * Time: 10:27
 */
class ExecutionConditionTest extends PHPUnit_Framework_TestCase
{
    public function testShouldStopIfConditionNotMet()
    {
        $task = $this->getMockBuilder(TaskInterface::class)
                     ->getMock();
        $task->expects($this->once())
             ->method('execute');
        $limit = 9999999;
        $condition = new ConditionNotMetFake();
        $exec = new Execution($task, $condition, $limit);

        $exec->start();
    }

    /**
     * @dataProvider limitProvider
     *
     * @param $limit
     */
    public function testShouldPassCountToIsSatisfyingMethod($limit)
    {
        $task = $this->_createDummyTask();
        $condition = $this->getMockBuilder(RepeatCondition::class)->getMock();

        $countSequence = range(1, $limit);
        $countSequence = array_map(function($item) {return [$item];}, $countSequence);
        $method = $condition->expects($this->exactly($limit))->method('isSatisfying');
        call_user_func_array([$method, 'withConsecutive'], $countSequence);
        $method->willReturn(true);

        $exec = new Execution($task, $condition, $limit);

        $exec->start();
    }

    public function limitProvider()
    {
        return [
            [1],
            [2]
        ];
    }

    public function testShouldPassTaskResultToIsSatisfyingMethod()
    {
        $result = new stdClass();
        $task = $this->_createTaskReturningResult($result);
        $condition = $this->getMockBuilder(RepeatCondition::class)->getMock();
        $condition->expects($this->once())
                  ->method('isSatisfying')
                  ->with(1, $result);
        $exec = new Execution($task, $condition, 1);

        $exec->start();
    }

    /**
     * @return TaskInterface
     */
    protected function _createDummyTask()
    {
        return $this->getMockBuilder(TaskInterface::class)->getMock();
    }

    /**
     * @param $result
     *
     * @return \YevgenGrytsay\RepeatableTask\TaskInterface
     */
    protected function _createTaskReturningResult($result)
    {
        $task = $this->getMockBuilder(TaskInterface::class)->getMock();
        $task->expects($this->any())
            ->method('execute')
            ->willReturn($result);

        return $task;
    }

}
