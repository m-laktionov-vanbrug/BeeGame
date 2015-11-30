<?php

/**
 * DroneBeeTest.php Class
 * @author	Maksym Laktionov
 */
require_once '../../autoload.php';

class DroneBeeTest extends PHPUnit_Framework_TestCase
{
    public function testShouldReturnDemageValue()
    {
        $dronBee = new \Components\Entities\DroneBee();
        $damage = $dronBee->getDamage();
        self::assertEquals(10, $damage);
    }

    public function testShouldReturnDefultLifeValue()
    {
        $dronBee = new \Components\Entities\DroneBee();
        $defaultLife = $dronBee->getDefaultLife();
        self::assertEquals(75, $defaultLife);
    }
}
 