<?php
namespace Components\DataProvider;
/**
 * DataProvider.php Class
 * @author	Maksym Laktionov
 */

abstract class DataProvider {
    abstract public function get($name);

    abstract public function set($name, $value);
}