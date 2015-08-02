<?php

namespace TableNode\Extension\EventListener;

use Behat\Behat\EventDispatcher\Event\BeforeStepTested;
use TableNode\Extension\NestedTableNode;

class AfterStepSetupListener
{
    /**
     * @param BeforeStepTested $event
     */
    public function onBefore(BeforeStepTested $event)
    {
        $step = $event->getStep();
        $class = new \ReflectionClass($step);

        $propertyValue = $class->getProperty('arguments');
        $propertyValue->setAccessible(true);
        $arguments = $propertyValue->getValue($step);

        foreach ($arguments as $id => $tableNode) {
            $arguments[$id] = new NestedTableNode($tableNode->getTable());
        }

        $propertyValue->setValue($step, $arguments);
    }
}
