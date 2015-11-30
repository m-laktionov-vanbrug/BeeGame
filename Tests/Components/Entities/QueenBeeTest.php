<?php
/**
 * QueenBeeTest.php Class
 * @author	Maksym Laktionov
 */
require_once '../../autoload.php';

class QueenBeeTest extends PHPUnit_Framework_TestCase 
{
    public function testShouldReturnDemageValue()
    {
        $queenBee = new \Components\Entities\QueenBee();
        $damage = $queenBee->getDamage();
        self::assertEquals(8, $damage);
    }

    public function testShouldReturnDefultLifeValue()
    {
        $queenBee = new \Components\Entities\QueenBee();
        $defaultLife = $queenBee->getDefaultLife();
        self::assertEquals(100, $defaultLife);
    }
}
 