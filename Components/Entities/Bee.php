<?php
namespace Components\Entities;
use SplObserver;
use SplSubject;

/**
 * Bee.php Class
 * @author	Maksym Laktionov
 */
abstract class Bee implements \SplSubject, \SplObserver
{
    /**
     * @var \SplObjectStorage
     */
    protected $observers;

    /**
     * @var int
     */
    protected $life;

    public function __construct($life=null)
    {
        $this->observers =  new \SplObjectStorage();
        if($life > 0){
            $this->life = $life;
        } else {
            $this->life = $this->getDefaultLife();
        }
    }

    /**
     * Damage definition for concrete class
     * @return int
     */
    abstract public function getDamage();

    /**
     * Default life definition for subclasses
     * @return int
     */
    abstract public function getDefaultLife();

    /**
     * Get current life value
     * @return int
     */
    public function getLife()
    {
        return $this->life;
    }

    /**
     * Method sets life of current bee to zero,
     * and notifies observers about death event
     */
    public function becomeDead()
    {
        //ensure that bee will be dead in case when this method calls as dependency (when queen dies)
        $this->life = 0;
        //notify units dependent on current bee
        $this->notify();
    }

    /**
     * Performing hit and checking for death
     */
    public function hit()
    {
        $this->life -= $this->getDamage();

        if ($this->life <= 0) {
            $this->becomeDead();
        }
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Attach an SplObserver
     * @link http://php.net/manual/en/splsubject.attach.php
     * @param SplObserver $observer <p>
     * The <b>SplObserver</b> to attach.
     * </p>
     * @return void
     */
    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Detach an observer
     * @link http://php.net/manual/en/splsubject.detach.php
     * @param SplObserver $observer <p>
     * The <b>SplObserver</b> to detach.
     * </p>
     * @return void
     */
    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Notify an observer
     * @link http://php.net/manual/en/splsubject.notify.php
     * @return void
     */
    public function notify()
    {
        if(count($this->observers)!== 0)
        {
            foreach ($this->observers as $observer)
            {
                $observer->update($this);
            }
        }
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Receive update from subject
     * @link http://php.net/manual/en/splobserver.update.php
     * @param SplSubject $subject <p>
     * The <b>SplSubject</b> notifying the observer of an update.
     * </p>
     * @return void
     */
    public function update(SplSubject $subject)
    {
        $this->becomeDead();
    }
}