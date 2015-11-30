<?php
namespace Controllers;
/**
 * IndexController.php Class
 * @author	Maksym Laktionov
 */
use Components\DataProvider\SessionDataProvider;
use Components\Game;
use Views\View;

class Controller {

    /**
     * @var Game\State
     */
    private $state;

    /**
     * An event that performs before main action
     */
    public function beforeAction()
    {
        $config = array(
                array('class' => 'Components\Entities\QueenBee', 'count' => 1, 'dependency' => null),
                array('class' => 'Components\Entities\DroneBee', 'count' => 5, 'dependency' => 'Components\Entities\QueenBee'),
                array('class' => 'Components\Entities\WorkerBee', 'count' => 8, 'dependency' => 'Components\Entities\QueenBee')
            );

        $this->state = new Game\State($config, new SessionDataProvider());
    }

    /**
     * Main action,
     * controller could have several actions
     */
    public function indexAction()
    {
        if (isset($_POST['hit']))
        {
            $this->state->changeState();
        }

        $state = $this->state->getState();
        $data = array();
        foreach ($state as $bee)
        {
            $className = get_class($bee);
            $data[$className][] = $bee->getLife();
        }

        $view = new View();
        $view->render('/controller/game', array(
            'data' => $data
        ));
    }

    /**
     * An event that performs after main action
     */
    public function afterAction()
    {
        $this->state->saveState();
    }

    public function run()
    {
        //action from url
        $action = (isset($url['action']) ? $url['action'] : 'index') . 'Action';
        if (method_exists($this, $action)) {
            $this->beforeAction();
            $this->$action();
            $this->afterAction();
        }
    }
} 