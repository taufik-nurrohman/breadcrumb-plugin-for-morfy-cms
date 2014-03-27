<?php

/**
 * Breadcrumb Navigation for Morfy CMS
 *
 * @package Morfy
 * @subpackage Plugins
 * @author Taufik Nurrohman <http://latitudu.com>
 * @copyright 2014 Romanenko Sergey / Awilum
 * @version 1.0.0
 *
 */

// Include `shell.css` in header
Morfy::factory()->addAction('theme_header', function() {
    echo '<link href="' . Morfy::$config['site_url'] . '/plugins/breadcrumb/lib/css/shell.css" rel="stylesheet">' . "\n";
});

// Usage => Morfy::factory()->runAction('breadcrumb');
Morfy::factory()->addAction('breadcrumb', function() {

    // Configuration data
    $config = Morfy::$config['breadcrumb_config'];
    // Get current URI segments
    $paths = Morfy::factory()->getUriSegments();
    // Count total paths
    $total_paths = count($paths);
    // Path lifter
    $lift = "";
    // Breadcrumb's HTML markup
    $html = Morfy::factory()->getUrl() == '' || Morfy::factory()->getUrl() == '/' ? '<span class="' . $config['classes']['item'] . ' ' . $config['classes']['current'] . '">' . $config['labels']['home'] . '</span>' : '<a class="' . $config['classes']['item'] . '" href="' . Morfy::$config['site_url'] . '">' . $config['labels']['home'] . '</a>';

    for($i = 0; $i < $total_paths; $i++) {
        $lift .= '/' . $paths[$i];
        error_reporting(0);
        $data = Morfy::factory()->getPage($lift);
        if($i < $total_paths - 1) {
            $html .= $config['divider'] . '<a class="' . $config['classes']['item'] . '" href="' . Morfy::$config['site_url'] . $lift . '">' . $data['title'] . '</a>';
        } else {
            $html .= $config['divider'] . '<span class="' . $config['classes']['item'] . ' ' . $config['classes']['current'] . '">' . $data['title'] . '</span>';
        }
    }

    echo $html;

});
