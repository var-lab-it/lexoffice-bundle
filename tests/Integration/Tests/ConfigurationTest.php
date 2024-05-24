<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\Integration\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Tests\VarLabIT\LexofficeBundle\Integration\TestApp\TestAppKernel;
use VarLabIT\LexofficeBundle\LexofficeClient;

class ConfigurationTest extends KernelTestCase
{
    protected ContainerInterface $container;

    protected function setUp(): void
    {
        parent::setUp();

        $kernel = new TestAppKernel('test', true);
        $kernel->boot();
        $this->container = $kernel->getContainer();
    }

    public function testConfiguration(): void
    {
        $apiKey      = $this->container->getParameter('var_lab_it_lexoffice.api_key');
        $apiEndpoint = $this->container->getParameter('var_lab_it_lexoffice.api_endpoint');
        $apiVersion  = $this->container->getParameter('var_lab_it_lexoffice.api_version');

        self::assertEquals('test-key', $apiKey);
        self::assertEquals('https://api.lexoffice.io', $apiEndpoint);
        self::assertEquals('v1', $apiVersion);
    }

    public function testIfClientIsRegistered(): void
    {
        $client = $this->container->get(LexofficeClient::class);

        self::assertInstanceOf(LexofficeClient::class, $client);
    }
}
