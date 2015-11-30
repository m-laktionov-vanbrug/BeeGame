<?php
namespace Components\Entities;

/**
 * QueenBee.php Class
 * @author	Maksym Laktionov
 */
class QueenBee extends Bee
{

    public function getDamage()
    {
        return 8;
    }

    public function getDefaultLife()
    {
        return 100;
    }
}