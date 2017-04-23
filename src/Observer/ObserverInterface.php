<?php

namespace UniversalCodeDefinition\Observer;

/**
 * @author seeren
 */
interface ObserverInterface
{

    /**
     * Update
     * 
     * @param SubjectInterface $subject
     */
    public function update(SubjectInterface $subject): SubjectInterface;

}
