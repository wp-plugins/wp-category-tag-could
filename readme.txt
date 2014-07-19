=== WP Category Tag Cloud ===
Contributors: benohead, amazingweb-gmbh
Donate link: http://benohead.com/donate/
Tags: 3d, cat, category, categories, cloud, configurable, cumulus, html5, javascript, sphere, tag, tags, tag-cloud, taxonomy, widget
Requires at least: 3.0.1
Tested up to: 3.9.1
Stable tag: 0.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display a configurable cloud of tags, categories or any other taxonomy filtered by tags or categories.

== Description ==

WP Category Tag Cloud provides a configurable widget displaying a cloud of tags, categories or any other taxonomy.

The cloud elements can be displayed as a standard 2D list, as a 3D sphere (using HTML5 and JavaScript) or as a list of price tags (see screenshots).

Unlike other tag cloud plugins, WP Category Tag Cloud uses no Flash, but only HTML, JavaScript and CSS to display the cloud. This makes sure this plugin is compatible with any device with a modern browser.
It also doesn't generate the HTML tags for the cloud by itself but relies on WordPress functions. This means that if you use other plugins which add filters related to tag cloud, this plugin will integrate properly with them.

You can configure:

* the maximum number of taxonomy terms displayed
* whether the entries in the cloud are ordered by name or post count
* whether the entries are sorted in an ascending, descending or random order
* whether the cloud is rendered as a flat list separated by spaces, as a UL tag with the wp-tag-cloud class, price tags or as a 3D HTML5 based tag cloud.
* the zoom factor in case of a 3D HTML5 based tag cloud
* the size of the smallest and largest items in the cloud (in percentage)
* the font color used
* whether the opacity of the tags should be modified based on the usage
* whether the widget should be cached and for how long

You can also choose to only consider posts with specific categories (with or without children) or tags.

== Installation ==

1. Upload the folder `wp-category-tag-could` to the `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Select the widget and configure it

== Frequently Asked Questions ==

= How can I contact you with a complaint, a question or a suggestion? =
Send an email to henri.benoit@gmail.com

== Screenshots ==

1. Widget configuration

2. 3D HTML5 cloud

3. Flat list

4. Price tags

== Changelog ==

= 0.5 =

* Support for opacity.
* Support for widget caching.

= 0.4 =

* Support for font color.

= 0.3.4 =

* Fixed non-working filtering when other table prefix than wp_ was used.
* Added support for child categories.

= 0.3.3 =

* Removed link to settings as there are no plugin settings but just widget settings

= 0.3.2 =

* Fixed errors in comboboxes on empty values
* Made canvas width 100%

= 0.3.1 =

* Fixed default settings

= 0.3 =

* Added configuration setting for zoom factor in 3D HTML5 canvas
* Add support for price tags
* Add support for configuration settings based on the selected cloud type
* Updated screenshots in readme

= 0.2.1 =

* Fixed bug when run with PHP 5.3 or lower

= 0.2 =

* Support for animated HTML5 canvas based tag cloud using <a href="http://www.goat1000.com/tagcanvas.php">TagCanvas</a>.

= 0.1 =

* First version.

== Upgrade Notice ==

n.a.
