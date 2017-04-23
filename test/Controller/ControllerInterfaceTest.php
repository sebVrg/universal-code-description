<?php

namespace UniversalCodeDefinition\Test\Controller;

use UniversalCodeDefinition\Controller\ControllerInterface;
use stdClass;

/**
 * @author seeren
 */
abstract class ControllerInterfaceTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Get controller
     * 
     * @return ControllerInterface
     */
    abstract protected function getController(): ControllerInterface;

    /**
     * testInstanceOfControllerInterface
     */
    public function testInstanceOfControllerInterface()
    {
        $this->assertTrue(
            $this->getController() instanceof ControllerInterface
        );
    }

    /**
     * testRegressionExecute
     */
    public function testRegressionExecute()
    {
        $this->assertTrue(method_exists($this->getController(), "execute"));
    }

    /**
     * testExecuteReturnJson
     * 
     * @runInSeparateProcess
     */
    public function testExecuteReturnJson()
    {
        $std = json_decode($this->getController()->execute());
        $this->assertTrue($std && $std instanceof stdClass);
    }

}
