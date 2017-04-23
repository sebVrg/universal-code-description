<?php

namespace UniversalCodeDefinition\Observer;

/**
 * @author seeren
 */
interface SubjectInterface
{

    /**
     * Register observer
     * 
     * @param ObserverInterface $observer
     * @return ObserverInterface
     */
    public function register(ObserverInterface $observer): ObserverInterface;

    /**
     * Unregister observer
     * 
     * @param ObserverInterface $observer
     * @return ObserverInterface
     */
    public function unregister(ObserverInterface $observer): ObserverInterface;

    /**
     * Notify observers
     * 
     * @return SubjectInterface
     */
    public function notify(): SubjectInterface;

}
