<?php


namespace Tests;
require dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR .'autoload.php';

use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{

    public function testIsConnectPassed()
    {
        $stub = $this->getMockBuilder('Connect')
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        $stub->method('getInstance')
            ->will($this->returnSelf());

        $this->assertSame($stub, $stub->getInstance());
    }

    public function testCheckName(){

    }
}
