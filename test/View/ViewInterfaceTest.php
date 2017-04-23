<?php

namespace UniversalCodeDefinition\Test\View;

use UniversalCodeDefinition\View\ViewInterface;
use stdClass;

/**
 * @author seeren
 */
abstract class ViewInterfaceTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Get view
     *
     * @return ViewInterface
     */
    abstract protected function getView(): ViewInterface;

    /**
     * testInstanceOfControllerInterface
     */
    public function testInstanceOfViewInterface()
    {
        $this->assertTrue(
            $this->getView() instanceof ViewInterface
        );
    }

    /**
     * testRegression
     */
    public function testRegression()
    {
        $mock = $this->getView();
        $this->assertTrue(
            method_exists($mock, "render")
         && method_exists($mock, "update")
        );
    }
    

    /**
     * testRenderJson
     */
    public function testRenderJson()
    {
        $std = json_decode($this->getView()->render());
        $this->assertTrue($std && $std instanceof stdClass);
    }

}
