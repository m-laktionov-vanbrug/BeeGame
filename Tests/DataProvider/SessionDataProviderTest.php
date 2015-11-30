<?php
/**
 * SessionDataProviderTest.php Class
 * @author	Maksym Laktionov
 */

require_once '../../autoload.php';

class SessionDataProviderTest extends PHPUnit_Framework_TestCase
{
    public function testShouldSetValue()
    {
        $_SESSION = array();

        $dataProvider = new \Components\DataProvider\SessionDataProvider();
        $dataProvider->set('state', 'test');

        self::assertEquals('test', $_SESSION['state']);
    }

    public function testShouldGetValue()
    {
        $_SESSION = array();

        $dataProvider = new \Components\DataProvider\SessionDataProvider();
        $state = $dataProvider->get('state');

        self::assertEquals(null, $state);

        $dataProvider->set('state', 'test');
        $state = $dataProvider->get('state');
        self::assertEquals('test', $state);
    }

    public function testShouldReturnTrueForCLI()
    {
        $method = new ReflectionMethod('\Components\DataProvider\SessionDataProvider', 'isSessionStarted');
        $method->setAccessible(true);

        self::assertTrue($method->invoke(new \Components\DataProvider\SessionDataProvider()));
    }
}
 