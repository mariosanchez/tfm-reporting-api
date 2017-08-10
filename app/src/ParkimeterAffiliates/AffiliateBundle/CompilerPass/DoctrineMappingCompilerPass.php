<?php

namespace ParkimeterAffiliates\AffiliateBundle\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DoctrineMappingCompilerPass implements CompilerPassInterface
{

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $config = $container->getExtensionConfig('doctrine');
        $mergedConfig = [];

        foreach ($config as $configArray) {
            $mergedConfig = array_merge_recursive($mergedConfig, $configArray);
        }

        $container->prependExtensionConfig('doctrine', $mergedConfig);
    }
}
