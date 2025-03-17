<?php
class ConfigManager
{
    private static $instance;
    private $config;

    private function __construct()
    {
        $this->config = include 'config.php';
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ConfigManager();
        }
        return self::$instance;
    }

    public function getConfigValue($key)
    {
        return $this->config[$key]?? null;
    }
}