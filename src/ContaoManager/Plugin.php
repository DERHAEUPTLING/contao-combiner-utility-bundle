<?php

namespace Derhaeuptling\CombinerUtilityBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Derhaeuptling\CombinerUtilityBundle\DerhaeuptlingCombinerUtilityBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(DerhaeuptlingCombinerUtilityBundle::class)->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
