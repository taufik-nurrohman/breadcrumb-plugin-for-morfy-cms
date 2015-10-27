<?php

/**
 * Breadcrumb Navigation for Morfy CMS
 *
 * @package Morfy
 * @subpackage Plugins
 * @author Taufik Nurrohman <http://latitudu.com>
 * @copyright 2014 Romanenko Sergey / Awilum
 * @version 2.0.0
 *
 */

// Include `shell.css` in header
Morfy::addAction('theme_header', function() {
    echo '<link href="' . Morfy::$site['url'] . '/plugins/' . basename(__DIR__) . '/assets/css/shell.css" rel="stylesheet">' . "\n";
});

// Usage => Morfy::runAction('breadcrumb');
Morfy::addAction('breadcrumb', function() {

    // Initialize Fenom
    $template = Fenom::factory(
        PLUGINS_PATH . '/' . basename(__DIR__) . '/templates',
        CACHE_PATH . '/fenom',
        Morfy::$fenom
    );
    // Configuration data
    $config = Morfy::$plugins['breadcrumb'];
    // Get current URI segments
    $paths = Url::getUriSegments();
    // Count total paths
    $total_paths = count($paths);
    // Path lifter
    $lift = "";
    // Breadcrumb's data
    $data = array();

    for($i = 0; $i < $total_paths; $i++) {
        $lift .= '/' . $paths[$i];
        $page = Morfy::getPage(file_exists(PAGES_PATH . '/' . $lift . '/index.md') || file_exists(PAGES_PATH . '/' . $lift . '.md') ? $lift : '404');
        $data[Morfy::$site['url'] . $lift] = array(
            'title' => $page['title'],
            'current' => rtrim(Url::getCurrent(), '/') === rtrim(Morfy::$site['url'] . $lift, '/')
        );
    }

    $template->display('breadcrumb.tpl', array(
        'home' => rtrim(Url::getCurrent(), '/') === rtrim(Morfy::$site['url'], '/') ? true : Morfy::$site['url'],
        'config' => $config,
        'branch' => $data
    ));

});