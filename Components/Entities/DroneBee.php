<?php
namespace Components\Entities;
/**
 * DroneBe.php Class
 * @author	Maksym Laktionov
 */

class DroneBee extends Bee
{
    public function getDamage()
    {
        return 10;
    }

    public function getDefaultLife()
    {
        return 75;
    }
}