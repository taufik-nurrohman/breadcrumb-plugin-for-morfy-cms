Breadcrumb Plugin for Morfy CMS
===============================

Place the `breadcrumb` folder with its contents in `plugins` folder. Then update your `config.php` file:

    <?php
        return array(
    
            ...
            ...
            ...
    
            'plugins' => array(
                'markdown',
                'sitemap',
                'breadcrumb' // <= Activation
            ),
            'breadcrumb_config' => array( // <= Configuration
                'classes' => array( // <= List of item's HTML classes
                    'item' => 'item',
                    'current' => 'active'
                ),
                'labels' => array( // <= List of item's readable text or labels
                    'home' => 'Home'
                ),
                'divider' => ' <span class="divider">/</span> '
            )
        );

Usage
-----

Add this snippet to your `navbar.html` that is placed in the `themes` folder to show the breadcrumb navigation:

    <nav class="breadcrumb">
      <?php Morfy::factory()->runAction('breadcrumb'); ?>
    </nav>
