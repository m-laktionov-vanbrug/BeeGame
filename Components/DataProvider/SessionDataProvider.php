<?php
/**
 * SessionDataProvider.php Class
 * @author	Maksym Laktionov
 */

namespace Components\DataProvider;


class SessionDataProvider extends DataProvider{

    public function __construct()
    {
        if (!$this->isSessionStarted()) {
            session_start();
        }
    }

    public function get($name)
    {
        return array_key_exists($name,$_SESSION) ? $_SESSION[$name] : null;
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    private function  isSessionStarted()
    {
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                $response = session_status() === PHP_SESSION_ACTIVE;
            } else {
                $response = session_id() === '';
            }
        } else
        {
            $response = true;
        }
        return $response;
    }
}