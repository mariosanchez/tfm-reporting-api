<?php

namespace ParkimeterAffiliates\AffiliateBundle;

use ParkimeterAffiliates\AffiliateBundle\CompilerPass\DoctrineMappingCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ParkimeterAffiliatesAffiliateBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new DoctrineMappingCompilerPass());
    }
}
