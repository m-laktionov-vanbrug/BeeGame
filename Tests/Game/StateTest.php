<?php
/**
 * StateTest.php Class
 * @author	Maksym Laktionov
 */
require_once '../../autoload.php';

class StateTest extends PHPUnit_Framework_TestCase
{
    private static $config = array(
        array('class' => 'Components\Entities\QueenBee', 'count' => 1, 'dependency' => null),
        array('class' => 'Components\Entities\DroneBee', 'count' => 5, 'dependency' => 'QueenBee'),
        array('class' => 'Components\Entities\WorkerBee', 'count' => 8, 'dependency' => 'QueenBee')
    );

    public function testShouldMakeInstanceOfStateClassAndInitData()
    {
        $_SESSION = array();

        $state = new \Components\Game\State(self::$config, new \Components\DataProvider\SessionDataProvider());

        self::assertTrue($state instanceof Components\Game\State);

        $dataFromState = $state->getState();
        self::assertTrue(is_array($dataFromState));
        self::assertEquals(14, count($dataFromState));
    }

    public function testShouldMakeInstanceOfStateClassAndRestoreData()
    {
        $_SESSION['state'] = 'test';

        $state = new \Components\Game\State(self::$config, new \Components\DataProvider\SessionDataProvider());

        self::assertTrue($state instanceof Components\Game\State);

        $dataFromState = $state->getState();
        self::assertEquals('test', $dataFromState);
    }

    public function testShouldGetState()
    {
        $_SESSION = array();

        $state = new \Components\Game\State(self::$config, new \Components\DataProvider\SessionDataProvider());

        $dataFromState = $state->getState();

        self::assertTrue(is_array($dataFromState));

        self::assertEquals(14, count($dataFromState));
    }

    public function testShouldSaveState()
    {
        $_SESSION = array();

        $state = new \Components\Game\State(self::$config, new \Components\DataProvider\SessionDataProvider());

        $dataFromState = $state->getState();

        self::assertEquals($dataFromState[0]->getDefaultLife(), $dataFromState[0]->getLife());
        $dataFromState[0]->hit();

        $state->saveState();

        $dataFromState = $state->getState();
        self::assertEquals(
            $dataFromState[0]->getDefaultLife()-$dataFromState[0]->getDamage(),
            $dataFromState[0]->getLife()
        );
    }

    public function testShouldChangeState()
    {
        $_SESSION = array();

        $state = new \Components\Game\State(self::$config, new \Components\DataProvider\SessionDataProvider());

        $before = $state->getState();
        $lifeValuesBefore = array();
        foreach ($before as $bee)
        {
            $lifeValuesBefore[] = $bee->getLife();
        }
        $changedIndex = $state->changeState();
        $after = $state->getState();
        $lifeValuesAfter = array();
        foreach ($after as $bee)
        {
            $lifeValuesAfter[] = $bee->getLife();
        }

        self::assertNotEquals($lifeValuesBefore[$changedIndex], $lifeValuesAfter[$changedIndex]);
    }

    public function testShouldChangeStateAndRemoveDeadItems()
    {
        $_SESSION = array();

        $state = new \Components\Game\State(self::$config, new \Components\DataProvider\SessionDataProvider());

        $before = $state->getState();
        while ($before[1]->getLife())
        {
            $before[1]->hit();
        }

        $state->changeState();
        $after = $state->getState();

        $countBefore = count($before);
        $countAfter = count($after);

        self::assertEquals($countBefore,$countAfter+1);
    }


}
