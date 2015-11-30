<?php
namespace Components\Game;
use Components\DataProvider\DataProvider;
use Components\Entities;

/**
 * State.php Class
 * @author	Maksym Laktionov
 */

class State
{
    /**
     * @var Bee[]
     */
    private $state;

    private $provider;

    public function __construct(array $config, DataProvider $provider)
    {
        $this->provider = $provider;

        if (!$this->restoreState()){
            $this->initState($config);
        }
    }

    /**
     * Get state from data provider
     * @return Bee[]
     */
    public function getState()
    {
       return $this->state;
    }

    /**
     * Saves state to data provider
     */
    public function saveState()
    {
        $this->provider->set('state', $this->state);
    }

    /**
     * New game initialization based on array config
     * @param array $config
     */
    public function initState(array $config)
    {
        foreach ($config as $rule) {
            for ($i = 0; $i < $rule['count']; $i++) {
                $instance = new $rule['class'];
                if (!empty($rule['dependency'])) {
                    foreach ($this->state as $object) {
                        if (is_a($object, $rule['dependency'])) {
                            $object->attach($instance);
                        }
                    }
                }
                $this->state[] = $instance;
            }
        }
    }

    /**
     * Tries to restore state from data provider
     * @return bool
     */
    public function restoreState()
    {
        $result = false;
        if ($state = $this->provider->get('state')) {
            $this->state = $state;
            $result = true;
        }
        return $result;
    }

    /**
     * Performs hit action for random bee
     * @return int
     */
    public function changeState()
    {
        $index = array_rand($this->state);
        $beeObj = $this->state[$index];
        $beeObj->hit();
        foreach ($this->state as $key => $obj)
        {
            if ($obj->getLife() === 0)
            {
                unset($this->state[$key]);
            }
        }
        return $index;
    }
} 