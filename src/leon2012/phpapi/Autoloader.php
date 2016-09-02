<?php
/**
 * 
 * @authors Leon Peng (xingskycn@163.com)
 * @date    2016-09-01 14:40:16
 * @version $Id$
 */
namespace leon2012\phpapi;

class Autoloader 
{
    private $_basePath;

    public function __construct()
    {
        spl_autoload_register(array($this, 'load'));
    }

    public function setBasePath($basePath)
    {
        $this->_basePath = $basePath;
    }

    private function load($className)
    {
        if (class_exists($className, FALSE) || interface_exists($className, FALSE)) {
            return;
        }
        $this->loadClass($this->_basePath, $className);
    }

    public function loadClass($path, $className)
    {
        $classFile = $path.strtr($className, '\\', DIRECTORY_SEPARATOR).'.php';
        if (file_exists($classFile)) {
            require_once $classFile;
            return true;
        }
        return false;
    }
}