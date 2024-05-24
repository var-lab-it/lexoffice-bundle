<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class VarLabITLexofficeBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode() // @phpstan-ignore-line
            ->children()
            ->scalarNode('api_key')->defaultValue('')->end()
            ->scalarNode('api_endpoint')->defaultValue('https://api.lexoffice.io')->end()
            ->scalarNode('api_version')->defaultValue('v1')->end()
            ->end();
    }

    /** @phpstan-ignore-next-line */
    public function loadExtension(
        array $config,
        ContainerConfigurator $container,
        ContainerBuilder $builder,
    ): void {
        $container->parameters()
            ->set('var_lab_it_lexoffice.api_key', $config['api_key'])
            ->set('var_lab_it_lexoffice.api_endpoint', $config['api_endpoint'])
            ->set('var_lab_it_lexoffice.api_version', $config['api_version']);

        $container->services()
            ->set(LexofficeClient::class)
            ->class(LexofficeClient::class)
            ->autowire(true)
            ->args([
                '$apiKey'      => $config['api_key'],
                '$apiEndpoint' => $config['api_endpoint'],
                '$apiVersion'  => $config['api_version'],
            ]);

        if ('test' !== $builder->getParameter('kernel.environment')) {
            return;
        }

        $container->services()
            ->get(LexofficeClient::class)
            ->public();
    }
}
