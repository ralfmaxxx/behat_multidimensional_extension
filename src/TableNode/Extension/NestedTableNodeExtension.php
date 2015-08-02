<?php

namespace TableNode\Extension;

use Behat\Behat\EventDispatcher\Event\AfterStepSetup;
use Behat\Testwork\EventDispatcher\TestworkEventDispatcher;
use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use TableNode\Extension\EventListener\AfterStepSetupListener;

class NestedTableNodeExtension implements Extension
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        /**
         * @var TestworkEventDispatcher
         */
        $eventDispatcher = $container->get('event_dispatcher');

        $eventDispatcher->addListener(
            AfterStepSetup::BEFORE,
            [
                new AfterStepSetupListener(),
                'onBefore'
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigKey()
    {
        return 'multidimensional_table';
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(ExtensionManager $extensionManager)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function configure(ArrayNodeDefinition $builder)
    {
        $builder->end();
    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {
    }
}
