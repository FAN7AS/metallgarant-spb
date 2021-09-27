=== Plugin Name ===
Contributors: Marekki
Donate link: http://www.wp-watermark.com/
Tags: watermark
Requires at least: 3.0.1
Tested up to: 3.5.1
Stable tag: 0.9.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Marekkis Watermark plugin for Wordpress

== Description ==

**Marekkis Watermark-Plugin** for Wordpress can watermark your pictures an two different ways:

* Insert your watermark while the picture is being uploaded.

After the activation every picture that you will upload with wordpress build-in media-uploader will be watermarked.

In the configuration-screen you can set up the position and the type of your watermark. It can be your logo (.png-file) with transparent background or a free text with color, font, size, shadow and transparency-level of your choice. See screenshots.

* Insert your watermark on all chosen pictures from a directory on your web-server.

Marekkis Watermark makes possible to create a watermark on mediafiles that are already uploaded on your server. So you can mark all your old pictures with the new watermark.

== Installation ==

1. Navigate to **`Plugins - Add New`**
2. Type in the searchbox **`Marekkis watermark`**
3. Press on **`Install Now`**
4. Activate the plugin after installation 
5. Setup the plugin through the **`Settings - Watermark`** menu in WordPress

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.


== Screenshots ==


1. Admin-area for configuration

Here are three examaples:

2. Watermarked with transparent text.
3. Watermarked with solid text with shadow.
4. Watermarked with png-logo.

== Changelog ==

= 0.9.4. =
* Add: select image type for watermarking

= 0.9.3. =
* Add: option for watermarking of original image
* Add: option for watermarking of thumbnails (scaled images)

= 0.9.2 =
* Change: Fixed security issue

= 0.9.1 =
* Change: Small fixes

= 0.9 =

* Add: WordPress-hook for easy installation. No changes in code are needed.

= 0.8 =

* Add: You can select if you want to create bakupfiles from watermarked pictures in directory-mode
* Change: Change to “role-concept” for WordPress 2.0+
* Bug-fixing

= 0.7 =

* Bug-fixing

= 0.6 =

* Add: Watermark for all chosen files from directory
* Change: Internal structure
* Bug-fixing

= 0.5 =

* Add: Shadow of text enable.
* Add: Font choice.
* Add: Opaque-level for text watermark.
* Add: Check of fields values.
* Change: All settings will be save in the WordPress DB. No extra table for Watermark needed.
* Bug-fixing.

= 0.0.4 =

* Add: Support for text as watermark.
* Add: Preview function.
* Add: Use the free font LinLibertineTTF-2.0.7 (GPL).
* Change: New DB table structure for text support.
* Bug-fixing.

= 0.0.3 =

* First open version.

== Upgrade Notice ==
If you upgrade from version 0.8 or lower, please be sure you have deleted the "// INSERT HERE!!! MM_Execute_WM($destfilename,'');" line the from the media.php file. You will be never more need this line.
