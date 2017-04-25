<?php

namespace UniversalCodeDefinition\Model;

use UniversalCodeDefinition\Observer\AbstractSubject;
use RuntimeException;
use stdClass;

/**
 * @author seeren
 */
class RepositoryModel extends AbstractSubject implements
    RepositoryModelInterface
{

    private
        /**
         * @var bool
         */
        $distribuable,
        /**
         * @var bool
         */
        $testable,
        /**
         * @var string
         */
        $language,
        /**
         * @var string
         */
        $vendor,
        /**
         * @var string
         */
        $repository,
        /**
         * @var string
         */
        $package,
        /**
         * @var string
         */
        $description,
        /**
         * @var array
         */
        $keywords,
        /**
         * @var string
         */
        $type,
        /**
         * @var string
         */
        $homepage,
        /**
         * @var array
         */
        $dependencies,
        /**
         * @var array
         */
        $devDependencies,
        /**
         * @var array
         */
        $version,
        /**
         * @var string
         */
        $license,
        /**
         * @var string
         */
        $author;

    /**
     * Construct RepositoryModel
     */
    public function __construct()
    {
        parent::__construct();
        $this->distribuable    = false;
        $this->testable        = false;
        $this->language         = "";
        $this->vendor          = "";
        $this->repository      = "";
        $this->package         = "";
        $this->description     = "";
        $this->keywords        = [];
        $this->type            = "";
        $this->homepage        = "";
        $this->dependencies    = [];
        $this->devDependencies = [];
        $this->version         = [];
        $this->license         = "";
        $this->author          = "";
    }

    /**
     * Consume
     * 
     * @param string $url
     * @param string $subdir
     * @param boolean $ping
     * @return mixed
     */
    private function consume (string $url, string $subdir, bool $ping = false)
    {
        $filename = __DIR__ . "/cache/" . $subdir . "/" . md5($url);
        if (is_file($filename) && filemtime($filename) + 86400 > time()) {
            return file_get_contents($filename);
        }
        $code = 200;
        @$output = file_get_contents($url);
        if (isset($http_response_header)
         && array_key_exists(0, $http_response_header)) {
            $explode = explode(" ", $http_response_header[0]);
            $code = (int) $explode[1];
        }
        if (200 === $code) {
            file_put_contents($filename, $ping ? $url : $output);
        }
        return $output;
    }

    /**
     * Consume npm
     */
    private function consumeNpm ()
    {
        $this->distribuable = (bool) $this->consume(
            "https://www.npmjs.com/package/" . $this->repository,
            "npm",
            true);
    }

    /**
     * Consume packagist
     */
    private function consumePackagist ()
    {
        if (($packagist = json_decode($this->consume(
                 "https://packagist.org/packages/" . $this->package
               . ".json",
                 "packagist")))) {
            $this->distribuable = true;
            if (isset($packagist->package)
             && isset($packagist->package->versions)) {
                foreach (array_keys($packagist->package->versions) as $key) {
                    if ("dev-master" !== $key) {
                        $this->version[] = $key;
                    }
                }
            }
        }
    }

    /**
     * Consume package
     * 
     * @return boolean
     */
    private function consumePackage (): bool
    {
        if (($package = json_decode($this->consume(
                 "https://raw.githubusercontent.com/" . $this->package
               . "/master/package.json",
                 "package")))) {
            $this->language = "js";
            $this->setAvailable($package);
            if (isset($package->dependencies)
             && is_object($package->dependencies)) {
                 foreach ($package->dependencies as $key => $value) {
                    $this->dependencies[] = $key;
                 }
            }
            if (isset($package->devDependencies)
             && is_object($package->devDependencies)) {
                 foreach ($package->devDependencies as $key => $value) {
                    $this->devDependencies[] = $key;
                 }
            }
            if (isset($package->author) && is_string($package->author)) {
                $this->author = $package->author;
            }
            $this->consumeNpm();
            $this->consumeTravis();
            return true;
        }
        return false;
    }

    /**
     * Consume composer
     * 
     * @return boolean
     */
    private function consumeComposer(): bool
    {
        if (($composer = json_decode($this->consume(
                 "https://raw.githubusercontent.com/"
               . $this->package
               . "/master/composer.json",
                 "composer")))) {
            $this->language = "php";
            $this->setAvailable($composer);
            if (isset($composer->require) && is_object($composer->require)) {
                 foreach ($composer->require as $key => $value) {
                    $this->dependencies[] = $key;
                 }
            }
            if (isset($composer->{"require-dev"})
             && is_object($composer->{"require-dev"})) {
                 foreach ($composer->{"require-dev"} as $key => $value) {
                    $this->devDependencies[] = $key;
                 }
            }
            if (isset($composer->authors)
             && is_array($composer->authors)
             && array_key_exists(0, $composer->authors)
             && isset($composer->authors[0]->name)) {
                $this->author = $composer->authors[0]->name;
            }
            $this->consumePackagist();
            $this->consumeTravis();
            return true;
        }
        return false ;
    }

    /**
     * Consume travis
     */
    private function consumeTravis ()
    {
        $this->testable = (bool) $this->consume(
            "https://raw.githubusercontent.com/" . $this->package
          . "/master/.travis.yml",
            "travis",
            true);
    }

    /**
     * Set available
     * 
     * @param stdClass $available package or composer
     */
    private function setAvailable(stdClass $available)
    {
        if (isset($available->version) && is_string($available->version)) {
            $this->version[0] = $available->version;
        }
        if (isset($available->license) && is_string($available->license)) {
            $this->license = $available->license;
        }
        if (isset($available->description)
         && is_string($available->description)) {
            $this->description = $available->description;
        }
        if (isset($available->keywords) && is_array($available->keywords)) {
            $this->keywords = $available->keywords;
        }
        if (isset($available->type) && is_string($available->type)) {
            $this->type = $available->type;
        }
        if (isset($available->homepage) && is_string($available->homepage)) {
            $this->homepage = $available->homepage;
        }
    }

    /**
     * {@inheritDoc}
     * @see RepositoryModelInterface::__get()
     */
    public function __get(string $name)
    {
        return property_exists($this, $name) ? $this->{$name} : null;
    }

    /**
     * {@inheritDoc}
     * @see RepositoryModelInterface::get()
     */
    public function get(): RepositoryModelInterface
    {
        if (!$this->consumePackage()
         && ! $this->consumeComposer()) {
            throw new RuntimeException("Expect an existing package");
        }
        return $this;
    }

    /**
     * {@inheritDoc}
     * @see RepositoryModelInterface::get()
     */
    public function set(
        string $vendor,
        string $repository): RepositoryModelInterface
    {
        $this->vendor     = $vendor;
        $this->repository = $repository;
        $this->package    = $vendor . "/" . $repository;
        return $this;
    }
    
    /**
     * {@inheritDoc}
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize(): stdClass
    {
        $obj = new stdClass();
        foreach ($this as $key => $value) {
            if ("observer" !== $key) {
                $obj->{$key} = $value;
            }
        }
        return $obj;
    }

}
