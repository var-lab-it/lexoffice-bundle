<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\Integration\TestApp;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use VarLabIT\LexofficeBundle\VarLabITLexofficeBundle;

class TestAppKernel extends Kernel
{
    public function registerBundles(): iterable
    {
        $bundles = [];

        if ('test' === $this->getEnvironment()) {
            $bundles[] = new FrameworkBundle();
            $bundles[] = new VarLabITLexofficeBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__ . '/config/config_test.yml');
    }

    public function getCacheDir(): string
    {
        return \sys_get_temp_dir() . '/VarLabITLexofficeBundle/cache';
    }

    public function getLogDir(): string
    {
        return \sys_get_temp_dir() . '/VarLabITLexofficeBundle/logs';
    }
}
