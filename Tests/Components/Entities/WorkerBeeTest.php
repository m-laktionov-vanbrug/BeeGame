<?php
/**
 * WorkerBee.php Class
 * @author	Maksym Laktionov
 */
require_once '../../autoload.php';

class WorkerBeeTest extends PHPUnit_Framework_TestCase
{
    public function testShouldReturnDemageValue()
    {
        $workerBee = new \Components\Entities\WorkerBee();
        $damage = $workerBee->getDamage();
        self::assertEquals(12, $damage);
    }

    public function testShouldReturnDefultLifeValue()
    {
        $workerBee = new \Components\Entities\WorkerBee();
        $defaultLife = $workerBee->getDefaultLife();
        self::assertEquals(50, $defaultLife);
    }
} 