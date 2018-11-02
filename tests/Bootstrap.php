<?php

// Errors on full!
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

$dir = realpath(dirname(__FILE__));

if (file_exists('./vendor/')) {
    $vendor_path = realpath('./vendor/') . '/';
} else {
    $vendor_path = realpath($dir . '/../../../') . '/';
}

// Path constants
defined('PROJECT_BASE') OR define('PROJECT_BASE', realpath($dir . '/../') . '/');
defined('VENDOR_PATH') OR define('VENDOR_PATH', $vendor_path);
defined('SYSTEM_PATH') OR define('SYSTEM_PATH', PROJECT_BASE . 'codeigniter/');
defined('APPPATH') OR define('APPPATH', PROJECT_BASE . 'pepiscms/application/');
defined('BASEPATH') OR define('BASEPATH', PROJECT_BASE . 'pepiscms/');
defined('INSTALLATIONPATH') OR define('INSTALLATIONPATH', $dir);
defined('ENVIRONMENT') OR define('ENVIRONMENT', 'development');

class CI_Controller
{
    private $services = array();
    private static $instance;

    public static function get_instance()
    {
        self::$instance != null OR self::$instance = new CI_Controller();
        return self::$instance;
    }

    public static function removeAllTestServices()
    {
        self::get_instance()->services = array();
    }

    public static function registerTestService($name, $service)
    {
        self::get_instance()->services[$name] = $service;
    }

    public function __get($name)
    {
        if (!isset($this->services[$name])) {
            throw new LogicException("Service '$name' was not registered in the test context.");
        }
        return $this->services[$name];
    }
}

class FakeLoader
{
    public function helper($name)
    {

    }

    public function config($name)
    {

    }
}

class FakeConfig
{
    public function load($name)
    {

    }
}

class FakeBenchmark
{
    public function mark($name)
    {

    }
}


class PepisCMS_TestCase extends PHPUnit_Framework_TestCase
{

    /**
     * @inheritdoc
     */
    public static function setUpBeforeClass()
    {
        CI_Controller::registerTestService('load', new FakeLoader());
        CI_Controller::registerTestService('config', new FakeConfig());
        CI_Controller::registerTestService('benchmark', new FakeBenchmark());
    }

    /**
     * @inheritdoc
     */
    public static function tearDownAfterClass()
    {
        CI_Controller::removeAllTestServices();
    }
}

require_once(VENDOR_PATH . 'autoload.php');
