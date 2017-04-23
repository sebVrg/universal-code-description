<?php

namespace UniversalCodeDefinition\Test\View;

use UniversalCodeDefinition\View\UCDView;
use ReflectionClass;
use UniversalCodeDefinition\View\ViewInterface;

/**
 * @author seeren
 */
class UCDViewTest extends ViewInterfaceTest
{

    /**
     * Get view
     *
     * @return ViewInterface
     */
    protected function getView(): ViewInterface
    {
        return (new ReflectionClass(UCDView::class))
       ->newInstanceArgs([]);
    }

}
