<?php

namespace ParkimeterAffiliates\SharedBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use ParkimeterAffiliates\SharedBundle\CompilerPass\DoctrineMappingCompilerPass;

class ParkimeterAffiliatesSharedBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new DoctrineMappingCompilerPass());
    }
}
