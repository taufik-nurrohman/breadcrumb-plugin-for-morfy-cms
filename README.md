Breadcrumb Plugin for Morfy CMS
===============================

Configuration
-------------

1. Put the `breadcrumb` folder to the `plugins` folder
2. Go to `config\site.yml` and add `breadcrumb` to the plugins section:
3. Save your changes.

~~~ .yml
# Site Plugins
plugins:
  breadcrumb
~~~

Usage
-----

Add this snippet to your `navbar.tpl` that is placed in the `themes` folder to show the breadcrumb navigation:

~~~ .html
...
<nav class="breadcrumb">
  {Morfy::runAction('breadcrumb')}
</nav>
~~~

Done.