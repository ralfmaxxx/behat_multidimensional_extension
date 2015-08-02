<?php

namespace TableNode\Extension\EventListener;

use Behat\Behat\EventDispatcher\Event\BeforeStepTested;
use Behat\Gherkin\Node\TableNode;
use TableNode\Extension\NestedTableNode;
use ReflectionClass;

class AfterStepSetupListener
{
    /**
     * @param BeforeStepTested $event
     */
    public function onBefore(BeforeStepTested $event)
    {
        $step = $event->getStep();
        $class = new ReflectionClass($step);

        $propertyValue = $class->getProperty('arguments');
        $propertyValue->setAccessible(true);
        $arguments = $propertyValue->getValue($step);

        /**
         * @var TableNode $tableNode
         */
        foreach ($arguments as $id => $argument) {
            if ($argument instanceof TableNode) {
                $arguments[$id] = new NestedTableNode($argument->getTable());
            }
        }

        $propertyValue->setValue($step, $arguments);
    }
}
