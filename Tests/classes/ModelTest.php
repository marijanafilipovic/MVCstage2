<?php
/**
 * Created by PhpStorm.
 * User: Marijana
 * Date: 15.3.2017.
 * Time: 12.05
 */

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

        // Configure the stub.
        $stub->method('getInstance')
            ->will($this->returnSelf());

        // Calling $stub->doSomething() will now return
        // 'foo'.
        $this->assertSame($stub, $stub->getInstance());
    }

    public function testCheckName(){

    }
}