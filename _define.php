<?php
/**
 * @brief Bifrost (responsive), a theme for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Themes
 *
 * @copyright Philippe aka amalgame and HTML5 UP
 * @copyright GPL-2.0-only
 */
if (!defined('DC_RC_PATH')) {
    return;
}

$this->registerModule(
    'Bifrost (responsive)',                         // Name
    'A responsive Bifrost theme for Dotclear',      // Description
    'Clément Latzarus',                             // Author
    '2023',                                         // Version
    [                                               // Properties
        'requires'          => [['core', '2.19']],
        'standalone_config' => true,
        'type'   => 'theme',
        'tplset' => 'dotty'
    ]
);
