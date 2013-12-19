<?php

namespace App;

use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class Kernel extends BaseKernel
{
    public function registerBundles()
    {
        $bundles = array(
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle,
            new \Symfony\Bundle\SecurityBundle\SecurityBundle,
            new \Symfony\Bundle\MonologBundle\MonologBundle,
            new \Knp\RadBundle\KnpRadBundle,
            new \App\App,
        );

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');

        if (is_file($file = __DIR__.'/config/config_'.$this->getEnvironment().'_local.yml')) {
            $loader->load($file);
        }
    }

    public function getCacheDir()
    {
        return $this->rootDir.'/../../var/cache/'.$this->environment;
    }

    public function getLogDir()
    {
        return $this->rootDir.'/../../var/logs';
    }
}
