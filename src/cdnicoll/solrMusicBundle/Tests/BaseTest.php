<?php

namespace cdnicoll\solrMusicBundle\Tests;


use Monolog\Logger;
use Psr\Log\NullLogger;

abstract class BaseTest extends \PHPUnit_Framework_TestCase
{

    protected static function getReflectedObjectMethod($object, $name)
    {
        $class = new \ReflectionClass($object);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method;
    }

    protected static function getProtectedObjectPropertyValue($object, $property)
    {
        $class = new \ReflectionClass($object);
        $method = $class->getProperty($property);
        $method->setAccessible(true);

        return $method->getValue($object);
    }

    protected function invokeProtected($object, $method, $args = [])
    {
        $protectedMethod = $this->getReflectedObjectMethod($object, $method);

        return $protectedMethod->invokeArgs($object, $args);
    }

    protected function setReturnValue($item, $method, $returns)
    {
        $item->expects($this->any())
            ->method($method)
            ->will($this->returnValue($returns));
    }

    protected function setReturnCallback($item, $method, $callback)
    {
        $item->expects($this->any())
            ->method($method)
            ->will($this->returnCallback($callback));
    }

    protected function getConstructorDisabledMock($class)
    {
        return $this->getMockBuilder($class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function getLogger($stdout = false)
    {
        if ($stdout) {
            $logger = new Logger(''); //using this will log to stdout instead of silently ignoring logged statements
        } else {
            $logger = new NullLogger();
        }

        return $logger;
    }
}
