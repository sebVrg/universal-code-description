<?php

namespace UniversalCodeDefinition\View;

use UniversalCodeDefinition\Observer\ObserverInterface;

/**
 * @author seeren
 */
interface ViewInterface extends ObserverInterface
{

    /**
     * Render view
     *
     * @return string template
     */
    public function render(): string;

}
