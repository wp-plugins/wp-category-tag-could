=== WP Category Tag Cloud ===
Contributors: benohead, amazingweb-gmbh
Donate link: http://benohead.com/donate/
Tags: 3d, cat, category, categories, cloud, configurable, cumulus, html5, javascript, sphere, tag, tags, tag-cloud, taxonomy, widget
Requires at least: 3.0.1
Tested up to: 3.9.1
Stable tag: 0.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display a configurable 2D or 3D cloud of tags, categories or any other taxonomy filtered by tags or categories.

== Description ==

WP Category Tag Cloud provides a configurable widget displaying a cloud of tags, categories or any other taxonomy.

The cloud elements can be displayed in different ways (see screenshots):

* as a flat list separated by spaces
* as a UL tag with the wp-tag-cloud class
* as price tags
* as rectangular tags with rounded corners
* as horizontal bars
* as a 3D HTML5 based tag cloud

Unlike other tag cloud plugins, WP Category Tag Cloud uses no Flash, but only HTML, JavaScript and CSS to display the cloud. This makes sure this plugin is compatible with any device with a modern browser.
It also doesn't generate the HTML tags for the cloud by itself but relies on WordPress functions. This means that if you use other plugins which add filters related to tag cloud, this plugin will integrate properly with them.

You can configure:

* the maximum number of taxonomy terms displayed
* whether the entries in the cloud are ordered by name or post count
* whether the entries are sorted in an ascending, descending or random order
* how the cloud should be rendered
* the zoom factor in case of a 3D HTML5 based tag cloud
* the size of the smallest and largest items in the cloud (in percentage)
* the font color used
* the background color used for horizontal bars
* the border color used for horizontal bars
* whether the opacity of the tags should be modified based on the usage
* whether to make links no-follow
* whether to tilt the displayed terms randomly
* whether to colorize the displayed terms randomly
* whether the widget should be cached and for how long

You can also choose to only consider posts with specific categories (with or without children) or tags.

If you do not want to display the cloud as a side bar widget but in the content of a page or post, you can use the short code (see the frequently asked questions). You can also use a PHP function to have the cloud displayed. More details also in the frequently asked section.

== Installation ==

1. Upload the folder `wp-category-tag-could` to the `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Select the widget and configure it or use the PHP function or the short code

== Frequently Asked Questions ==

= How can I contact you with a complaint, a question or a suggestion? =
Send an email to henri.benoit@gmail.com

= How can I display a term cloud in a page or a post? =
You can use the showtagcloud short code.

Syntax: [showtagcloud <options>]

Options:

* taxonomy: the taxonomy to be displayed e.g. post_tag, category...
* number: max number of terms to be displayed
* order_by: field by which to sort the terms in the tag. Should be "name" or "count"
* order: how to sort. Should be ASC, DESC or RAND (resp. ascending, descending or random)
* format: rendering type. "flat" for "Separated by whitespace", <option selected="selected" value="price" for "Price tags", "bars" for "Bars", "rounded" for "Rounded corners", "list" for "UL with a class of wp-tag-cloud", "array" for "3D HTML5 Cloud"
* tag_id: a comma separated list of tag IDs
* category_id: a comma separated list of category IDs
* child_categories: set to 1 to also consider child categories
* opacity: set to 1 so that the opacity of the different terms is modified based on the number of matching posts
* tilt: set to 1 to randomly tilt the terms
* colorize: set to 1 to randomly change the font color of the terms
* nofollow: set to 1 to make all link nofollow
* cache: set to 1 to cache the rendering of the cloud
* timeout: the cache timeout in seconds
* zoom: initial zoom factor e.g. 1
* smallest: smallest font size in percent of the default font size e.g. 75
* largest: largest font size in percent of the default font size e.g. 200
* color: font color e.g #ffffff
* background: background color e.g. #333333
* border: border color e.g. #AAAAAA

= How can I programmatically insert a term cloud ? =
Use the show_tag_cloud() function. It takes an associative array as parameter. The parameters are the same as for the short code above.

== Screenshots ==

1. Widget configuration

2. 3D HTML5 cloud

3. Flat list

4. Price tags

5. Horizontal bars

== Changelog ==

= 0.8 =

* Added support for rounded corners
* Fixed bug resulting in having multiple color pickers displayed
* Fixed price tags being each on a new line
* Improved half displayed text in horizontal bars
* Minified JavaScript and CSS
* Added PHP function to display the term cloud programmatically
* Added short code to display the term cloud in the contents of a page or post

= 0.7 =

* Option to make links no-follow
* Option to tilt the displayed terms randomly
* Option to colorize the displayed terms randomly

= 0.6.1 =

* Fixed hiding of background and border color chooser.

= 0.6 =

* Terms can be displayed as horizontal bars.

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
