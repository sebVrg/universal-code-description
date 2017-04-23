<?php

namespace UniversalCodeDefinition\Test\Model;

use UniversalCodeDefinition\Model\RepositoryModelInterface;
use UniversalCodeDefinition\Model\RepositoryModel;
use ReflectionClass;

/**
 * @author seeren
 */
class RepositoryModelTest extends RepositoryModelInterfaceTest
{

    /**
     * Get repository model
     *
     * @return RepositoryModelInterface
     */
    protected function getRepositoryModel(): RepositoryModelInterface
    {
        return (new ReflectionClass(RepositoryModel::class))
       ->newInstanceArgs([]);
    }

}
