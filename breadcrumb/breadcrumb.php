<?php

/**
 * Breadcrumb Navigation for Morfy CMS
 *
 * @package Morfy
 * @subpackage Plugins
 * @author Taufik Nurrohman <http://latitudu.com>
 * @copyright 2014 Romanenko Sergey / Awilum
 * @version 2.1.0
 *
 */

// Include `shell.css` in header
Action::add('theme_header', function() {
    $url = str_replace(array(ROOT_DIR, DIRECTORY_SEPARATOR), array(Url::getBase(), '/'), PLUGINS_PATH);
    $url = $url . '/' . basename(__DIR__) . '/assets/css/shell.css';
    echo '<link href="' . $url . '" rel="stylesheet">' . "\n";
});

// Usage => Action::run('breadcrumb');
Action::add('breadcrumb', function() {

    // Initialize template
    $template = Template::factory(__DIR__ . '/templates');
    // Configuration data
    $config = Config::get('plugins.breadcrumb');
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
        $page = Pages::getPage(File::exists(STORAGE_PATH . '/pages/' . $lift . '/index.md') || File::exists(STORAGE_PATH . '/pages/' . $lift . '.md') ? $lift : '404');
        $data[Url::getbase() . $lift] = array(
            'title' => $page['title'],
            'current' => Url::getCurrent() === Url::getBase() . $lift
        );
    }

    $template->display('breadcrumb.tpl', array(
        'home' => Url::getCurrent() === Url::getBase() ? true : Url::getBase(),
        'branch' => $data
    ));

});