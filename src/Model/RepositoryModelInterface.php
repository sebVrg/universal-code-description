<?php

namespace UniversalCodeDefinition\Model;

use UniversalCodeDefinition\Observer\SubjectInterface;
use JsonSerializable;

/**
 * @author seeren
 */
interface RepositoryModelInterface extends SubjectInterface, JsonSerializable
{

    /**
     * Magical get
     * 
     * @param string $name
     * @param mixed $value
     * @return mixed
     */
    public function __get(string $name);

    /**
     * Get
     * 
     * @return RepositoryModelInterface
     * 
     * @throws RuntimeException for non available repository
     */
    public function get(): RepositoryModelInterface;

    /**
     * Set
     * 
     * @param string $vendor
     * @param string $repository
     */
    public function set(
        string $vendor,
        string $repository): RepositoryModelInterface;

}
