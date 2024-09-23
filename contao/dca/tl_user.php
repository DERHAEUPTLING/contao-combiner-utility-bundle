<?php

/**
 * Palettes
 */
\Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addField('disableCombineScripts', 'backend_legend', \Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('login', 'tl_user')
    ->applyToPalette('admin', 'tl_user');

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_user']['fields']['disableCombineScripts'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_user']['disableCombineScripts'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'clr'],
    'sql' => ['type' => 'boolean', 'default' => 0],
];
