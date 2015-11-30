<?php
/**
 * BeeTest.php Class
 * @author	Maksym Laktionov
 */
require_once '../../autoload.php';

class BeeTest extends PHPUnit_Framework_TestCase {

    public function testShouldGetLife()
    {
        $droneBee = new \Components\Entities\DroneBee();
        self::assertEquals($droneBee->getDefaultLife(), $droneBee->getLife());
    }

    public function testShouldMakeHit()
    {
        $droneBee = new \Components\Entities\DroneBee();
        $droneBee->hit();
        self::assertEquals(
            $droneBee->getDefaultLife()-$droneBee->getDamage(),
            $droneBee->getLife()
        );
    }

    public function testsShouldHitTheBeeUntilItBecomeDeadWithoutNotifying()
    {
        $droneBee = new \Components\Entities\DroneBee();
        while ($droneBee->getLife())
        {
            $droneBee->hit();
        }
        self::assertTrue($droneBee->getLife() === 0);
    }

    public function testShouldAttachObserver()
    {
        $droneBee = new \Components\Entities\DroneBee();
        $droneBee->attach(new \Components\Entities\WorkerBee());

        $r = new ReflectionObject($droneBee);
        $p = $r->getProperty('observers');
        $p->setAccessible(true);

        self::assertEquals(1,count($p->getValue($droneBee)));

    }

    public function testShouldDetachObserver()
    {
        $droneBee = new \Components\Entities\DroneBee();
        $workerBee = new \Components\Entities\WorkerBee();
        $droneBee->attach($workerBee);

        $r = new ReflectionObject($droneBee);
        $p = $r->getProperty('observers');
        $p->setAccessible(true);

        self::assertEquals(1, count($p->getValue($droneBee)));

        $droneBee->detach($workerBee);
        self::assertEquals(0, count($p->getValue($droneBee)));
    }


    public function testShouldUpdateSubscribersMakeThemDead()
    {
        $droneBee = new \Components\Entities\DroneBee();
        $workerBee1 = new \Components\Entities\WorkerBee();
        $workerBee2 = new \Components\Entities\WorkerBee();
        $droneBee->attach($workerBee1);
        $droneBee->attach($workerBee2);

        while ($droneBee->getLife())
        {
            $droneBee->hit();
        }

        self::assertTrue($droneBee->getLife() === 0);
        self::assertTrue($workerBee1->getLife() === 0);
        self::assertTrue($workerBee2->getLife() === 0);
    }

}
 