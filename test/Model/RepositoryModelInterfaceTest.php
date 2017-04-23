<?php

namespace UniversalCodeDefinition\Test\Model;

use UniversalCodeDefinition\Model\RepositoryModelInterface;
use RuntimeException;

/**
 * @author seeren
 */
abstract class RepositoryModelInterfaceTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Get repository model
     *
     * @return RepositoryModelInterface
     */
    abstract protected function getRepositoryModel(): RepositoryModelInterface;

    /**
     * attributesProvider
     */
    public final function attributesProvider()
    {
        return [
            ["distribuable"],
            ["testable"],
            ["langage"],
            ["vendor"],
            ["repository"],
            ["package"],
            ["description"],
            ["keywords"],
            ["type"],
            ["homepage"],
            ["dependencies"],
            ["devDependencies"],
            ["version"],
            ["license"],
            ["author"],
        ];
    }

    /**
     * testInstanceOfRepositoryModelInterface
     */
    public function testInstanceOfRepositoryModelInterface()
    {
        $this->assertTrue(
            $this->getRepositoryModel()
            instanceof
            RepositoryModelInterface
       );
    }

    /**
     * testRegression
     */
    public function testRegression()
    {
        $mock = $this->getRepositoryModel();
        $this->assertTrue(
            method_exists($mock, "__get")
         && method_exists($mock, "get")
         && method_exists($mock, "set")
         && method_exists($mock, "jsonSerialize")
        );
    }

    /**
     * testRuntimeException
     *
     * @expectedException RuntimeException
     */
    public function testRuntimeException()
    {
        $mock = $this->getRepositoryModel();
        $mock->get();
    }

    /**
     * testSet
     */
    public function testSet()
    {
        $mock = $this->getRepositoryModel();
        $mock->set("foo", "bar");
        $this->assertTrue(
            "foo" === $mock->vendor
         && "bar" === $mock->repository
         && "foo/bar" === $mock->package
        );
    }

   /**
    * testHasAttributes
    * 
    * @param string $name
    * @dataProvider attributesProvider
    */
   public function testHasAttributes($name)
   {
       $mock = $this->getRepositoryModel();
       $this->assertTrue(property_exists($mock, $name));
   }

   /**
    * testJsonHasAttributes
    *
    * @param string $name
    * @dataProvider attributesProvider
    */
   public function testJsonHasAttributes($name)
   {
       $this->assertTrue(property_exists(
           $this->getRepositoryModel()->jsonSerialize(),
           $name)
       );
   }

}
