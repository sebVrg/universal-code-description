<?php

namespace UniversalCodeDefinition\View;

use UniversalCodeDefinition\Observer\SubjectInterface;

/**
 * @author seeren
 */
class UCDView implements ViewInterface
{

    private
        /**
         * @var string template
         */
        $template;

    /**
     * Construct UCDView
     */
    public function __construct()
    {
        $this->template = "{}";
    }

    /**
     * {@inheritDoc}
     * @see \Lib\MVC\ObserverInterface::update()
     */
    public function update(SubjectInterface $subject): SubjectInterface
    {
        $this->template = json_encode($subject, JSON_PRETTY_PRINT);
        return $subject;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \UniversalCodeDefinition\View\ViewInterface::render()
     */
    public function render(): string
    {
        return $this->template;
    }

}
