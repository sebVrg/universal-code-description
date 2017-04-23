<?php

namespace UniversalCodeDefinition\Observer;

/**
 * @author seeren
 */
abstract class AbstractSubject
{

    protected
        /**
         * @var ObserverInterface[]
         */
        $observer;

    /**
     * Construct AbstractSubject
     */
    protected function __construct()
    {
        $this->observer = [];
    }

    /**
     * Register observer
     * 
     * @param ObserverInterface $observer
     * @return ObserverInterface
     */
    public function register(ObserverInterface $observer): ObserverInterface
    {
        return $this->observer[] = $observer;
    }

    /**
     * Unregister observer
     * 
     * @param ObserverInterface $observer
     * @return ObserverInterface
     */
    public function unregister(ObserverInterface $observer): ObserverInterface
    {
        if (is_int($key = array_search($observer, $this->observer))) {
            unset($this->observer[$key]);
        }
        return $observer;
    }

    /**
     * Notify observers
     * 
     * @return SubjectInterface
     */
    public function notify(): SubjectInterface
    {
        foreach ($this->observer as $observer) {
            $observer->update($this);
        }
        return $this;
    }

}
