<?php

namespace ParkimeterAffiliates\AffiliateBundle\CompilerPass;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DoctrineMappingCompilerPass implements CompilerPassInterface
{
    public function __construct()
    {
        if (false === class_exists(DoctrineBundle::class, true)) {
            throw new \Exception(sprintf("You are required to have %s installed.", DoctrineBundle::class));
        }
    }

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $config = $container->getExtensionConfig('doctrine');
        $mergedConfig = $this->mergedDoctrineArray($config);

        $container->prependExtensionConfig('doctrine', $mergedConfig);
    }

    /**
     * @param array $config
     * @return array
     */
    private function mergedDoctrineArray(array $config)
    {
        $merged = [];

        foreach ($config as $configArray) {
            $merged = array_merge_recursive($merged, $configArray);
        }

        return $merged;
    }
}
