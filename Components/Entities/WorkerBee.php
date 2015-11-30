<?php
namespace Components\Entities;

/**
 * WorkerBee.php Class
 * @author	Maksym Laktionov
 */
class WorkerBee  extends Bee
{
    public function getDamage()
    {
        return 12;
    }

    public function getDefaultLife()
    {
        return 50;
    }
} 