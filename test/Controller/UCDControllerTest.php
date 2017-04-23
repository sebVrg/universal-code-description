<?php

namespace UniversalCodeDefinition\Test\Controller;

use UniversalCodeDefinition\Controller\UCDController;
use UniversalCodeDefinition\Controller\ControllerInterface;
use UniversalCodeDefinition\Model\RepositoryModel;
use UniversalCodeDefinition\View\UCDView;
use ReflectionClass;

/**
 * @author seeren
 */
class UCDControllerTest extends ControllerInterfaceTest
{

    /**
     * Get controller
     *
     * @return ControllerInterface
     */
    protected function getController(): ControllerInterface
    {
        return (new ReflectionClass(UCDController::class))
       ->newInstanceArgs([
           (new \ReflectionClass(RepositoryModel::class))->newInstanceArgs([]),
           (new \ReflectionClass(UCDView::class))->newInstanceArgs([])
       ]);
    }

}
