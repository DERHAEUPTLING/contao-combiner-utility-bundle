<?php

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['getPageLayout'][] = [\Derhaeuptling\CombinerUtilityBundle\EventListener\LayoutListener::class, 'onGetPageLayout'];
